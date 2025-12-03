<?php

namespace App\Http\Controllers\Pengelola;

use App\Http\Controllers\Controller;
use App\Models\Fasilitas;
use Illuminate\Http\Request;

class FasilitasController extends Controller
{
    public function index()
    {
        $fasilitas = auth()->user()->pengelola->fasilitas()->latest()->get();

        return view('pengelola.fasilitas.index', compact('fasilitas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
        ]);

        auth()->user()->pengelola->fasilitas()->create([
            'nama' => $request->nama,
        ]);

        return redirect()->route('pengelola.fasilitas.index')
            ->with('success', 'Fasilitas berhasil ditambahkan!');
    }

    public function update(Request $request, Fasilitas $fasilita)
    {
        // Ensure the fasilitas belongs to the logged-in pengelola
        if ($fasilita->pengelola_id !== auth()->user()->pengelola->id) {
            abort(403);
        }

        $request->validate([
            'nama' => 'required|string|max:255',
        ]);

        $fasilita->update([
            'nama' => $request->nama,
        ]);

        return redirect()->route('pengelola.fasilitas.index')
            ->with('success', 'Fasilitas berhasil diperbarui!');
    }

    public function destroy(Fasilitas $fasilita)
    {
        // Ensure the fasilitas belongs to the logged-in pengelola
        if ($fasilita->pengelola_id !== auth()->user()->pengelola->id) {
            abort(403);
        }

        $fasilita->delete();

        return redirect()->route('pengelola.fasilitas.index')
            ->with('success', 'Fasilitas berhasil dihapus!');
    }
}
