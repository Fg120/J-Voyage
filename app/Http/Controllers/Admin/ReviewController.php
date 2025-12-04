<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pengelola;
use App\Models\Ulasan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(){
        $ulasan = Ulasan::with(['pengelola', 'user'])->latest()->paginate(5);
        $banyakpengelola = Pengelola::count();
        $banyakulasan = Ulasan::count();

        return view('admin.review.index', compact('ulasan', 'banyakpengelola', 'banyakulasan'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $ulasan = Ulasan::with(['pengelola', 'user'])->findOrFail($id);

        return view('admin.review.show', compact('ulasan'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $ulasan = Ulasan::findOrFail($id);
        $ulasan->delete();

        return redirect()->route('admin.review.index')->with('success', 'Ulasan berhasil dihapus karena melanggar ketentuan.');
    }
}
