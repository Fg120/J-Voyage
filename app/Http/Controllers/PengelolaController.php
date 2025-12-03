<?php

namespace App\Http\Controllers;

use App\Models\Desa;
use App\Models\Kecamatan;
use App\Models\Pengelola;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PengelolaController extends Controller
{
    public function index()
    {
        $pengelola = auth()->user()->pengelola;

        return view('pengelola.index', compact('pengelola'));
    }

    public function create()
    {
        // Cek apakah user sudah pernah mengajukan
        if (auth()->user()->pengelola) {
            return redirect()->route('pengelola.index')
                ->with('error', 'Anda sudah memiliki pengajuan pengelola.');
        }

        $kecamatans = Kecamatan::orderBy('nama')->get();

        return view('pengelola.create', compact('kecamatans'));
    }

    public function edit()
    {
        $pengelola = auth()->user()->pengelola;

        if (! $pengelola) {
            return redirect()->route('pengelola.create');
        }

        // Hanya bisa edit jika pending atau rejected
        if (! in_array($pengelola->status, ['pending', 'rejected'])) {
            return redirect()->route('pengelola.index')
                ->with('error', 'Pengajuan yang sudah disetujui tidak dapat diubah.');
        }

        $kecamatans = Kecamatan::orderBy('nama')->get();
        $desas = $pengelola->kecamatan_id
            ? Desa::where('kecamatan_id', $pengelola->kecamatan_id)->orderBy('nama')->get()
            : collect();

        return view('pengelola.edit', compact('pengelola', 'kecamatans', 'desas'));
    }

    public function store(Request $request)
    {
        // Validasi
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
            'file_izin' => 'required|file|mimes:pdf,jpg,jpeg,png|max:5120',
            'file_ktp' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'file_npwp' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'alasan_pengajuan' => 'required|string',
        ]);

        // Upload files
        if ($request->hasFile('foto_wisata')) {
            $validated['foto_wisata'] = $request->file('foto_wisata')->store('pengelola/foto', 'public');
        }

        if ($request->hasFile('file_izin')) {
            $validated['file_izin'] = $request->file('file_izin')->store('pengelola/izin', 'public');
        }

        if ($request->hasFile('file_ktp')) {
            $validated['file_ktp'] = $request->file('file_ktp')->store('pengelola/ktp', 'public');
        }

        if ($request->hasFile('file_npwp')) {
            $validated['file_npwp'] = $request->file('file_npwp')->store('pengelola/npwp', 'public');
        }

        // Create pengelola
        $validated['user_id'] = auth()->id();
        $validated['status'] = 'pending';

        Pengelola::create($validated);

        return redirect()->route('pengelola.index')
            ->with('success', 'Pengajuan berhasil dikirim! Menunggu persetujuan admin.');
    }

    public function update(Request $request)
    {
        $pengelola = auth()->user()->pengelola;

        if (! $pengelola || ! in_array($pengelola->status, ['pending', 'rejected'])) {
            return redirect()->route('pengelola.index')
                ->with('error', 'Pengajuan tidak dapat diubah.');
        }

        // Validasi
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
            'file_izin' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
            'file_ktp' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'file_npwp' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'alasan_pengajuan' => 'required|string',
        ]);

        // Upload files (hapus yang lama jika ada upload baru)
        if ($request->hasFile('foto_wisata')) {
            if ($pengelola->foto_wisata) {
                Storage::disk('public')->delete($pengelola->foto_wisata);
            }
            $validated['foto_wisata'] = $request->file('foto_wisata')->store('pengelola/foto', 'public');
        }

        if ($request->hasFile('file_izin')) {
            if ($pengelola->file_izin) {
                Storage::disk('public')->delete($pengelola->file_izin);
            }
            $validated['file_izin'] = $request->file('file_izin')->store('pengelola/izin', 'public');
        }

        if ($request->hasFile('file_ktp')) {
            if ($pengelola->file_ktp) {
                Storage::disk('public')->delete($pengelola->file_ktp);
            }
            $validated['file_ktp'] = $request->file('file_ktp')->store('pengelola/ktp', 'public');
        }

        if ($request->hasFile('file_npwp')) {
            if ($pengelola->file_npwp) {
                Storage::disk('public')->delete($pengelola->file_npwp);
            }
            $validated['file_npwp'] = $request->file('file_npwp')->store('pengelola/npwp', 'public');
        }

        // Reset status ke pending jika dari rejected
        if ($pengelola->status === 'rejected') {
            $validated['status'] = 'pending';
            $validated['catatan_admin'] = null;
        }

        $pengelola->update($validated);

        return redirect()->route('pengelola.index')
            ->with('success', 'Pengajuan berhasil diperbarui!');
    }

    public function getDesa($kecamatan_id)
    {
        $desas = Desa::where('kecamatan_id', $kecamatan_id)->orderBy('nama')->get();

        return response()->json($desas);
    }
}
