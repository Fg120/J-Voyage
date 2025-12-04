@extends('layouts.admin.app')

@section('content')
    <div class="max-w-3xl mx-auto px-4 sm:px-0"> {{-- Tambah padding di mobile --}}

        {{-- Tombol Kembali --}}
        <div class="mb-6">
            <a href="{{ route('admin.review.index') }}"
                class="inline-flex items-center text-gray-400 hover:text-white transition group">
                <i data-lucide="arrow-left" class="w-5 h-5 mr-2 group-hover:-translate-x-1 transition-transform"></i>
                Kembali ke Daftar Review
            </a>
        </div>

        <div class="bg-neutral-800 rounded-2xl shadow-lg border border-neutral-700 overflow-hidden">

            {{-- HEADER DETAIL --}}
            <div class="p-6 sm:p-8 border-b border-neutral-700 bg-neutral-900/30">
                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-6">

                    {{-- Bagian Kiri: Foto & Nama --}}
                    <div class="flex items-center gap-4">
                        {{-- Foto User --}}
                        <div
                            class="w-14 h-14 sm:w-16 sm:h-16 rounded-full overflow-hidden bg-gray-700 border-2 border-neutral-600 shrink-0">
                            @if ($ulasan->user->foto_profil)
                                <img src="{{ Storage::url($ulasan->user->foto_profil) }}"
                                    class="w-full h-full object-cover">
                            @else
                                <div
                                    class="w-full h-full flex items-center justify-center bg-indigo-900 text-indigo-300 font-bold text-xl sm:text-2xl">
                                    {{ substr($ulasan->user->name, 0, 1) }}
                                </div>
                            @endif
                        </div>

                        <div class="min-w-0"> {{-- min-w-0 agar truncate berfungsi --}}
                            <h1 class="text-lg sm:text-xl font-bold text-white truncate">{{ $ulasan->user->name }}</h1>
                            <p class="text-gray-400 text-xs sm:text-sm truncate">{{ $ulasan->user->email }}</p>
                        </div>
                    </div>

                    {{-- Bagian Kanan: Rating (Tampil di bawah nama saat mobile) --}}
                    <div class="flex flex-row sm:flex-col items-center sm:items-end gap-3 sm:gap-1">
                        <div
                            class="flex items-center gap-1 bg-neutral-900/50 px-3 py-1.5 rounded-full border border-neutral-700 sm:bg-transparent sm:p-0 sm:border-0">
                            <span class="text-yellow-500 font-bold text-lg sm:hidden">{{ $ulasan->rating }}</span>
                            <div class="flex items-center gap-0.5">
                                @for ($i = 1; $i <= 5; $i++)
                                    <i data-lucide="star"
                                        class="w-4 h-4 sm:w-6 sm:h-6 {{ $i <= $ulasan->rating ? 'text-yellow-500 fill-yellow-500' : 'text-gray-600' }}"></i>
                                @endfor
                            </div>
                        </div>
                        <span class="text-xs sm:text-sm text-gray-400 font-medium hidden sm:block">Rating:
                            {{ $ulasan->rating }}/5</span>
                    </div>
                </div>
            </div>

            {{-- BODY ULASAN --}}
            <div class="p-6 sm:p-8">

                {{-- Info Wisata --}}
                <div
                    class="mb-6 bg-neutral-900/50 p-4 rounded-xl border border-neutral-700 flex items-start sm:items-center gap-3">
                    <div class="p-2 bg-indigo-500/20 rounded-lg text-indigo-400 shrink-0">
                        <i data-lucide="map-pin" class="w-5 h-5 sm:w-6 sm:h-6"></i>
                    </div>
                    <div>
                        <p class="text-[10px] sm:text-xs text-gray-500 uppercase font-bold tracking-wider">Destinasi Wisata
                        </p>
                        <p class="text-base sm:text-lg font-bold text-white">{{ $ulasan->pengelola->nama_wisata }}</p>
                    </div>
                </div>

                {{-- Teks Ulasan --}}
                <div class="mb-8">
                    <h3 class="text-gray-400 text-xs sm:text-sm font-bold uppercase mb-3 ml-1">Isi Ulasan</h3>
                    <div
                        class="text-gray-200 text-sm sm:text-base leading-relaxed whitespace-pre-line bg-neutral-700/30 p-5 sm:p-6 rounded-xl border border-neutral-700">
                        "{{ $ulasan->ulasan }}"
                    </div>
                </div>

                {{-- FOOTER INFO --}}
                <div
                    class="flex flex-col-reverse sm:flex-row justify-between items-start sm:items-center gap-4 text-sm text-gray-500 border-t border-neutral-700 pt-6">

                    {{-- Tanggal --}}
                    <div class="flex items-center gap-2 w-full sm:w-auto justify-center sm:justify-start">
                        <i data-lucide="calendar" class="w-4 h-4"></i>
                        <span>{{ \Carbon\Carbon::parse($ulasan->created_at)->locale('id')->isoFormat('dddd, D MMMM Y, HH:mm') }}
                            WIB</span>
                    </div>

                    {{-- Tombol Hapus --}}
                    <form action="{{ route('admin.review.destroy', $ulasan->id) }}" method="POST"
                        onsubmit="return confirm('Hapus ulasan ini permanen?');" class="w-full sm:w-auto">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                            class="w-full sm:w-auto flex justify-center items-center gap-2 px-4 py-3 sm:py-2 bg-red-600/10 hover:bg-red-600 text-red-500 hover:text-white border border-red-600/30 hover:border-red-600 rounded-xl sm:rounded-lg transition-all duration-300 font-semibold group">
                            <i data-lucide="trash-2" class="w-4 h-4 group-hover:scale-110 transition-transform"></i>
                            <span>Hapus Ulasan Ini</span>
                        </button>
                    </form>
                </div>
            </div>

        </div>
    </div>
@endsection
