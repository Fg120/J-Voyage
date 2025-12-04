@extends('layouts.public.sub')

@section('content')
    <div class="bg-gray-50 min-h-screen pb-20 font-poppins">

        {{-- Hero Header Search (Desain Baru) --}}
        <header
            class="relative bg-gradient-to-br from-indigo-600 to-violet-700 pt-16 pb-28 px-5 md:px-20 text-center overflow-hidden shadow-lg">
            {{-- Background Pattern --}}
            <div class="absolute top-0 left-0 w-full h-full opacity-10">
                <svg width="100%" height="100%" xmlns="http://www.w3.org/2000/svg">
                    <defs>
                        <pattern id="grid" width="40" height="40" patternUnits="userSpaceOnUse">
                            <path d="M 40 0 L 0 0 0 40" fill="none" stroke="white" stroke-width="1" />
                        </pattern>
                    </defs>
                    <rect width="100%" height="100%" fill="url(#grid)" />
                </svg>
            </div>

            <div class="relative z-10 max-w-4xl mx-auto">
                <h1 class="font-extrabold text-3xl md:text-5xl text-white mb-3 leading-tight">
                    Jelajahi Keindahan Jember
                </h1>
                <p class="text-indigo-100 text-base md:text-lg mb-8 font-light">
                    Temukan destinasi wisata terbaik untuk liburan Anda
                </p>

                {{-- Search Bar Modern --}}
                <form action="#" method="GET" class="relative max-w-2xl mx-auto">
                    <div class="relative flex items-center bg-white rounded-2xl shadow-xl p-2">
                        <div class="pl-4 pr-2 text-gray-400">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </div>
                        <input type="text" name="searchdestination" value="{{ request('searchdestination') }}"
                            class="w-full bg-transparent border-none focus:ring-0 text-gray-700 placeholder-gray-400 text-base px-2 py-3 outline-none"
                            placeholder="Cari destinasi, lokasi, atau kategori..." autocomplete="off">
                        <button type="submit"
                            class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold rounded-xl px-6 py-3 transition-all shadow-md flex-shrink-0">
                            Cari
                        </button>
                    </div>
                </form>
            </div>
        </header>

        {{-- Content List --}}
        <section class="max-w-7xl mx-auto px-5 md:px-10 mt-5 relative z-20">

            {{-- Judul Section --}}
            <div class="flex items-center justify-between mb-6 px-2">
                <h2 class="font-extrabold text-2xl text-gray-800 ">
                    Hasil Pencarian
                </h2>
            </div>

            {{-- Grid Destinasi --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6 justify-items-center">
                @forelse ($destinasi as $item)
                    {{--
                        CARD ASLI ANDA
                        Note: Saya mengubah 'w-80' menjadi 'w-full' agar responsif di dalam grid,
                        tapi desain dalamnya tetap 100% sama seperti kode Anda.
                    --}}
                    <div
                        class="flex-none w-full max-w-[320px] h-[400px] bg-white rounded-2xl shadow-lg overflow-hidden border border-gray-100 transition hover:shadow-lg hover:shadow-indigo-500 hover:-translate-y-1 flex flex-col">

                        <div class="relative h-48 shrink-0">
                            @if ($item->foto_wisata)
                                <img src="{{ Storage::url($item->foto_wisata) }}" alt="{{ $item->nama_wisata }}"
                                    class="w-full h-full object-cover">
                            @else
                                <div class="w-full h-full bg-gray-200 flex items-center justify-center text-gray-400">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                </div>
                            @endif
                            <div
                                class="absolute top-4 right-4 bg-indigo-500/90 backdrop-blur-sm text-white text-xs font-bold px-3 py-1 rounded-full shadow-sm">
                                Rp {{ number_format($item->harga, 0, ',', '.') }}
                            </div>
                        </div>

                        <div class="p-5 flex flex-col flex-grow">
                            {{-- Lokasi --}}
                            <div class="flex items-center text-indigo-500 mb-2 text-xs font-medium">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" viewBox="0 0 20 20"
                                    fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z"
                                        clip-rule="evenodd" />
                                </svg>
                                {{ $item->kecamatan->nama }}
                            </div>

                            {{-- Judul --}}
                            <h3 class="text-lg font-bold text-gray-900 mb-2 font-poppins leading-tight line-clamp-1">
                                {{ $item->nama_wisata }}
                            </h3>

                            {{-- Deskripsi --}}
                            <p class="text-gray-500 text-xs leading-relaxed mb-4 line-clamp-3">
                                {{ $item->deskripsi_wisata }}
                            </p>

                            {{-- Tombol --}}
                            <div class="mt-auto">
                                <a href="{{ route('destinasi.show', $item->id) }}"
                                    class="block w-full text-center bg-indigo-400 hover:bg-indigo-500 text-white font-bold py-3 rounded-xl text-sm transition duration-300 uppercase tracking-wide">
                                    Lihat Detail
                                </a>
                            </div>
                        </div>
                    </div>
                @empty
                    {{-- Empty State --}}
                    <div class="col-span-full py-16 flex flex-col items-center justify-center text-center">
                        <div class="bg-white p-4 rounded-full shadow-md mb-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-gray-400" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <h3 class="text-lg font-bold text-gray-700">Tidak Ditemukan</h3>
                        <p class="text-gray-500 text-sm">Coba kata kunci lain atau reset pencarian.</p>
                        <a href="{{ url()->current() }}"
                            class="mt-4 text-indigo-600 text-sm font-semibold hover:underline">Reset Filter</a>
                    </div>
                @endforelse
            </div>

            {{-- Pagination --}}
            <div class="mt-12 mb-10">
                {{ $destinasi->appends(request()->query())->links() }}
            </div>

        </section>
    </div>
@endsection
