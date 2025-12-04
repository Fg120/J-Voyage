@extends('layouts.admin.app')

@section('content')
    <div class="bg-neutral-800 rounded-xl shadow-sm p-6 mb-6">
        <h2 class="text-2xl font-bold text-white mb-6">Review Pelanggan</h2>

        {{-- Statistik Cards (Tetap Sama) --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div class="bg-neutral-700/50 rounded-lg shadow p-6 border border-neutral-600">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-400">Total Destinasi</p>
                        <p class="text-2xl font-bold text-white mt-2">{{ number_format($banyakpengelola, 0) }}</p>
                    </div>
                    <div class="p-3 bg-yellow-900/30 rounded-full">
                        <i data-lucide="star" class="size-6 text-yellow-600"></i>
                    </div>
                </div>
            </div>

            <div class="bg-neutral-700/50 rounded-lg shadow p-6 border border-neutral-600">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-400">Total Ulasan</p>
                        <p class="text-2xl font-bold text-white mt-2">{{ number_format($banyakulasan, 0) }}</p>
                    </div>
                    <div class="p-3 bg-orange-900/30 rounded-full">
                        <i data-lucide="message-circle" class="size-6 text-orange-600"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- LIST REVIEW --}}
    <div class="space-y-4">
        @forelse($ulasan as $review)
            <div
                class="bg-neutral-800 border border-neutral-700 rounded-2xl p-6 shadow-sm hover:border-indigo-500/50 transition duration-300">

                {{-- Header Review: User Info & Actions --}}
                <div class="flex flex-col md:flex-row justify-between items-start mb-4 gap-4">

                    {{-- Kiri: Foto & Nama --}}
                    <div class="flex items-center gap-4">
                        {{-- Foto Profil --}}
                        <div class="w-12 h-12 rounded-full overflow-hidden bg-gray-700 shrink-0">
                            @if ($review->user->foto_profil)
                                <img src="{{ Storage::url($review->user->foto_profil) }}" alt="{{ $review->user->name }}"
                                    class="w-full h-full object-cover">
                            @else
                                <div
                                    class="w-full h-full flex items-center justify-center bg-indigo-900 text-indigo-300 font-bold text-lg">
                                    {{ substr($review->user->name, 0, 1) }}
                                </div>
                            @endif
                        </div>

                        <div>
                            {{-- Nama User --}}
                            <h4 class="font-bold text-white text-lg">{{ $review->user->name }}</h4>

                            {{-- Destinasi Wisata (BARU DITAMBAHKAN) --}}
                            <div class="flex items-center gap-2 text-sm text-gray-400 mt-1">
                                <span>Mengulas:</span>
                                <a href="#"
                                    class="text-indigo-400 hover:text-indigo-300 font-semibold flex items-center gap-1">
                                    <i data-lucide="map-pin" class="w-3 h-3"></i>
                                    {{ $review->pengelola->nama_wisata }}
                                </a>
                            </div>
                        </div>
                    </div>

                    {{-- Kanan: Rating & Tanggal & Actions --}}
                    <div class="flex flex-col items-end gap-2">
                        <div
                            class="flex items-center gap-1 bg-neutral-900/50 px-3 py-1 rounded-full border border-neutral-700">
                            <span class="text-yellow-500 font-bold">{{ $review->rating }}</span>
                            <i data-lucide="star" class="w-4 h-4 text-yellow-500 fill-yellow-500"></i>
                        </div>
                        <span class="text-xs text-gray-500">
                            {{ \Carbon\Carbon::parse($review->created_at)->locale('id')->isoFormat('D MMMM Y, HH:mm') }}
                        </span>
                    </div>
                </div>

                <hr class="border-neutral-700 my-4">

                {{-- Isi Komentar --}}
                <div class="flex justify-between items-end gap-4">
                    <p class="text-gray-300 text-sm leading-relaxed line-clamp-2 flex-1">
                        "{{ $review->ulasan }}"
                    </p>

                    {{-- Tombol Aksi (Lihat & Hapus) --}}
                    <div class="flex items-center gap-2 shrink-0">
                        {{-- Tombol Detail --}}
                        <a href="{{ route('admin.review.show', $review->id) }}"
                            class="p-2 bg-blue-900/30 text-blue-400 rounded-lg hover:bg-blue-900/50 transition"
                            title="Lihat Detail">
                            <i data-lucide="eye" class="w-5 h-5"></i>
                        </a>

                        {{-- Tombol Hapus --}}
                        <form action="{{ route('admin.review.destroy', $review->id) }}" method="POST"
                            onsubmit="return confirm('Apakah Anda yakin ingin menghapus ulasan ini secara permanen?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                class="p-2 bg-red-900/30 text-red-400 rounded-lg hover:bg-red-900/50 transition"
                                title="Hapus Ulasan">
                                <i data-lucide="trash-2" class="w-5 h-5"></i>
                            </button>
                        </form>
                    </div>
                </div>

            </div>
        @empty
            <div class="text-center py-12 bg-neutral-800 rounded-2xl border border-neutral-700 border-dashed">
                <div class="bg-neutral-700 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i data-lucide="message-square-off" class="w-8 h-8 text-gray-500"></i>
                </div>
                <h3 class="text-lg font-bold text-white">Belum ada ulasan</h3>
                <p class="text-gray-500 text-sm mt-1">Belum ada user yang memberikan review.</p>
            </div>
        @endforelse
    </div>

    {{-- Pagination --}}
    @if ($ulasan->hasPages())
        <div class="mt-6">
            {{ $ulasan->links() }}
        </div>
    @endif
@endsection
