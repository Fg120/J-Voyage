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
            ->where('status', 'approved')
            ->when($request->searchdestination, function ($query, $search) {
                return $query->where('nama_wisata', 'LIKE', '%'.$search.'%');
            })
            ->latest()
            ->paginate(8);

        return view('destinasi.showmore', compact('destinasi'));
    }
}
