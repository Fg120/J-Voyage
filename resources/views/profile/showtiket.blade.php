@extends('layouts.public.sub')

@section('content')
<div class="bg-[#FAFAFA] min-h-screen font-poppins pb-20">

    <div class="bg-neutral-900 text-white py-4 px-4 lg:px-24 sticky top-0 z-50">
        <a href="{{ route('profile.history') }}" class="inline-flex items-center gap-2 text-[#404040] hover:text-indigo-400 transition">
            <div class="border-2 border-white/20 rounded-full p-1">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M19 12H5"/>
                    <path d="m12 19-7-7 7-7"/>
                </svg>
            </div>
            <span class="font-semibold text-white">Kembali</span>
        </a>
    </div>

    <div class="flex flex-col items-center mx-auto w-full max-w-2xl mt-5 px-4">

        <div class="w-full bg-white rounded-[30px] shadow-2xl overflow-hidden relative">

            {{-- 1. BAGIAN ATAS (BIRU) --}}
            <div class="bg-[#5D5FEF] p-6 pb-24 md:p-8 md:pb-28 relative"> {{-- pb-24 ditambahkan agar ada ruang untuk QR Code --}}

                {{-- Header Info: Logo & Booking ID --}}
                <div class="flex justify-between items-start mb-6 text-white">
                    <div class="flex items-center gap-3">
                        <div class="bg-white/20 p-2 rounded-full backdrop-blur-sm">
                            <img class="w-6 h-6 object-contain" src="{{ asset('assets/images/logo.png') }}" alt="Logo">
                        </div>
                        <div>
                            <h1 class="font-bold text-lg leading-none">J-Voyage</h1>
                            <span class="text-[10px] text-indigo-100">E-Ticket Wisata</span>
                        </div>
                    </div>
                    <div class="text-right">
                        <span class="block text-[10px] text-indigo-200 uppercase tracking-wider">Transaksi ID</span>
                        <span class="font-bold text-base tracking-widest">{{ $transaksi->id}}</span>
                    </div>
                </div>

                {{-- Hero Image --}}
                <div class="w-full h-40 md:h-48 rounded-2xl overflow-hidden shadow-lg mb-4 relative border-2 border-white/10">
                    <img src="{{ Storage::url($transaksi->pengelola->foto_wisata) }}" alt="{{ $transaksi->pengelola->nama_wisata }}" class="w-full h-full object-cover">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent"></div>
                </div>

                {{-- Judul Wisata & Lokasi --}}
                <div class="text-white relative z-10">
                    <h2 class="text-2xl md:text-3xl font-bold mb-1">{{$transaksi->pengelola->nama_wisata}}</h2>
                    <div class="flex items-center gap-1.5 text-indigo-100 text-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 0 1 16 0Z"/><circle cx="12" cy="10" r="3"/></svg>
                        <span>{{ $transaksi->pengelola->alamat_wisata }}</span>
                    </div>
                </div>
            </div>

            <div class="relative -mt-20 z-20 flex flex-col items-center justify-center">
                <div class="bg-white p-3 rounded-2xl shadow-xl border border-gray-100">
                    <div class="bg-gray-200 w-40 h-40 rounded-xl flex items-center justify-center overflow-hidden">
                        <img src="data:image/svg+xml;base64,{{ base64_encode(QrCode::format('svg')->size(150)->generate(route('scan.tiket', encrypt($transaksi->kode)))) }}">
                    </div>
                </div>
                <div class="mt-2 text-center bg-white/80 backdrop-blur px-4 py-1 rounded-full shadow-sm">
                    <p class="text-xs text-gray-500">Kode Tiket</p>
                    <p class="font-bold text-gray-800 tracking-wider">{{ $transaksi->kode ?? 'Belum Ada' }}</p>
                </div>
            </div>

            {{-- 3. DETAIL INFORMASI --}}
            <div class="px-6 pt-6 pb-8 md:px-10">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-y-6 gap-x-4">

                    {{-- Tanggal --}}
                    <div class="flex items-center gap-4">
                        <div class="bg-indigo-50 text-[#5D5FEF] p-2.5 rounded-full shrink-0">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
                        </div>
                        <div>
                            <p class="text-gray-400 text-[10px] uppercase tracking-wider mb-0.5">Tanggal Kunjungan</p>
                            <p class="font-bold text-gray-800 text-sm">
                                {{ \Carbon\Carbon::parse($transaksi->tanggal_kunjungan)->locale('id')->isoFormat('dddd, D MMMM Y') }}
                            </p>
                        </div>
                    </div>

                    {{-- Jumlah Orang --}}
                    <div class="flex items-center gap-4">
                        <div class="bg-indigo-50 text-[#5D5FEF] p-2.5 rounded-full shrink-0">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" /></svg>
                        </div>
                        <div>
                            <p class="text-gray-400 text-[10px] uppercase tracking-wider mb-0.5">Jumlah Pengunjung</p>
                            <p class="font-bold text-gray-800 text-sm">{{ $transaksi->jumlah }} Orang</p>
                        </div>
                    </div>

                    {{-- Nama Pemesan --}}
                    <div class="flex items-center gap-4">
                        <div class="bg-indigo-50 text-[#5D5FEF] p-2.5 rounded-full shrink-0">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" /></svg>
                        </div>
                        <div>
                            <p class="text-gray-400 text-[10px] uppercase tracking-wider mb-0.5">Nama Pemesan</p>
                            <p class="font-bold text-gray-800 text-sm">{{ $transaksi->nama }}</p>
                        </div>
                    </div>

                    {{-- Total Pembayaran --}}
                    <div class="flex items-center gap-4">
                        <div class="bg-indigo-50 text-[#5D5FEF] p-2.5 rounded-full shrink-0">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                        </div>
                        <div>
                            <p class="text-gray-400 text-[10px] uppercase tracking-wider mb-0.5">Total Pembayaran</p>
                            <p class="font-bold text-gray-800 text-sm">Rp {{ number_format($transaksi->total_harga, 0, ',', '.') }}</p>
                        </div>
                    </div>

                </div>

                {{-- 4. INFORMASI PENTING (KOTAK KUNING) --}}
                <div class="mt-8 bg-yellow-50 border border-yellow-100 rounded-xl p-5">
                    <h4 class="font-bold text-sm text-yellow-800 mb-2">Informasi Penting:</h4>
                    <ul class="text-xs text-neutral-600 space-y-1.5 list-disc list-inside">
                        <li>Tunjukkan QR Code atau Kode Tiket ini saat check-in</li>
                        <li>Tiket berlaku untuk tanggal yang tertera</li>
                        <li>Datang 15 menit sebelum waktu kunjungan</li>
                        <li>Simpan tiket ini dengan baik</li>
                    </ul>
                </div>

                {{-- 5. TOMBOL DOWNLOAD --}}
                <div class="mt-6">
                    <button onclick="//window.print()" class="w-full flex justify-center items-center gap-2 bg-gray-100 hover:bg-gray-200 text-neutral-800 font-bold py-4 rounded-xl transition duration-300">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" x2="12" y1="15" y2="3"/></svg>
                        Download Tiket
                    </button>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
