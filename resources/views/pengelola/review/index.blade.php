@extends('layouts.admin.app')

@section('content')
    <div class="bg-neutral-800 rounded-xl shadow-sm p-6">
        <h2 class="text-2xl font-bold text-white">Review Pelanggan</h2>
        <div class="grid grid-cols-1 md:grid-cols-2  gap-4">
            <!-- Card 1 -->
            <div class="bg-neutral-800 rounded-lg shadow p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Rating</p>
                        <p class="text-2xl font-bold text-white mt-2">{{ number_format($avgulasan, 1) }}
                        </p>
                    </div>
                    <div class="p-3 bg-yellow-900/30 rounded-full">
                        <i data-lucide="star" class="size-6 text-yellow-600 "></i>
                    </div>
                </div>
            </div>

            <!-- Card 2 -->
            <div class=" bg-neutral-800 rounded-lg shadow p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Jumlah Ulasan</p>
                        <p class="text-2xl font-bold text-gray-900 dark:text-white mt-2">{{ $banyakulasan }}</p>
                    </div>
                    <div class="p-3  bg-orange-900/30 rounded-full">
                        <i data-lucide="message-circle" class="size-6 text-orange-600"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>



    @forelse($ulasan as $review)
        <div
            class="bg-neutral-800 border border-gray-100 rounded-2xl p-6 shadow-sm hover:shadow-md transition duration-300">
            <div class="flex justify-between items-start mb-4">
                <div class="flex items-center gap-4">
                    {{-- Foto Profil (Gunakan inisial jika tidak ada foto) --}}
                    <div class="w-12 h-12 rounded-full overflow-hidden bg-gray-200 shrink-0">
                        @if ($review->user->foto_profil)
                            <img src="{{ Storage::url($review->user->foto_profil) }}" alt="{{ $review->user->name }}"
                                class="w-full h-full object-cover">
                        @else
                            <div
                                class="w-full h-full flex items-center justify-center bg-indigo-100 text-indigo-600 font-bold text-lg">
                                {{ substr($review->user->name, 0, 1) }}
                            </div>
                        @endif
                    </div>

                    <div>
                        {{-- Nama User --}}
                        <h4 class="font-bold  text-white  mb-1">{{ $review->user->name }}</h4>

                        {{-- Bintang Rating --}}
                        <div class="flex items-center gap-1">
                            @for ($i = 1; $i <= 5; $i++)
                                <svg xmlns="http://www.w3.org/2000/svg"
                                    class="h-4 w-4 {{ $i <= $review->rating ? 'text-yellow-400 fill-yellow-400' : 'text-gray-300' }}"
                                    viewBox="0 0 20 20" fill="currentColor">
                                    <path
                                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                </svg>
                            @endfor
                        </div>
                    </div>
                </div>

                {{-- Tanggal Ulasan --}}
                <span class="text-xs text-white  font-medium">
                    {{ \Carbon\Carbon::parse($review->created_at)->locale('id')->isoFormat('D MMMM Y') }}
                </span>
            </div>

            {{-- Isi Komentar --}}
            <p class="text-white  text-sm leading-relaxed">
                {{ $review->ulasan }}
            </p>
        </div>
        {{-- Pagination (Jika ada) --}}
    @empty
        {{-- Tampilan Jika Belum Ada Ulasan --}}
        <div class="text-center py-12 bg-white rounded-2xl border border-gray-100 border-dashed">
            <div class="bg-indigo-50 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-indigo-500" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                </svg>
            </div>
            <h3 class="text-lg font-bold text-gray-900">Belum ada ulasan</h3>
        </div>
    @endforelse

    @if ($ulasan)
        <div class="mt-6">
            {{ $ulasan->links() }}
        </div>
    @endif
@endsection
