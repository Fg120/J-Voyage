<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pengelola;
use App\Models\Transaksi;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {

        $totalUser = User::count();
        $totalWisata = Pengelola::count();
        $totalTransaksi = Transaksi::where('status', 'verified')->count();
        $wisataPerluVerifikasi = Pengelola::where('status', 'pending')->count();

        $transaksiBulanan = Transaksi::selectRaw('MONTH(created_at) as bulan, COUNT(*) as total')
            ->where('status', 'verified')
            ->whereYear('created_at', date('Y'))
            ->groupBy('bulan')
            ->pluck('total', 'bulan')
            ->toArray();

        $chartTransaksiData = [];
        $chartBulanLabel = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'];

        for ($i = 1; $i <= 12; $i++) {
            $chartTransaksiData[] = $transaksiBulanan[$i] ?? 0;
        }

        $userRoles = User::with('roles')->get()->groupBy(function($user) {
            return $user->getRoleNames()->first() ?? 'Tanpa Role';
        });

        $chartUserLabels = [];
        $chartUserData = [];

        foreach ($userRoles as $role => $users) {
            $chartUserLabels[] = ucfirst($role);
            $chartUserData[] = $users->count();
        }

        return view('admin.dashboard', compact(
            'totalUser',
            'totalWisata',
            'totalTransaksi',
            'wisataPerluVerifikasi',
            'chartTransaksiData',
            'chartBulanLabel',
            'chartUserLabels',
            'chartUserData'
        ));
    }
}
