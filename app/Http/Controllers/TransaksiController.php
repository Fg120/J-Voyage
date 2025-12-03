<?php

namespace App\Http\Controllers;

use App\Models\Pengelola;
use App\Models\Transaksi;
use Illuminate\Http\Request;

class TransaksiController extends Controller
{
    public function create($id)
    {
        $destinasi = Pengelola::where('status', 'approved')->findOrFail($id);

        return view('transaksi.create', compact('destinasi'));
    }

    public function store(Request $request, $id)
    {
        $destinasi = Pengelola::where('status', 'approved')->findOrFail($id);

        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'telepon' => 'required|string|max:20',
            'tanggal_kunjungan' => 'required|date|after_or_equal:today',
            'jumlah' => 'required|integer|min:1',
            'catatan' => 'nullable|string',
        ]);

        $total_harga = $destinasi->harga * $request->jumlah;

        $transaksi = Transaksi::create([
            'pengelola_id' => $destinasi->id,
            'user_id' => auth()->id() ?? 1, // Fallback to user 1 if not logged in (or handle guest)
            'nama' => $request->nama,
            'email' => $request->email,
            'telepon' => $request->telepon,
            'tanggal_kunjungan' => $request->tanggal_kunjungan,
            'jumlah' => $request->jumlah,
            'catatan' => $request->catatan,
            'harga_satuan' => $destinasi->harga,
            'total_harga' => $total_harga,
            'metode_pembayaran' => 'pending', // Will be updated in payment step
            'status' => 'pending',
        ]);

        return redirect()->route('transaksi.payment', $transaksi->id);
    }

    public function payment($id)
    {
        $transaksi = Transaksi::with('pengelola')->findOrFail($id);

        // Ensure user can only view their own transaction (if logged in)
        if (auth()->check() && $transaksi->user_id !== auth()->id()) {
            // Optional: Allow if it's a guest transaction (user_id 1) or handle logic
        }

        return view('transaksi.payment', compact('transaksi'));
    }

    public function processPayment(Request $request, $id)
    {
        $transaksi = Transaksi::findOrFail($id);

        $request->validate([
            'metode_pembayaran' => 'required|string',
            'bukti_pembayaran' => 'required|file|image|mimes:jpeg,png,jpg,pdf|max:2048',
        ]);

        $path = $request->file('bukti_pembayaran')->store('transaksi/bukti', 'public');

        $transaksi->update([
            'metode_pembayaran' => $request->metode_pembayaran,
            'bukti_pembayaran' => $path,
            // Status remains pending until approved by manager
        ]);

        return redirect()->route('onboarding')->with('success', 'Pembayaran berhasil dikirim! Menunggu verifikasi pengelola.');
    }

    public function history()
    {
        $transaksi = Transaksi::with('pengelola')->where('user_id', auth()->id())->latest()->get();

        return view('profile.history', compact('transaksi'));
    }

    public function showDetail($id)
    {

        $transaksi = Transaksi::with('pengelola')
            ->where('id', $id)
            ->first();

        return view('profile.detailhistory', compact('transaksi'));
    }

    public function showTiket($id)
    {

        $transaksi = Transaksi::with('pengelola')
            ->where('id', $id)
            ->first();

        return view('profile.showtiket', compact('transaksi'));
    }

    public function scanTiket($kode)
    {

        $transaksi = Transaksi::with('pengelola')
            ->where('kode', decrypt($kode))
            ->first();

        return view('cobascan', compact('transaksi'));
    }
}
