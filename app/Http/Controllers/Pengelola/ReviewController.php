<?php

namespace App\Http\Controllers\Pengelola;

use App\Http\Controllers\Controller;
use App\Models\Ulasan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function index(){
        $id = Auth::user()->pengelola->id;
        $ulasan = Ulasan::with(['pengelola', 'user'])->where('pengelola_id', $id)->orderBy('created_at', 'desc')->paginate(5);
        $avgulasan = Ulasan::where('pengelola_id', $id)->avg('rating');
        $banyakulasan = Ulasan::where('pengelola_id', $id)->count();

        return view('pengelola.review.index', compact('ulasan', 'avgulasan', 'banyakulasan'));
    }
}
