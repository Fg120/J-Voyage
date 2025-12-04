@extends('layouts.public.sub', ['backUrl' => route('profile.history')])

@section('content')
    <div class="bg-[#FAFAFA] min-h-screen font-poppins ">

        <div class="flex flex-col mx-auto w-full max-w-4xl mt-5 px-4">
            <h3 class="font-bold text-2xl md:text-4xl text-[#171717] mt-7 mb-6">Detail Transaksi</h3>

            {{-- 2. Content E-Ticket --}}
            <div class="flex justify-center items-center">

                {{-- Card Container --}}
                <div class="w-full max-w-4xl bg-white rounded-[30px] shadow-2xl overflow-hidden border border-gray-100">

                    {{-- A. BAGIAN ATAS (HEADER) --}}
                    {{-- PERUBAHAN DISINI: Menggunakan Gradient Ungu --}}
                    <div class="bg-gradient-to-br from-indigo-600 to-violet-700 p-6 md:p-10 relative overflow-hidden">

                        {{-- Hiasan Background Pattern (Opsional agar lebih cantik) --}}
                        <div
                            class="absolute top-0 right-0 -mt-10 -mr-10 w-40 h-40 bg-white/10 rounded-full blur-2xl pointer-events-none">
                        </div>
                        <div
                            class="absolute bottom-0 left-0 -mb-10 -ml-10 w-40 h-40 bg-white/10 rounded-full blur-2xl pointer-events-none">
                        </div>

                        {{-- Logo & Booking ID --}}
                        <div
                            class="relative z-10 flex flex-col md:flex-row justify-between items-start md:items-center mb-8 text-white">
                            <div class="flex items-center gap-3 mb-4 md:mb-0">
                                {{-- Icon Logo --}}
                                <div class="bg-white/20 p-2 rounded-xl backdrop-blur-sm border border-white/20">
                                    <img class="w-8 h-auto" src="{{ asset('assets/images/logo.png') }}" alt="Logo">
                                </div>
                                <div>
                                    <h1 class="font-bold text-xl leading-none tracking-tight">J-Voyage</h1>
                                    <span class="text-[11px] text-indigo-100 uppercase tracking-wider">Detail
                                        Transaksi</span>
                                </div>
                            </div>
                            <div
                                class="text-left md:text-right bg-white/10 md:bg-transparent p-3 md:p-0 rounded-lg w-full md:w-auto border border-white/10 md:border-none">
                                <span class="block text-[10px] text-indigo-200 uppercase tracking-wider">Transaksi ID</span>
                                <span class="font-mono font-bold text-lg tracking-widest">{{ $transaksi->id }}</span>
                            </div>
                        </div>

                        {{-- Konten Utama Header --}}
                        <div class="relative z-10 flex flex-col md:flex-row gap-6 items-center">
                            {{-- Hero Image --}}
                            <div
                                class="w-full md:w-1/3 h-48 md:h-40 rounded-2xl overflow-hidden shadow-lg border-2 border-white/20 shrink-0">
                                <img src="{{ Storage::url($transaksi->pengelola->foto_wisata) }}"
                                    alt="{{ $transaksi->pengelola->nama_wisata }}"
                                    class="w-full h-full object-cover transform hover:scale-110 transition duration-700">
                            </div>

                            {{-- Judul Wisata & Lokasi --}}
                            <div class="w-full text-white">
                                <h2 class="text-2xl md:text-4xl font-bold mb-3 leading-tight">
                                    {{ $transaksi->pengelola->nama_wisata }}</h2>
                                <div
                                    class="inline-flex items-center gap-2 bg-white/20 backdrop-blur-md px-4 py-2 rounded-full border border-white/10">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-indigo-200"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 0 1 16 0Z" />
                                        <circle cx="12" cy="10" r="3" />
                                    </svg>
                                    <span class="text-sm font-medium">{{ $transaksi->pengelola->alamat_wisata }}</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- B. BAGIAN BAWAH (DETAIL) --}}
                    <div class="p-6 md:p-10">
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-y-8 gap-x-6">

                            {{-- Item 1 --}}
                            <div class="flex items-start gap-4">
                                <div class="bg-indigo-50 text-indigo-600 p-3 rounded-2xl">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-gray-400 text-xs uppercase font-bold tracking-wider mb-1">Nama Pemesan
                                    </p>
                                    <p class="font-bold text-gray-800 text-lg">{{ $transaksi->nama }}</p>
                                </div>
                            </div>

                            {{-- Item 2 --}}
                            <div class="flex items-start gap-4">
                                <div class="bg-blue-50 text-blue-600 p-3 rounded-2xl">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-gray-400 text-xs uppercase font-bold tracking-wider mb-1">Tanggal
                                        Kunjungan</p>
                                    <p class="font-bold text-gray-800 text-lg">
                                        {{ \Carbon\Carbon::parse($transaksi->tanggal_kunjungan)->locale('id')->isoFormat('dddd, D MMMM Y') }}
                                    </p>
                                </div>
                            </div>

                            {{-- Item 3: Status --}}
                            <div class="flex items-start gap-4">
                                <div class="bg-purple-50 text-purple-600 p-3 rounded-2xl">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-gray-400 text-xs uppercase font-bold tracking-wider mb-1">Status</p>
                                    @if ($transaksi->status == 'pending')
                                        <span
                                            class="inline-block bg-orange-100 text-orange-600 px-3 py-1 rounded-lg text-xs font-bold uppercase tracking-wide">
                                            Menunggu Verifikasi
                                        </span>
                                    @elseif($transaksi->status == 'verified')
                                        <span
                                            class="inline-block bg-green-100 text-green-600 px-3 py-1 rounded-lg text-xs font-bold uppercase tracking-wide">
                                            Dikonfirmasi
                                        </span>
                                    @elseif($transaksi->status == 'rejected')
                                        <span
                                            class="inline-block bg-red-100 text-red-600 px-3 py-1 rounded-lg text-xs font-bold uppercase tracking-wide">
                                            Ditolak
                                        </span>
                                    @endif
                                </div>
                            </div>

                            {{-- Item 4 --}}
                            <div class="flex items-start gap-4">
                                <div class="bg-pink-50 text-pink-600 p-3 rounded-2xl">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-gray-400 text-xs uppercase font-bold tracking-wider mb-1">Jumlah
                                        Pengunjung</p>
                                    <p class="font-bold text-gray-800 text-lg">{{ $transaksi->jumlah }} Orang</p>
                                </div>
                            </div>

                            {{-- Item 5: Total Pembayaran --}}
                            <div class="flex items-start gap-4">
                                <div class="bg-emerald-50 text-emerald-600 p-3 rounded-2xl">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-gray-400 text-xs uppercase font-bold tracking-wider mb-1">Total
                                        Pembayaran</p>
                                    <p class="font-extrabold text-emerald-600 text-xl">Rp
                                        {{ number_format($transaksi->total_harga, 0, ',', '.') }}</p>
                                </div>
                            </div>

                            {{-- Item 6: Status Scan Tiket --}}
                            @if ($transaksi->scanned_at)
                                <div class="flex items-start gap-4">
                                    <div class="bg-amber-100 text-amber-600 p-3 rounded-2xl">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="text-gray-400 text-xs uppercase font-bold tracking-wider mb-1">Riwayat
                                            Penggunaan</p>
                                        <p class="font-bold text-amber-600 text-lg">Sudah Digunakan</p>
                                        <p class="text-gray-500 text-xs mt-1">
                                            Check-in: {{ $transaksi->scanned_at->format('d M Y, H:i') }} WIB
                                        </p>
                                    </div>
                                </div>
                            @endif

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
