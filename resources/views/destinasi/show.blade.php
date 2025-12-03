@extends('layouts.destinasi.app')

@section('content')
    <!-- Tentang Destinasi -->
    <div class="mb-8">
        <h2 class="font-bold text-2xl text-[#171717] mb-4">Tentang Destinasi</h2>
        <p class="text-[#404040] text-base leading-relaxed">
            {{ $destinasi->deskripsi_wisata }}
        </p>
    </div>

    <!-- Highlights -->
    @if ($destinasi->highlights->count() > 0)
        <div class="mb-8">
            <h2 class="font-bold text-2xl text-[#171717] mb-4">Highlight</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                @foreach ($destinasi->highlights as $highlight)
                    <div class="flex items-center gap-3">
                        <div class="w-6 h-6 rounded-full bg-[#E0E7FF] flex items-center justify-center shrink-0">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-[#818CF8]" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
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
    @if ($destinasi->fasilitas->count() > 0)
        <div class="mb-8">
            <h2 class="font-bold text-2xl text-[#171717] mb-4">Fasilitas</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                @foreach ($destinasi->fasilitas as $fasil)
                    <div class="flex items-center gap-3">
                        <div class="w-6 h-6 rounded-full bg-[#DCFCE7] flex items-center justify-center shrink-0">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-[#00A63E]" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                        </div>
                        <span class="text-[#404040] text-base">{{ $fasil->nama }}</span>
                    </div>
                @endforeach
            </div>
        </div>
    @endif
@endsection
