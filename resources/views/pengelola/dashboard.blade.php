@extends('layouts.admin.app')

@section('content')
    <div class="space-y-8 pb-10">

        {{-- BAGIAN 1: HEADER & STATISTIK HARIAN --}}
        <div>
            <div class="mb-6">
                <h1 class="text-2xl font-bold text-gray-900">Dashboard Pengelola</h1>
                <p class="mt-1 text-sm text-gray-500">Pantau performa wisata Anda hari ini,
                    {{ \Carbon\Carbon::now()->locale('id')->isoFormat('dddd, D MMMM Y') }}.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-5">
                <div
                    class="bg-neutral-800 rounded-2xl shadow-lg p-6 border border-neutral-700 transition hover:border-neutral-600">
                    <div class="flex justify-between items-start">
                        <div>
                            <p class="text-sm font-medium text-neutral-400">Pengunjung (Hari Ini)</p>
                            <p class="text-2xl font-bold text-white mt-2">{{ $dailyVisitors }}</p>
                        </div>
                        <div class="p-3 bg-neutral-700 rounded-xl">
                            <i data-lucide="users" class="w-6 h-6 text-blue-400"></i>
                        </div>
                    </div>
                </div>

                <div
                    class="bg-neutral-800 rounded-2xl shadow-lg p-6 border border-neutral-700 transition hover:border-neutral-600">
                    <div class="flex justify-between items-start">
                        <div>
                            <p class="text-sm font-medium text-neutral-400">Pendapatan (Hari Ini)</p>
                            <p class="text-2xl font-bold text-indigo-400 mt-2">
                                Rp {{ number_format($dailyRevenue, 0, ',', '.') }}
                            </p>
                        </div>
                        <div class="p-3 bg-neutral-700 rounded-xl">
                            <i data-lucide="wallet" class="w-6 h-6 text-indigo-400"></i>
                        </div>
                    </div>
                </div>

                <div
                    class="bg-neutral-800 rounded-2xl shadow-lg p-6 border border-neutral-700 transition hover:border-neutral-600">
                    <div class="flex justify-between items-start">
                        <div>
                            <p class="text-sm font-medium text-neutral-400">Transaksi Sukses</p>
                            <p class="text-2xl font-bold text-white mt-2">{{ $dailyTransaction }}</p>
                        </div>
                        <div class="p-3 bg-neutral-700 rounded-xl">
                            <i data-lucide="check-circle" class="w-6 h-6 text-emerald-400"></i>
                        </div>
                    </div>
                </div>

                <div
                    class="bg-neutral-800 rounded-2xl shadow-lg p-6 border border-neutral-700 transition hover:border-neutral-600">
                    <div class="flex justify-between items-start">
                        <div>
                            <p class="text-sm font-medium text-orange-400">Perlu Verifikasi</p>
                            <p class="text-2xl font-bold text-orange-500 mt-2">{{ $pendingTransaction }}</p>
                        </div>
                        <div class="p-3 bg-neutral-700 rounded-xl">
                            <i data-lucide="alert-circle" class="w-6 h-6 text-orange-500"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- DIVIDER --}}
        <hr class="border-neutral-300 border-dashed opacity-50">

        {{-- BAGIAN 2: LAPORAN BERKALA (FILTER) --}}
        <div>
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-6">

                {{-- Label Judul Dinamis --}}
                <div>
                    <h2 class="text-lg font-bold text-gray-800 flex items-center gap-2">
                        <span class="w-1.5 h-6 bg-indigo-600 rounded-full"></span>
                        Laporan Berkala
                    </h2>
                    <p class="text-sm text-gray-500 mt-1 ml-3.5">
                        Data: <span class="font-semibold text-indigo-600">{{ $labelFilter }}</span>
                    </p>
                </div>

                {{-- FORM FILTER (DROPDOWN DARK) --}}
                <div class="bg-neutral-800 p-1.5 rounded-xl shadow-sm border border-neutral-700">
                    <form method="GET" action="{{ route('pengelola.dashboard') }}" class="flex items-center">
                        {{-- Select diganti style gelap --}}
                        <select name="filter" onchange="this.form.submit()"
                            class="text-sm font-semibold text-neutral-200 border-none focus:ring-0 cursor-pointer bg-transparent py-2 pl-3 pr-8 rounded-lg hover:bg-neutral-700 transition">
                            <option value="mingguan" {{ $filter == 'mingguan' ? 'selected' : '' }} class="bg-neutral-800">
                                Minggu Ini</option>
                            <option value="bulanan" {{ $filter == 'bulanan' ? 'selected' : '' }} class="bg-neutral-800">
                                Bulan Ini</option>
                            <option value="tahunan" {{ $filter == 'tahunan' ? 'selected' : '' }} class="bg-neutral-800">
                                Tahun Ini</option>
                            <option value="keseluruhan" {{ $filter == 'keseluruhan' ? 'selected' : '' }}
                                class="bg-neutral-800">Semua Waktu</option>
                        </select>
                    </form>
                </div>
            </div>

            {{-- Cards Hasil Filter (Style Dark) --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
                <div
                    class="bg-neutral-800 rounded-2xl shadow-lg p-6 border border-neutral-700 group transition hover:border-indigo-500/50">
                    <div class="flex justify-between items-start">
                        <div>
                            <p class="text-sm font-medium text-neutral-400">Total Pengunjung</p>
                            <p class="text-3xl font-bold text-white mt-2">{{ $filteredVisitors }}</p>
                            <p class="text-xs text-neutral-500 mt-1">Pada periode ini</p>
                        </div>
                        <div class="p-3 bg-neutral-700 rounded-xl group-hover:bg-indigo-900/30 transition">
                            <i data-lucide="users" class="w-6 h-6 text-indigo-400"></i>
                        </div>
                    </div>
                </div>

                <div
                    class="bg-neutral-800 rounded-2xl shadow-lg p-6 border border-neutral-700 group transition hover:border-emerald-500/50">
                    <div class="flex justify-between items-start">
                        <div>
                            <p class="text-sm font-medium text-neutral-400">Total Pendapatan</p>
                            <p class="text-3xl font-bold text-white mt-2">
                                Rp {{ number_format($filteredRevenue, 0, ',', '.') }}
                            </p>
                            <p class="text-xs text-neutral-500 mt-1">Pada periode ini</p>
                        </div>
                        <div class="p-3 bg-neutral-700 rounded-xl group-hover:bg-emerald-900/30 transition">
                            <i data-lucide="dollar-sign" class="w-6 h-6 text-emerald-400"></i>
                        </div>
                    </div>
                </div>

                <div
                    class="bg-neutral-800 rounded-2xl shadow-lg p-6 border border-neutral-700 group transition hover:border-blue-500/50">
                    <div class="flex justify-between items-start">
                        <div>
                            <p class="text-sm font-medium text-neutral-400">Total Transaksi</p>
                            <p class="text-3xl font-bold text-white mt-2">{{ $filteredTransaction }}</p>
                            <p class="text-xs text-neutral-500 mt-1">Berhasil dibayar</p>
                        </div>
                        <div class="p-3 bg-neutral-700 rounded-xl group-hover:bg-blue-900/30 transition">
                            <i data-lucide="receipt" class="w-6 h-6 text-blue-400"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- BAGIAN 3: GRAFIK DINAMIS --}}
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 pt-2">

            {{-- Grafik 1: Pendapatan --}}
            <x-barchart title="Grafik Pendapatan" :data="$chartRevenue" :labels="$chartLabels" />

            {{-- Grafik 2: Pengunjung --}}
            <x-barchart title="Grafik Pengunjung" :data="$chartVisitors" :labels="$chartLabels" />

        </div>

    </div>
@endsection
