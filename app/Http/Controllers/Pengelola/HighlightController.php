<?php

namespace App\Http\Controllers\Pengelola;

use App\Http\Controllers\Controller;
use App\Models\Highlight;
use Illuminate\Http\Request;

class HighlightController extends Controller
{
    public function index()
    {
        $highlights = auth()->user()->pengelola->highlights()->latest()->get();

        return view('pengelola.highlight.index', compact('highlights'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
        ]);

        auth()->user()->pengelola->highlights()->create([
            'nama' => $request->nama,
        ]);

        return redirect()->route('pengelola.highlight.index')
            ->with('success', 'Highlight berhasil ditambahkan!');
    }

    public function update(Request $request, Highlight $highlight)
    {
        // Ensure the highlight belongs to the logged-in pengelola
        if ($highlight->pengelola_id !== auth()->user()->pengelola->id) {
            abort(403);
        }

        $request->validate([
            'nama' => 'required|string|max:255',
        ]);

        $highlight->update([
            'nama' => $request->nama,
        ]);

        return redirect()->route('pengelola.highlight.index')
            ->with('success', 'Highlight berhasil diperbarui!');
    }

    public function destroy(Highlight $highlight)
    {
        // Ensure the highlight belongs to the logged-in pengelola
        if ($highlight->pengelola_id !== auth()->user()->pengelola->id) {
            abort(403);
        }

        $highlight->delete();

        return redirect()->route('pengelola.highlight.index')
            ->with('success', 'Highlight berhasil dihapus!');
    }
}
