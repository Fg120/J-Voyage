<?php

namespace App\Http\Controllers\Pengelola;

use App\Http\Controllers\Controller;
use App\Models\Transaksi;
use Carbon\Carbon;
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

        $tahun = $request->input('year',date('Y'));
        $bulan = $request->input('Month',date('m'));
        $tanggal = $request->input('date',date('d'));

        // per hari

        $pengunjunghari = Transaksi::where('pengelola_id', $id)->whereYear('created_at', $tahun)
        ->whereMonth('created_at', $bulan)
        ->whereDay('tanggal_kunjungan', $tanggal)
        ->where('status','verified')
        ->sum('jumlah');

        $transaksidisetujuihari = Transaksi::where('pengelola_id', $id)->whereYear('created_at', $tahun)
        ->whereMonth('created_at', $bulan)
        ->whereDay('created_at', $tanggal)
        ->where('status','verified')
        ->count();

        $pendapatanhari = Transaksi::where('pengelola_id', $id)->where('status','verified')
        ->whereYear('created_at', $tahun)
        ->whereMonth('created_at', $bulan)
        ->whereDay('created_at', $tanggal)
        ->sum('total_harga');
        $dateReference = Carbon::createFromDate($tahun, $bulan, $tanggal);
        $startOfWeek = $dateReference->copy()->startOfWeek();
        $endOfWeek   = $dateReference->copy()->endOfWeek();

        // 2. Query Pengunjung (Berdasarkan tanggal_kunjungan)
        $pengunjungminggu = Transaksi::where('pengelola_id', $id)
            ->whereBetween('tanggal_kunjungan', [$startOfWeek, $endOfWeek])
            ->where('status', 'verified')
            ->sum('jumlah');

        // 3. Query Jumlah Transaksi (Berdasarkan created_at / kapan bayar)
        $transaksidisetujuiminggu = Transaksi::where('pengelola_id', $id)
            ->whereBetween('created_at', [$startOfWeek, $endOfWeek])
            ->where('status', 'verified')
            ->count();

        $pendapatanminggu = Transaksi::where('pengelola_id', $id)
            ->where('status', 'verified')
            ->whereBetween('created_at', [$startOfWeek, $endOfWeek])
            ->sum('total_harga');

        // per Bulan
        $pengunjungbulan = Transaksi::where('pengelola_id', $id)->whereYear('created_at', $tahun)
        ->whereMonth('created_at', $bulan)
        ->where('status','verified')
        ->sum('jumlah');

        $transaksidisetujuibulan = Transaksi::where('pengelola_id', $id)->whereYear('created_at', $tahun)
        ->whereMonth('created_at', $bulan)
        ->where('status','verified')
        ->count();

        $pendapatanbulan = Transaksi::where('pengelola_id', $id)->where('status','verified')
        ->whereYear('created_at', $tahun)
        ->whereMonth('created_at', $bulan)
        ->sum('total_harga');

        // per Tahun
        $belumdisetujui = Transaksi::where('pengelola_id', $id)->where('status','pending')->count();
        $transaksiberhasil = Transaksi::where('pengelola_id', $id)->where('status','verified')->count();
        $transaksiberhasil = Transaksi::where('pengelola_id', $id)->where('status','verified')->count();

        $jumlahpengunjung = Transaksi::where('pengelola_id', $id)->where('status','verified')->sum('jumlah');

        $pendapatan = Transaksi::where('pengelola_id', $id)->where('status','verified')->sum('total_harga');


    // Revenue
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

        return view ('pengelola.dashboard', compact('jumlahpengunjung', 'belumdisetujui', 'pendapatan', 'transaksiberhasil', 'dataChart', 'tahun','datapengunjungperbulan', 'transaksidisetujuihari', 'pengunjunghari', 'pendapatanhari','transaksidisetujuiminggu', 'pengunjungminggu', 'pendapatanminggu', 'pengunjungbulan', 'transaksidisetujuibulan', 'pendapatanbulan'));
    }
}
