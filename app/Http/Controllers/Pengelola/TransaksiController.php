<?php

namespace App\Http\Controllers\Pengelola;

use App\Http\Controllers\Controller;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TransaksiController extends Controller
{
    public function index()
    {
        $transaksi = auth()->user()->pengelola->transaksi()->latest()->get();
        return view('pengelola.transaksi.index', compact('transaksi'));
    }

    public function show($id)
    {
        $transaksi = auth()->user()->pengelola->transaksi()->findOrFail($id);
        return view('pengelola.transaksi.show', compact('transaksi'));
    }

    public function approve($id)
    {
        $transaksi = auth()->user()->pengelola->transaksi()->findOrFail($id);

        if ($transaksi->status !== 'pending') {
            return back()->with('error', 'Transaksi sudah diproses.');
        }

        // Generate Code: JVYG-[id pengelola]-[RANDOM]
        $randomString = strtoupper(Str::random(6));
        $kode = "JVYG-{$transaksi->pengelola_id}-{$randomString}";

        $transaksi->update([
            'status' => 'verified',
            'kode' => $kode,
        ]);

        return redirect()->route('pengelola.transaksi.show', $transaksi->id)
            ->with('success', 'Transaksi berhasil disetujui. Kode tiket: ' . $kode);
    }

    public function reject($id)
    {
        $transaksi = auth()->user()->pengelola->transaksi()->findOrFail($id);

        if ($transaksi->status !== 'pending') {
            return back()->with('error', 'Transaksi sudah diproses.');
        }

        $transaksi->update([
            'status' => 'rejected',
        ]);

        return redirect()->route('pengelola.transaksi.show', $transaksi->id)
            ->with('success', 'Transaksi ditolak.');
    }
}
