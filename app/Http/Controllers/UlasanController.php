<?php

namespace App\Http\Controllers;

use App\Models\Pengelola;
use App\Models\Ulasan;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UlasanController extends Controller
{

    public function index($id)
    {
        $destinasi = Pengelola::with(['desa', 'kecamatan', 'highlights', 'fasilitas'])
        ->where('status', 'approved')
        ->findOrFail($id);

        $ulasan = Ulasan::with(['pengelola', 'user'])->where('pengelola_id', $id)->orderBy('created_at', 'desc')->paginate(5);
        $avgulasan = Ulasan::where('pengelola_id', $id)->avg('rating');
        $banyakulasan = Ulasan::where('pengelola_id', $id)->count();
        return view('destinasi.storeulasan', compact('destinasi', 'ulasan', 'avgulasan', 'banyakulasan'));
    }

    public function store(Request $request,$id)
    {
        $user_id = Auth::user()->id;

        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'ulasan' => 'required|string|max:1000',
        ]);

        Ulasan::create([
            'pengelola_id' => $id,
            'user_id' => $user_id,
            'rating'  => $request->rating,
            'ulasan'  => $request->ulasan
        ]);

        return redirect()->route('ulasan.show', $id)->with('success', 'Ulasan berhasil dikirim!');
    }

    public function show(string $id)
    {
        $destinasi = Pengelola::with(['desa', 'kecamatan', 'highlights', 'fasilitas'])
            ->where('status', 'approved')
            ->findOrFail($id);

        $ulasan = Ulasan::with(['pengelola', 'user'])->where('pengelola_id', $id)->orderBy('created_at', 'desc')->paginate(3);
        $avgulasan = Ulasan::where('pengelola_id', $id)->avg('rating');
        $banyakulasan = Ulasan::where('pengelola_id', $id)->count();
        return view('destinasi.ulasan', compact('destinasi', 'ulasan', 'avgulasan', 'banyakulasan'));
    }
}
