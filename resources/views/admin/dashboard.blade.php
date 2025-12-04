@extends('layouts.admin.app')

@section('content')
    <div class="space-y-8 pb-10">

        {{-- HEADER --}}
        <div class="mb-6">
            <h1 class="text-2xl font-bold text-gray-900">Dashboard Admin</h1>
            <p class="mt-1 text-sm text-gray-500">
                Selamat Datang, Pantau Statistik Website Saat ini,
                {{ \Carbon\Carbon::now()->locale('id')->isoFormat('dddd, D MMMM Y') }}.
            </p>
        </div>

        {{-- STATISTIK KARTU (4 KOTAK) --}}
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-5">

            <div class="bg-neutral-800 rounded-2xl shadow-lg p-6 border border-neutral-700">
                <div class="flex justify-between items-start">
                    <div>
                        <p class="text-sm font-medium text-neutral-400">Total User</p>
                        <p class="text-2xl font-bold text-white mt-2">{{ number_format($totalUser) }}</p>
                    </div>
                    <div class="p-3 bg-neutral-700 rounded-xl">
                        <i data-lucide="users" class="w-6 h-6 text-blue-400"></i>
                    </div>
                </div>
            </div>

            <div class="bg-neutral-800 rounded-2xl shadow-lg p-6 border border-neutral-700">
                <div class="flex justify-between items-start">
                    <div>
                        <p class="text-sm font-medium text-neutral-400">Total Wisata</p>
                        <p class="text-2xl font-bold text-indigo-400 mt-2">{{ number_format($totalWisata) }}</p>
                    </div>
                    <div class="p-3 bg-neutral-700 rounded-xl">
                        <i data-lucide="map" class="w-6 h-6 text-indigo-400"></i>
                    </div>
                </div>
            </div>

            <div class="bg-neutral-800 rounded-2xl shadow-lg p-6 border border-neutral-700">
                <div class="flex justify-between items-start">
                    <div>
                        <p class="text-sm font-medium text-neutral-400">Total Transaksi Masuk</p>
                        <p class="text-2xl font-bold text-white mt-2">{{ number_format($totalTransaksi) }}</p>
                    </div>
                    <div class="p-3 bg-neutral-700 rounded-xl">
                        <i data-lucide="check-circle" class="w-6 h-6 text-emerald-400"></i>
                    </div>
                </div>
            </div>

            <div class="bg-neutral-800 rounded-2xl shadow-lg p-6 border border-neutral-700">
                <div class="flex justify-between items-start">
                    <div>
                        <p class="text-sm font-medium text-orange-400">Wisata Perlu Verifikasi</p>
                        <p class="text-2xl font-bold text-orange-500 mt-2">{{ number_format($wisataPerluVerifikasi) }}</p>
                    </div>
                    <div class="p-3 bg-neutral-700 rounded-xl">
                        <i data-lucide="alert-circle" class="w-6 h-6 text-orange-500"></i>
                    </div>
                </div>
            </div>
        </div>

        {{-- GRAFIK VISUALISASI --}}
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

            <div class="lg:col-span-1">
                <x-donutchart title="Penyebaran User" :data="$chartUserData" :labels="$chartUserLabels" />
            </div>

            <div class="lg:col-span-2">
                <x-barchart title="Transaksi Masuk Bulanan" :data="$chartTransaksiData" :labels="$chartBulanLabel" />
            </div>
        </div>

    </div>
@endsection
