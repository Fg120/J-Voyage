@extends('layouts.public.sub')

@section('content')
    <div class="bg-[#FAFAFA] min-h-screen pb-20 font-poppins">
        <div class="bg-neutral-900 text-white   py-4 px-4 lg:px-24 sticky top-0 z-50">
            <a href="{{ route('onboarding') }}" class="inline-flex items-center gap-2 text-[#404040] hover:text-indigo-600 transition">
                <div class="border-2 border-[#404040] rounded-full p-1">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M19 12H5"/>
                        <path d="m12 19-7-7 7-7"/>
                    </svg>
                </div>
                <span class="font-semibold text-white">Kembali</span>
            </a>
        </div>

        {{-- header start --}}
        <header class="bg-indigo-500 text-white py-32 px-5 flex flex-col gap-2 shadow-lg">
            <h1 class="font-bold text-[45px]">Jelajahi Keindahan Jember</h1>
            <p >Temukan destinasi wisata terbaik untuk liburan Anda</p>
            <div class="w-full max-w-4xl">
                <form action="#" method="GET" class="relative flex items-center w-full bg-white rounded-2xl shadow-[0_10px_40px_-10px_rgba(0,0,0,0.08)] p-2 gap-2">        <div class="pl-4 text-gray-400">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-search w-6 h-6">
                            <circle cx="11" cy="11" r="8"/>
                            <path d="m21 21-4.3-4.3"/>
                        </svg>
                    </div>
                    <input
                        type="text"
                        name="searchdestination"
                        class="w-full focus:ring-0 text-gray-700 placeholder-gray-400 text-base md:text-lg px-4 py-3  border-white rounded-md"
                        placeholder="Cari destinasi, lokasi, atau kategori..."
                        autocomplete="off"
                    >
                    <button type="submit" class=" bg-indigo-600 text-white font-bold rounded-2xl px-6 py-3 flex items-center gap-2 transition-all duration-300 shadow-md hover:shadow-lg flex-shrink-0 ">
                        Cari
                    </button>
                </form>
            </div>
        </header>
        {{-- header end --}}

        {{-- Content start --}}
        <section class="px-5 pt-10 md:px-20 flex flex-col">
            <h2 class="font-extrabold text-2xl lg:text-4xl text-neutral-900 ">Destinasi</h2>
            <div class="pt-10 flex gap-3 flex-wrap justify-center md:justify-start">
                @forelse ($destinasi as $item)
                    <div class="flex-none w-80 h-96 bg-white rounded-2xl shadow-lg overflow-hidden snap-center border border-gray-100 transition hover:shadow-lg hover:shadow-indigo-500 hover:-translate-y-1 ">

                        <div class="relative h-48">
                            @if($item->foto_wisata)
                                <img src="{{ Storage::url($item->foto_wisata) }}" alt="{{ $item->nama_wisata }}" class="w-full h-full object-cover">
                            @else
                                <div class="w-full h-full bg-gray-200 flex items-center justify-center text-gray-400">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                </div>
                            @endif
                            <div class="absolute top-4 right-4 bg-indigo-500/90 backdrop-blur-sm text-white text-xs font-bold px-3 py-1 rounded-full shadow-sm">
                                Rp {{ number_format($item->harga, 0, ',', '.') }}
                            </div>
                        </div>

                        <div class="p-5 flex flex-col h-[calc(100%-12rem)]">
                            {{-- Lokasi --}}
                            <div class="flex items-center text-indigo-500 mb-2 text-xs font-medium">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd" />
                                </svg>
                                {{ $item->kecamatan->nama }}
                            </div>

                            {{-- Judul --}}
                            <h3 class="text-lg font-bold text-gray-900 mb-2 font-poppins leading-tight">
                                {{ $item->nama_wisata }}
                            </h3>

                            {{-- Deskripsi --}}
                            <p class="text-gray-500 text-xs leading-relaxed mb-6 line-clamp-3">
                                {{ $item->deskripsi_wisata }}
                            </p>

                            {{-- Tombol (mt-auto agar selalu di bawah) --}}
                            <div class="mt-auto">
                                <a href="{{ route('destinasi.show', $item->id) }}" class="block w-full text-center bg-indigo-400 hover:bg-indigo-500 text-white font-bold py-3 rounded-xl text-sm transition duration-300 uppercase tracking-wide">
                                    Lihat Detail
                                </a>
                            </div>
                        </div>
                    </div>
                @empty
                <p class="text-center">Data Destinasi Wisata Tidak Ditemukan</p>
                @endforelse

            </div>
            <div class="mt-8">
            {{ $destinasi->appends(request()->query())->links() }}
            </div>


        </section>
        {{-- Content End --}}

    </div>
@endsection

