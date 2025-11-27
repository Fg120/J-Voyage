@extends('layouts.public.app')

@section('content')
    <div class="bg-[#FAFAFA] min-h-screen pb-20 font-poppins pt-24">
        <div class="container mx-auto px-4 lg:px-24">
            <!-- Header -->
            <div class="flex items-center justify-between mb-8">
                <a href="{{ route('onboarding') }}" class="flex items-center gap-2 text-[#404040] hover:text-indigo-600 transition">
                    <div class="border-2 border-[#404040] rounded-full p-1">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M19 12H5"/>
                            <path d="m12 19-7-7 7-7"/>
                        </svg>
                    </div>
                    <span class="font-semibold text-base">Kembali</span>
                </a>
                
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-indigo-100 rounded-full flex items-center justify-center text-indigo-600 font-bold">
                        {{ substr(auth()->user()->name, 0, 2) }}
                    </div>
                    <span class="font-semibold text-xl text-[#171717]">J-Voyage</span>
                </div>
            </div>

            <!-- Profile Header Card -->
            <div class="bg-[#6366F1] rounded-none w-full p-8 mb-8 relative overflow-hidden">
                <div class="flex items-center gap-6 relative z-10">
                    <div class="w-24 h-24 bg-white/20 rounded-full border-4 border-white shadow-lg flex items-center justify-center text-white text-3xl font-bold">
                         {{ substr(auth()->user()->name, 0, 1) }}
                    </div>
                    <div>
                        <h2 class="font-extrabold text-4xl text-white mb-2">{{ auth()->user()->name }}</h2>
                        <p class="text-white/90 text-base">Bergabung sejak {{ auth()->user()->created_at->format('M Y') }}</p>
                    </div>
                </div>
            </div>

            <!-- Tabs -->
            <div class="flex gap-8 border-b border-[#E5E5E5] mb-8 pl-6">
                <a href="{{ route('profile.index') }}" class="pb-4 px-4 text-[#525252] font-semibold text-lg hover:text-[#818CF8] transition">
                    Profil Saya
                </a>
                <a href="{{ route('profile.history') }}" class="pb-4 px-4 border-b-4 border-[#818CF8] text-[#818CF8] font-semibold text-lg">
                    Riwayat Transaksi
                </a>
                <a href="{{ route('pengelola.index') }}" class="pb-4 px-4 text-[#525252] font-semibold text-lg hover:text-[#818CF8] transition">
                    Pengajuan Pengelola
                </a>
            </div>

            <!-- Content -->
            <div class="space-y-6">
                <h3 class="font-bold text-2xl text-[#171717]">Riwayat Transaksi</h3>

                @forelse($transaksi as $item)
                    <div class="bg-white rounded-2xl shadow-sm p-6 border border-gray-100 flex flex-col lg:flex-row gap-6">
                        <!-- Image -->
                        <div class="w-full lg:w-32 h-32 shrink-0">
                            @if($item->pengelola->foto_wisata)
                                <img src="{{ Storage::url($item->pengelola->foto_wisata) }}" alt="{{ $item->pengelola->nama_wisata }}" class="w-full h-full object-cover rounded-xl">
                            @else
                                <div class="w-full h-full bg-gray-200 rounded-xl flex items-center justify-center text-gray-400">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                </div>
                            @endif
                        </div>

                        <!-- Details -->
                        <div class="flex-1">
                            <div class="flex justify-between items-start mb-3">
                                <div>
                                    <h4 class="font-bold text-xl text-[#171717] mb-1">{{ $item->pengelola->nama_wisata }}</h4>
                                    <p class="text-sm text-[#525252]">Booking ID: #{{ $item->id }}</p>
                                </div>
                                <div>
                                    @if($item->status == 'pending')
                                        <span class="bg-orange-100 text-orange-600 px-4 py-2 rounded-full text-xs font-semibold">Menunggu Verifikasi</span>
                                    @elseif($item->status == 'verified')
                                        <span class="bg-blue-100 text-blue-600 px-4 py-2 rounded-full text-xs font-semibold">Dikonfirmasi</span>
                                    @elseif($item->status == 'rejected')
                                        <span class="bg-red-100 text-red-600 px-4 py-2 rounded-full text-xs font-semibold">Ditolak</span>
                                    @endif
                                </div>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4">
                                <div class="flex items-center gap-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-[#525252]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                    <div>
                                        <p class="text-xs text-[#525252]">Tanggal Kunjungan</p>
                                        <p class="font-semibold text-sm text-[#171717]">{{ $item->tanggal_kunjungan->format('d M Y') }}</p>
                                    </div>
                                </div>
                                <div class="flex items-center gap-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-[#525252]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                                    </svg>
                                    <div>
                                        <p class="text-xs text-[#525252]">Jumlah Orang</p>
                                        <p class="font-semibold text-sm text-[#171717]">{{ $item->jumlah }} Orang</p>
                                    </div>
                                </div>
                                <div class="flex items-center gap-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-[#525252]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    <div>
                                        <p class="text-xs text-[#525252]">Total Pembayaran</p>
                                        <p class="font-semibold text-sm text-[#818CF8]">Rp {{ number_format($item->total_harga, 0, ',', '.') }}</p>
                                    </div>
                                </div>
                            </div>

                            <div class="flex gap-3">
                                @if($item->status == 'verified' && $item->kode)
                                    <button onclick="alert('Kode Tiket Anda: {{ $item->kode }}')" class="bg-[#818CF8] hover:bg-indigo-600 text-white px-6 py-2 rounded-lg font-semibold text-sm transition">
                                        Lihat Tiket
                                    </button>
                                @endif
                                <a href="{{ route('transaksi.payment', $item->id) }}" class="bg-gray-100 hover:bg-gray-200 text-[#171717] px-6 py-2 rounded-lg font-semibold text-sm transition">
                                    Detail
                                </a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="text-center py-12 bg-white rounded-2xl shadow-sm border border-gray-100">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-gray-300 mx-auto mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
                        </svg>
                        <h3 class="text-lg font-semibold text-gray-900">Belum ada transaksi</h3>
                        <p class="text-gray-500 mt-2">Anda belum melakukan pemesanan apapun.</p>
                        <a href="{{ route('onboarding') }}" class="inline-block mt-4 text-indigo-600 font-semibold hover:underline">Mulai Jelajahi</a>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
@endsection
