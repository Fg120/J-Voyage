@extends('layouts.public.sub')

@section('content')
    <div class="bg-[#FAFAFA] min-h-screen font-poppins">
        <!-- Header / Back Button -->
        <div class="bg-neutral-900 text-white   py-4 px-4 lg:px-24 sticky top-0 z-50">
            <a href="{{ route('profile.history') }}"
                class="inline-flex items-center gap-2 text-[#404040] hover:text-indigo-600 transition">
                <div class="border-2 border-[#404040] rounded-full p-1">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none"
                        stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M19 12H5" />
                        <path d="m12 19-7-7 7-7" />
                    </svg>
                </div>
                <span class="font-semibold text-white">Kembali</span>
            </a>
        </div>
        <div class="flex flex-col mx-auto w-full max-w-4xl mt-5">
            <h3 class="font-bold text-2xl md:text-4xl text-[#171717] mt-7">Detail Transaksi</h3>
            {{-- 2. Content E-Ticket --}}
            <div class="flex justify-center items-center px-4 mt-7">

                {{-- Card Container --}}
                <div class="w-full max-w-4xl bg-white rounded-[30px] shadow-2xl overflow-hidden ">


                    {{-- A. BAGIAN ATAS (BIRU) --}}
                    <div class="bg-[#5D5FEF] p-6 md:p-10 relative">

                        {{-- Logo & Booking ID --}}
                        <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6 text-white">
                            <div class="flex items-center gap-3 mb-4 md:mb-0">
                                {{-- Icon Logo Dummy --}}
                                <div class="">
                                    <img class="w-10 h-auto" src="{{ asset('assets/images/logo.png') }}" alt="Logo">
                                </div>
                                <div>
                                    <h1 class="font-bold text-xl leading-none">J-Voyage</h1>
                                    <span class="text-xs text-indigo-100">E-Ticket Wisata</span>
                                </div>
                            </div>
                            <div class="text-right">
                                <span class="block text-xs text-indigo-200 uppercase tracking-wider">Transaksi ID</span>
                                {{-- Ganti dengan variable $transaksi->kode --}}
                                <span class="font-bold text-lg tracking-widest">{{ $transaksi->id }}</span>
                            </div>
                        </div>

                        {{-- Hero Image --}}
                        <div class="w-full h-48 md:h-64 rounded-2xl overflow-hidden shadow-lg mb-6 relative">
                            {{-- Ganti src dengan $transaksi->pengelola->foto_wisata --}}
                            <img src="{{ Storage::url($transaksi->pengelola->foto_wisata) }}"
                                alt="{{ $transaksi->pengelola->nama_wisata }}" class="w-full h-full object-cover">
                            {{-- Overlay Gradient (Agar teks terbaca) --}}
                            <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
                        </div>

                        {{-- Judul Wisata & Lokasi --}}
                        <div class="text-white relative z-10">
                            {{-- Ganti dengan $transaksi->pengelola->nama_wisata --}}
                            <h2 class="text-3xl md:text-4xl font-bold mb-2">{{$transaksi->pengelola->nama_wisata}}</h2>

                            <div class="flex items-center gap-2 text-indigo-100">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 0 1 16 0Z" />
                                    <circle cx="12" cy="10" r="3" />
                                </svg>
                                {{-- Ganti dengan lokasi --}}
                                <span class="text-lg">{{ $transaksi->pengelola->alamat_wisata }}</span>
                            </div>
                        </div>
                    </div>

                    <div class="p-6 md:p-10">
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-y-8 gap-x-4">

                            <div class="flex items-start gap-4">
                                <div class="bg-indigo-50 text-[#5D5FEF] p-3 rounded-full">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24"
                                        stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-gray-400 text-xs mb-1">Nama Pemesan</p>
                                    <p class="font-bold text-gray-800 text-lg">{{ $transaksi->nama }}</p>
                                </div>
                            </div>

                            <div class="flex items-start gap-4">
                                <div class="bg-indigo-50 text-[#5D5FEF] p-3 rounded-full">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24"
                                        stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-gray-400 text-xs mb-1">Tanggal Kunjungan</p>
                                    <p class="font-bold text-gray-800 text-lg">
                                        {{ \Carbon\Carbon::parse($transaksi->tanggal_kunjungan)->locale('id')->isoFormat('dddd, D MMMM Y')  }}
                                    </p>
                                </div>
                            </div>

                            {{-- Item 3: Status --}}
                            <div class="flex items-start gap-4">
                                <div class="bg-indigo-50 text-[#5D5FEF] p-3 rounded-full">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24"
                                        stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-gray-400 text-xs mb-1">Status</p>
                                    @if($transaksi->status == 'pending')
                                        <span
                                            class="bg-orange-100 text-orange-600 px-4 py-2 rounded-full text-xs font-semibold">Menunggu
                                            Verifikasi</span>
                                    @elseif($transaksi->status == 'verified')
                                        <span
                                            class="bg-green-100 text-green-600 px-4 py-2 rounded-full text-xs font-semibold">Dikonfirmasi</span>
                                    @elseif($transaksi->status == 'rejected')
                                        <span
                                            class="bg-red-100 text-red-600 px-4 py-2 rounded-full text-xs font-semibold">Ditolak</span>
                                    @endif
                                </div>
                            </div>

                            <div class="flex items-start gap-4">
                                <div class="bg-indigo-50 text-[#5D5FEF] p-3 rounded-full">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24"
                                        stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-gray-400 text-xs mb-1">Jumlah Pengunjung</p>
                                    <p class="font-bold text-gray-800 text-lg">{{ $transaksi->jumlah }}</p>
                                </div>
                            </div>

                            {{-- Item 5: Total Pembayaran --}}
                            <div class="flex items-start gap-4">
                                <div class="bg-indigo-50 text-[#5D5FEF] p-3 rounded-full">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24"
                                        stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-gray-400 text-xs mb-1">Total Pembayaran</p>
                                    {{-- Ganti format rupiah --}}
                                    <p class="font-bold text-gray-800 text-lg">Rp. {{$transaksi->total_harga}}</p>
                                </div>
                            </div>

                            {{-- Item 6: Status Scan Tiket --}}
                            @if($transaksi->scanned_at)
                                <div class="flex items-start gap-4">
                                    <div class="bg-amber-100 text-amber-600 p-3 rounded-full">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24"
                                            stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="text-gray-400 text-xs mb-1">Status Tiket</p>
                                        <p class="font-bold text-amber-600 text-lg">Sudah Digunakan</p>
                                        <p class="text-gray-500 text-xs">Di-scan pada
                                            {{ $transaksi->scanned_at->format('d M Y, H:i') }} WIB</p>
                                    </div>
                                </div>
                            @endif

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    </div>
@endsection