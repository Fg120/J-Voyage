<?php

namespace App\Http\Controllers;

use App\Models\Pengelola;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $destinasi = Pengelola::with(['desa', 'kecamatan'])
            ->where('status', 'approved')
            ->latest()
            ->get();

        return view('onboarding', compact('destinasi'));
    }

    public function show($id)
    {
        $destinasi = Pengelola::with(['desa', 'kecamatan', 'highlights', 'fasilitas'])
            ->where('status', 'approved')
            ->findOrFail($id);

        return view('destinasi.show', compact('destinasi'));
    }
}
