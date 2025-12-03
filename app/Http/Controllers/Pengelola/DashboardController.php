<?php

namespace App\Http\Controllers\Pengelola;

use App\Http\Controllers\Controller;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function index(Request $request)
    {
        $pengelola = Auth::user()->pengelola;
        $id = $pengelola->id;
        $jumlahpengunjung = Transaksi::where('pengelola_id', $id)->where('status','verified')->sum('jumlah');
        $belumdisetujui = Transaksi::where('pengelola_id', $id)->where('status','pending')->count();
        $pendapatan = Transaksi::where('pengelola_id', $id)->where('status','verified')->sum('total_harga');
        $transaksiberhasil = Transaksi::where('pengelola_id', $id)->where('status','verified')->count();

        $tahun = $request->input('year', date('Y'));

    // REvenue
    $pendapatanPerBulan = Transaksi::selectRaw('MONTH(created_at) as bulan, SUM(total_harga) as total')
        ->where('pengelola_id', $id)
        ->where('status', 'verified')
        ->whereYear('created_at', $tahun)
        ->groupBy('bulan')
        ->orderBy('bulan')
        ->pluck('total', 'bulan')
        ->toArray();

    $pengunjungperbulan = Transaksi::selectRaw('MONTH(created_at) as bulan, SUM(jumlah) as total')
        ->where('pengelola_id', $id)
        ->where('status', 'verified')
        ->whereYear('created_at', $tahun)
        ->groupBy('bulan')
        ->orderBy('bulan')
        ->pluck('total', 'bulan')
        ->toArray();

    $datapengunjungperbulan =[];
    $dataChart = [];
    for ($i = 1; $i <= 12; $i++) {
        $dataChart[] = $pendapatanPerBulan[$i] ?? 0;
        $datapengunjungperbulan[] = $pengunjungperbulan[$i] ??0;
    }

        return view ('pengelola.dashboard', compact('jumlahpengunjung', 'belumdisetujui', 'pendapatan', 'transaksiberhasil', 'dataChart', 'tahun','datapengunjungperbulan'));
    }
}
