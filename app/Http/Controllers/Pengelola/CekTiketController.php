<?php

namespace App\Http\Controllers\Pengelola;

use App\Http\Controllers\Controller;
use App\Models\Transaksi;
use App\Notifications\TicketScannedNotification;
use Illuminate\Http\Request;

class CekTiketController extends Controller
{
    public function index()
    {
        return view('pengelola.cek-tiket.index');
    }

    public function check(Request $request)
    {
        $request->validate([
            'kode' => 'required|string',
        ]);

        $kode = $request->input('kode');

        // Try to decrypt if it's an encrypted code from QR
        try {
            $decryptedKode = decrypt($kode);
            $kode = $decryptedKode;
        } catch (\Exception $e) {
            // Not encrypted, use as-is (manual text input)
        }

        $pengelolaId = auth()->user()->pengelola->id;

        $transaksi = Transaksi::with('pengelola')
            ->where('kode', $kode)
            ->where('pengelola_id', $pengelolaId)
            ->first();

        if (!$transaksi) {
            return response()->json([
                'success' => false,
                'message' => 'Tiket tidak ditemukan atau bukan milik wisata Anda.',
            ]);
        }

        if ($transaksi->status !== 'verified') {
            return response()->json([
                'success' => false,
                'message' => 'Tiket belum diverifikasi. Status: ' . $transaksi->status,
            ]);
        }

        return response()->json([
            'success' => true,
            'data' => [
                'id' => $transaksi->id,
                'kode' => $transaksi->kode,
                'nama' => $transaksi->nama,
                'email' => $transaksi->email,
                'telepon' => $transaksi->telepon,
                'tanggal_kunjungan' => $transaksi->tanggal_kunjungan?->format('d M Y') ?? '-',
                'jumlah' => $transaksi->jumlah,
                'total_harga' => number_format($transaksi->total_harga, 0, ',', '.'),
                'scanned_at' => $transaksi->scanned_at ? $transaksi->scanned_at->format('d M Y H:i') : null,
                'is_scanned' => $transaksi->scanned_at !== null,
            ],
        ]);
    }

    public function markScanned($id)
    {
        $pengelolaId = auth()->user()->pengelola->id;

        $transaksi = Transaksi::with(['pengelola', 'user'])->where('id', $id)
            ->where('pengelola_id', $pengelolaId)
            ->first();

        if (!$transaksi) {
            return response()->json([
                'success' => false,
                'message' => 'Tiket tidak ditemukan.',
            ]);
        }

        if ($transaksi->scanned_at) {
            return response()->json([
                'success' => false,
                'message' => 'Tiket sudah pernah di-scan pada ' . $transaksi->scanned_at->format('d M Y H:i'),
            ]);
        }

        $transaksi->update([
            'scanned_at' => now(),
        ]);

        // Refresh the model to get the updated scanned_at
        $transaksi->refresh();

        // Send email notification
        if ($transaksi->user) {
            $transaksi->user->notify(new TicketScannedNotification($transaksi));
        }

        return response()->json([
            'success' => true,
            'message' => 'Tiket berhasil ditandai sebagai sudah di-scan.',
            'scanned_at' => $transaksi->scanned_at->format('d M Y H:i'),
        ]);
    }
}

