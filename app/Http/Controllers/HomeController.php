<?php

namespace App\Http\Controllers;

use App\Models\Pengelola;
use App\Models\Ulasan;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $destinasi = Pengelola::with(['desa', 'kecamatan'])
            ->where('status', 'approved')
            ->latest()
            ->take(5)
            ->get();

        return view('onboarding', compact('destinasi'));
    }

    public function show($id)
    {
        $destinasi = Pengelola::with(['desa', 'kecamatan', 'highlights', 'fasilitas'])
            ->where('status', 'approved')
            ->findOrFail($id);

        $avgulasan = Ulasan::where('pengelola_id', $id)->avg('rating');
        $banyakulasan = Ulasan::where('pengelola_id', $id)->count();

        return view('destinasi.show', compact('destinasi', 'avgulasan', 'banyakulasan'));
    }

    public function showmore(Request $request)
    {

        $search = $request->searchdestination;
        $destinasi = Pengelola::with(['desa', 'kecamatan'])
        ->where('status', 'approved') // Syarat 1: Harus Approved
        ->when($search, function ($query, $search) {
            $query->where(function($q) use ($search) {

                $q->where('nama_wisata', 'LIKE', '%'.$search.'%')
                ->orWhere('alamat_wisata', 'LIKE', '%'.$search.'%')
                ->orWhereHas('kecamatan', function($subQuery) use ($search) {
                    $subQuery->where('nama', 'LIKE', '%'.$search.'%');
                })
                ->orWhereHas('desa', function($subQuery) use ($search) {
                    $subQuery->where('nama', 'LIKE', '%'.$search.'%');
                });
            });
        })
        ->latest()
        ->paginate(8);

        return view('destinasi.showmore', compact('destinasi'));
    }
}
