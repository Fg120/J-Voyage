<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pengelola;
use Illuminate\Http\Request;

class PengelolaController extends Controller
{
   public function index(Request $request)
    {
        // 1. Siapkan Query Dasar dengan Relasi
        $query = Pengelola::with(['user', 'kecamatan', 'desa']);

        if ($request->filled('status') && $request->status !== 'all') {
            $query->where('status', $request->status);
        }
        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function($q) use ($search) {
                $q->where('nama_wisata', 'LIKE', '%' . $search . '%')
                  ->orWhereHas('user', function($userQuery) use ($search) {
                      $userQuery->where('name', 'LIKE', '%' . $search . '%')
                                ->orWhere('email', 'LIKE', '%' . $search . '%');
                  });
            });
        }

        $pengelolas = $query->latest()
                            ->paginate(10)
                            ->withQueryString();

        return view('admin.pengelola.index', compact('pengelolas'));
    }
    public function show(Pengelola $pengelola)
    {
        $pengelola->load(['user', 'kecamatan', 'desa']);

        return view('admin.pengelola.show', compact('pengelola'));
    }

    public function approve(Pengelola $pengelola)
    {
        $pengelola->update([
            'status' => 'approved',
            'verified_at' => now(),
            'catatan_admin' => null,
        ]);

        $pengelola->user->syncRoles(['pengelola']);

        return redirect()->route('admin.pengelola.show', $pengelola)
            ->with('success', 'Pengajuan berhasil disetujui!');
    }

    public function reject(Request $request, Pengelola $pengelola)
    {
        $request->validate([
            'catatan_admin' => 'required|string',
        ]);

        $pengelola->update([
            'status' => 'rejected',
            'catatan_admin' => $request->catatan_admin,
            'verified_at' => null,
        ]);

        return redirect()->route('admin.pengelola.show', $pengelola)
            ->with('success', 'Pengajuan ditolak.');
    }

    public function block(Request $request, Pengelola $pengelola)
    {
        $request->validate([
            'catatan_admin' => 'required|string',
        ]);

        $pengelola->update([
            'status' => 'blocked',
            'catatan_admin' => $request->catatan_admin,
        ]);

        $pengelola->user->syncRoles(['user']);

        return redirect()->route('admin.pengelola.show', $pengelola)
            ->with('success', 'Pengelola berhasil diblokir.');
    }

    public function unblock(Pengelola $pengelola)
    {
        $pengelola->update([
            'status' => 'approved',
            'catatan_admin' => null,
        ]);

        $pengelola->user->syncRoles(['pengelola']);

        return redirect()->route('admin.pengelola.show', $pengelola)
            ->with('success', 'Pengelola berhasil dibuka blokirnya.');
    }
}
