<?php

namespace App\Http\Controllers\Pengelola;

use App\Http\Controllers\Controller;
use App\Models\Desa;
use App\Models\Kecamatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function index()
    {
        $pengelola = auth()->user()->pengelola;
        return view('pengelola.profile.index', compact('pengelola'));
    }

    public function edit()
    {
        $pengelola = auth()->user()->pengelola;
        $kecamatans = Kecamatan::orderBy('nama')->get();
        $desas = $pengelola->kecamatan_id 
            ? Desa::where('kecamatan_id', $pengelola->kecamatan_id)->orderBy('nama')->get() 
            : collect();

        return view('pengelola.profile.edit', compact('pengelola', 'kecamatans', 'desas'));
    }

    public function update(Request $request)
    {
        $pengelola = auth()->user()->pengelola;

        $validated = $request->validate([
            'nama_wisata' => 'required|string|max:255',
            'kecamatan_id' => 'required|exists:kecamatan,id',
            'desa_id' => 'nullable|exists:desa,id',
            'alamat_wisata' => 'required|string|max:255',
            'deskripsi_wisata' => 'required|string',
            'foto_wisata' => 'nullable|image|mimes:jpeg,jpg,png|max:2048',
            'kontak_wisata' => 'nullable|string|max:20',
            'jam_buka' => 'nullable|string|max:10',
            'jam_tutup' => 'nullable|string|max:10',
            'harga' => 'required|numeric|min:0',
            'nomor_rekening' => 'nullable|string|max:50',
            'nama_bank' => 'nullable|string|max:50',
            'nama_pemilik_rekening' => 'nullable|string|max:100',
        ]);

        if ($request->hasFile('foto_wisata')) {
            if ($pengelola->foto_wisata) {
                Storage::disk('public')->delete($pengelola->foto_wisata);
            }
            $validated['foto_wisata'] = $request->file('foto_wisata')->store('pengelola/foto', 'public');
        }

        $pengelola->update($validated);

        return redirect()->route('pengelola.profile.index')
            ->with('success', 'Profil usaha berhasil diperbarui!');
    }
}
