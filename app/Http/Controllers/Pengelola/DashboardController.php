<?php

namespace App\Http\Controllers\Pengelola;

use App\Http\Controllers\Controller;
use App\Models\Transaksi;
use Carbon\Carbon;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        // 1. Validasi Pengelola
        $pengelola = Auth::user()->pengelola;
        if (!$pengelola) {
            return redirect()->back()->with('error', 'Akun Anda belum terdaftar sebagai pengelola.');
        }
        $id = $pengelola->id;

        // ==========================================
        // BAGIAN 1: STATISTIK HARIAN (REALTIME HARI INI)
        // ==========================================
        $today = Carbon::today(); // Mengambil jam 00:00:00 hari ini

        // A. Pengunjung Hari Ini (Berdasarkan tanggal kunjungan tiket)
        $dailyVisitors = Transaksi::where('pengelola_id', $id)
            ->where('status', 'verified')
            ->whereDate('tanggal_kunjungan', $today)
            ->sum('jumlah');

        // B. Pendapatan Hari Ini (Uang masuk hari ini / created_at)
        $dailyRevenue = Transaksi::where('pengelola_id', $id)
            ->where('status', 'verified')
            ->whereDate('created_at', $today)
            ->sum('total_harga');

        // C. Transaksi Sukses Hari Ini (Jumlah invoice lunas hari ini)
        $dailyTransaction = Transaksi::where('pengelola_id', $id)
            ->where('status', 'verified')
            ->whereDate('created_at', $today)
            ->count();

        // D. Menunggu Persetujuan (Akumulasi semua yang pending, bukan cuma hari ini)
        // Ini penting agar pengelola sadar ada tunggakan verifikasi
        $pendingTransaction = Transaksi::where('pengelola_id', $id)
            ->where('status', 'pending')
            ->count();


        // ==========================================
        // BAGIAN 2: LOGIKA FILTER (DINAMIS)
        // ==========================================
        $filter = $request->input('filter', 'bulanan'); // Default filter
        $tahun = $request->input('year', date('Y'));
        $bulan = $request->input('month', date('m'));

        // Base Query
        $query = Transaksi::where('pengelola_id', $id)->where('status', 'verified');

        // Variabel Data Chart
        $chartLabels = [];
        $chartRevenue = [];
        $chartVisitors = [];
        $labelFilter = "";

        switch ($filter) {
            // --- KASUS 1: MINGGUAN (Tampil Grafik Harian: Senin-Minggu) ---
            case 'mingguan':
                // Ambil input tanggal spesifik dari user, atau pakai hari ini
                $inputDate = $request->has('day')
                    ? Carbon::createFromDate($tahun, $bulan, $request->day)
                    : Carbon::now();

                $startOfWeek = $inputDate->copy()->startOfWeek();
                $endOfWeek   = $inputDate->copy()->endOfWeek();

                // Filter Query Utama
                $query->whereBetween('created_at', [$startOfWeek, $endOfWeek]);
                $labelFilter = "Minggu (" . $startOfWeek->format('d M') . " - " . $endOfWeek->format('d M') . ")";

                // Isi Grafik (Loop Senin - Minggu)
                $currentDate = $startOfWeek->copy();
                while ($currentDate <= $endOfWeek) {
                    $dateString = $currentDate->format('Y-m-d');

                    $rev = Transaksi::where('pengelola_id', $id)->where('status', 'verified')
                            ->whereDate('created_at', $dateString)->sum('total_harga');
                    $vis = Transaksi::where('pengelola_id', $id)->where('status', 'verified')
                            ->whereDate('created_at', $dateString)->sum('jumlah');

                    $chartLabels[] = $currentDate->locale('id')->isoFormat('dddd'); // Senin
                    $chartRevenue[] = $rev;
                    $chartVisitors[] = $vis;

                    $currentDate->addDay();
                }
                break;

            // --- KASUS 2: TAHUNAN (Tampil Grafik Bulanan: Jan-Des) ---
            case 'tahunan':
                $query->whereYear('created_at', $tahun);
                $labelFilter = "Tahun " . $tahun;

                // Query Agregat Cepat
                $revPerMonth = Transaksi::selectRaw('MONTH(created_at) as bulan, SUM(total_harga) as total')
                    ->where('pengelola_id', $id)->where('status', 'verified')->whereYear('created_at', $tahun)
                    ->groupBy('bulan')->pluck('total', 'bulan')->toArray();

                $visPerMonth = Transaksi::selectRaw('MONTH(created_at) as bulan, SUM(jumlah) as total')
                    ->where('pengelola_id', $id)->where('status', 'verified')->whereYear('created_at', $tahun)
                    ->groupBy('bulan')->pluck('total', 'bulan')->toArray();

                for ($i = 1; $i <= 12; $i++) {
                    $chartLabels[] = DateTime::createFromFormat('!m', $i)->format('M'); // Jan
                    $chartRevenue[] = $revPerMonth[$i] ?? 0;
                    $chartVisitors[] = $visPerMonth[$i] ?? 0;
                }
                break;

            // --- KASUS 3: KESELURUHAN (Tampil Grafik Tahunan: 2024, 2025...) ---
            case 'keseluruhan':
                $labelFilter = "Semua Waktu";

                $yearsData = Transaksi::selectRaw('YEAR(created_at) as tahun, SUM(total_harga) as revenue, SUM(jumlah) as visitors')
                    ->where('pengelola_id', $id)->where('status', 'verified')
                    ->groupBy('tahun')->orderBy('tahun', 'asc')->get();

                if ($yearsData->isEmpty()) {
                    $chartLabels[] = date('Y'); $chartRevenue[] = 0; $chartVisitors[] = 0;
                } else {
                    foreach ($yearsData as $data) {
                        $chartLabels[] = $data->tahun;
                        $chartRevenue[] = $data->revenue;
                        $chartVisitors[] = $data->visitors;
                    }
                }
                break;

            // --- KASUS 4: BULANAN (Default - Tampil Grafik Mingguan: Minggu 1-4) ---
            case 'bulanan':
            default:
                $query->whereYear('created_at', $tahun)->whereMonth('created_at', $bulan);
                $labelFilter = "Bulan " . date('F', mktime(0, 0, 0, $bulan, 10)) . " " . $tahun;

                // Bagi bulan jadi 4 periode
                $periods = [
                    ['start' => 1, 'end' => 7, 'label' => 'Minggu 1'],
                    ['start' => 8, 'end' => 14, 'label' => 'Minggu 2'],
                    ['start' => 15, 'end' => 21, 'label' => 'Minggu 3'],
                    ['start' => 22, 'end' => 31, 'label' => 'Minggu 4+'],
                ];

                foreach ($periods as $period) {
                    $rev = Transaksi::where('pengelola_id', $id)->where('status', 'verified')
                            ->whereYear('created_at', $tahun)->whereMonth('created_at', $bulan)
                            ->whereDay('created_at', '>=', $period['start'])
                            ->whereDay('created_at', '<=', $period['end'])
                            ->sum('total_harga');

                    $vis = Transaksi::where('pengelola_id', $id)->where('status', 'verified')
                            ->whereYear('created_at', $tahun)->whereMonth('created_at', $bulan)
                            ->whereDay('created_at', '>=', $period['start'])
                            ->whereDay('created_at', '<=', $period['end'])
                            ->sum('jumlah');

                    $chartLabels[] = $period['label'];
                    $chartRevenue[] = $rev;
                    $chartVisitors[] = $vis;
                }
                break;
        }

        // Hitung Total Statistik Card (Berdasarkan Filter)
        $filteredRevenue = (clone $query)->sum('total_harga');
        $filteredTransaction = (clone $query)->count();
        $filteredVisitors = (clone $query)->sum('jumlah');

        return view('pengelola.dashboard', compact(
            'dailyVisitors', 'dailyRevenue', 'dailyTransaction', 'pendingTransaction',
            'filter', 'labelFilter', 'filteredRevenue', 'filteredTransaction', 'filteredVisitors',
            'chartLabels', 'chartRevenue', 'chartVisitors'
        ));
    }
}
