@extends('layouts.public.app')

@section('content')
    <div class="bg-[#FAFAFA] min-h-screen pb-20 font-poppins">
        <!-- Header / Back Button -->
        <div class="bg-white border-b border-[#E5E5E5] py-4 px-4 lg:px-24 sticky top-0 z-50">
            <a href="{{ route('onboarding') }}" class="inline-flex items-center gap-2 text-[#404040] hover:text-indigo-600 transition">
                <div class="border-2 border-[#404040] rounded-full p-1">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M19 12H5"/>
                        <path d="m12 19-7-7 7-7"/>
                    </svg>
                </div>
                <span class="font-semibold text-base">Kembali</span>
            </a>
        </div>

        <!-- Hero Section -->
        <div class="relative w-full h-[400px]">
            @if($destinasi->foto_wisata)
                <img src="{{ Storage::url($destinasi->foto_wisata) }}" alt="{{ $destinasi->nama_wisata }}" class="w-full h-full object-cover">
            @else
                <div class="w-full h-full bg-gray-300 flex items-center justify-center">
                    <span class="text-gray-500 text-xl">No Image Available</span>
                </div>
            @endif
            
            <!-- Gradient Overlay -->
            <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>

            <!-- Hero Content -->
            <div class="absolute bottom-8 left-4 lg:left-24 right-4 text-white">
                <h1 class="font-extrabold text-3xl lg:text-5xl mb-2">{{ $destinasi->nama_wisata }}</h1>
                <div class="flex flex-wrap items-center gap-4 text-sm lg:text-lg">
                    <div class="flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd" />
                        </svg>
                        <span>{{ $destinasi->kecamatan->nama }}</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-[#FDC700]" viewBox="0 0 20 20" fill="currentColor">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                        </svg>
                        <span class="font-semibold">4.8 (234 ulasan)</span> <!-- Placeholder rating -->
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="container mx-auto px-4 lg:px-24 mt-8 relative">
            <div class="flex flex-col lg:flex-row gap-8">
                
                <!-- Left Column -->
                <div class="w-full lg:w-[65%]">
                    <!-- Tabs -->
                    <div class="flex border-b border-[#E5E5E5] mb-8">
                        <button class="px-6 py-2 border-b-2 border-[#818CF8] text-[#818CF8] font-semibold text-base">Overview</button>
                        <button class="px-6 py-2 text-[#525252] font-semibold text-base hover:text-[#818CF8] transition">Ulasan (3)</button>
                    </div>

                    <!-- Tentang Destinasi -->
                    <div class="mb-8">
                        <h2 class="font-bold text-2xl text-[#171717] mb-4">Tentang Destinasi</h2>
                        <p class="text-[#404040] text-base leading-relaxed">
                            {{ $destinasi->deskripsi_wisata }}
                        </p>
                    </div>

                    <!-- Highlights -->
                    @if($destinasi->highlights->count() > 0)
                    <div class="mb-8">
                        <h2 class="font-bold text-2xl text-[#171717] mb-4">Highlight</h2>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            @foreach($destinasi->highlights as $highlight)
                                <div class="flex items-center gap-3">
                                    <div class="w-6 h-6 rounded-full bg-[#E0E7FF] flex items-center justify-center shrink-0">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-[#818CF8]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                        </svg>
                                    </div>
                                    <span class="text-[#404040] text-base">{{ $highlight->nama }}</span>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    @endif

                    <!-- Fasilitas -->
                    @if($destinasi->fasilitas->count() > 0)
                    <div class="mb-8">
                        <h2 class="font-bold text-2xl text-[#171717] mb-4">Fasilitas</h2>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            @foreach($destinasi->fasilitas as $fasil)
                                <div class="flex items-center gap-3">
                                    <div class="w-6 h-6 rounded-full bg-[#DCFCE7] flex items-center justify-center shrink-0">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-[#00A63E]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                        </svg>
                                    </div>
                                    <span class="text-[#404040] text-base">{{ $fasil->nama }}</span>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    @endif
                </div>

                <!-- Right Column (Booking Card) -->
                <div class="w-full lg:w-[35%]">
                    <div class="bg-white rounded-2xl shadow-lg p-6 sticky top-24 border border-gray-100">
                        <div class="mb-6">
                            <p class="text-[#525252] text-base mb-1">Mulai dari</p>
                            <div class="flex items-baseline gap-1">
                                <span class="text-[#818CF8] font-extrabold text-3xl">Rp {{ number_format($destinasi->harga, 0, ',', '.') }}</span>
                                <span class="text-[#525252] text-base">/ orang</span>
                            </div>
                        </div>

                        <div class="space-y-4 mb-8">
                            <!-- Durasi -->
                            <div class="flex justify-between items-center py-3 border-b border-[#E5E5E5]">
                                <div class="flex items-center gap-2 text-[#525252]">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    <span>Jam Buka</span>
                                </div>
                                <span class="font-semibold text-[#171717]">{{ $destinasi->jam_buka }} - {{ $destinasi->jam_tutup }}</span>
                            </div>

                            <!-- Kapasitas -->
                            <div class="flex justify-between items-center py-3 border-b border-[#E5E5E5]">
                                <div class="flex items-center gap-2 text-[#525252]">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                                    </svg>
                                    <span>Kontak</span>
                                </div>
                                <span class="font-semibold text-[#171717]">{{ $destinasi->kontak_wisata ?? '-' }}</span>
                            </div>

                            <!-- Rating -->
                            <div class="flex justify-between items-center py-3">
                                <div class="flex items-center gap-2 text-[#525252]">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                                    </svg>
                                    <span>Rating</span>
                                </div>
                                <span class="font-semibold text-[#171717]">4.8 / 5.0</span>
                            </div>
                        </div>

                        <a href="{{ route('transaksi.create', $destinasi->id) }}" class="block w-full bg-[#6366F1] hover:bg-indigo-700 text-white font-semibold text-lg py-4 rounded-xl transition shadow-md hover:shadow-lg mb-4 text-center">
                            Pesan Sekarang
                        </a>

                        <p class="text-center text-[#737373] text-xs">
                            Pembayaran aman dan terpercaya
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
