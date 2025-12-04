@extends('layouts.admin.app')

@section('content')
    <div class="max-w-3xl mx-auto">

        {{-- Tombol Kembali --}}
        <div class="mb-6">
            <a href="{{ route('admin.review.index') }}"
                class="inline-flex items-center text-gray-400 hover:text-white transition">
                <i data-lucide="arrow-left" class="w-5 h-5 mr-2"></i>
                Kembali ke Daftar Review
            </a>
        </div>

        <div class="bg-neutral-800 rounded-2xl shadow-lg border border-neutral-700 overflow-hidden">

            {{-- Header Detail --}}
            <div class="p-8 border-b border-neutral-700 bg-neutral-900/30">
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-4">
                        {{-- Foto User --}}
                        <div class="w-16 h-16 rounded-full overflow-hidden bg-gray-700 border-2 border-neutral-600">
                            @if ($ulasan->user->foto_profil)
                                <img src="{{ Storage::url($ulasan->user->foto_profil) }}"
                                    class="w-full h-full object-cover">
                            @else
                                <div
                                    class="w-full h-full flex items-center justify-center bg-indigo-900 text-indigo-300 font-bold text-2xl">
                                    {{ substr($ulasan->user->name, 0, 1) }}
                                </div>
                            @endif
                        </div>
                        <div>
                            <h1 class="text-xl font-bold text-white">{{ $ulasan->user->name }}</h1>
                            <p class="text-gray-400 text-sm">{{ $ulasan->user->email }}</p>
                        </div>
                    </div>

                    {{-- Rating Besar --}}
                    <div class="text-center">
                        <div class="flex items-center gap-1 mb-1">
                            @for ($i = 1; $i <= 5; $i++)
                                <i data-lucide="star"
                                    class="w-6 h-6 {{ $i <= $ulasan->rating ? 'text-yellow-500 fill-yellow-500' : 'text-gray-600' }}"></i>
                            @endfor
                        </div>
                        <span class="text-sm text-gray-400 font-medium">Rating: {{ $ulasan->rating }}/5</span>
                    </div>
                </div>
            </div>

            {{-- Body Ulasan --}}
            <div class="p-8">
                {{-- Info Wisata --}}
                <div class="mb-6 bg-neutral-900/50 p-4 rounded-xl border border-neutral-700 flex items-center gap-3">
                    <div class="p-2 bg-indigo-500/20 rounded-lg text-indigo-400">
                        <i data-lucide="map-pin" class="w-6 h-6"></i>
                    </div>
                    <div>
                        <p class="text-xs text-gray-500 uppercase font-bold tracking-wider">Destinasi Wisata</p>
                        <p class="text-lg font-bold text-white">{{ $ulasan->pengelola->nama_wisata }}</p>
                    </div>
                </div>

                {{-- Teks Ulasan --}}
                <div class="mb-8">
                    <h3 class="text-gray-400 text-sm font-bold uppercase mb-3">Isi Ulasan</h3>
                    <div
                        class="text-gray-200 text-lg leading-relaxed whitespace-pre-line bg-neutral-700/30 p-6 rounded-xl border border-neutral-700">
                        "{{ $ulasan->ulasan }}"
                    </div>
                </div>

                {{-- Footer Info --}}
                <div class="flex justify-between items-center text-sm text-gray-500 border-t border-neutral-700 pt-6">
                    <p>Dibuat pada:
                        {{ \Carbon\Carbon::parse($ulasan->created_at)->locale('id')->isoFormat('dddd, D MMMM Y, HH:mm WIB') }}
                    </p>

                    {{-- Tombol Hapus Besar --}}
                    <form action="{{ route('admin.review.destroy', $ulasan->id) }}" method="POST"
                        onsubmit="return confirm('Hapus ulasan ini permanen?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                            class="flex items-center gap-2 px-4 py-2 bg-red-600 hover:bg-red-700 text-white rounded-lg transition font-semibold">
                            <i data-lucide="trash-2" class="w-4 h-4"></i>
                            Hapus Ulasan Ini
                        </button>
                    </form>
                </div>
            </div>

        </div>
    </div>
@endsection
