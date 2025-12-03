@extends('layouts.destinasi.app')

@section('content')
    <div class="container mx-auto px-4 lg:px-8 mt-10 mb-20">

        <div class="max-w-3xl mx-auto">
            <div class="bg-white border border-gray-200 rounded-2xl shadow-lg p-8">

                <div class="flex justify-between items-center mb-6">
                    <h3 class="font-bold text-lg text-gray-900">Tulis Ulasan Anda</h3>
                    {{-- Tombol Close (Opsional) --}}
                    <a href="{{ route('ulasan.show', $destinasi->id) }}" class="text-gray-400 hover:text-gray-600">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </a>
                </div>

                <form action="{{ route('ulasan.store', $destinasi->id) }}" method="POST">
                    @csrf

                    {{-- 1. INPUT RATING BINTANG --}}
                    <div class="mb-6">
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Rating</label>
                        <div class="flex items-center gap-1 cursor-pointer" id="star-container">
                            {{-- Input Hidden untuk menyimpan nilai rating --}}
                            <input type="hidden" name="rating" id="rating-input" value="0" required>

                            {{-- Generate 5 Bintang dengan JavaScript --}}
                            @for ($i = 1; $i <= 5; $i++)
                                <svg onclick="setRating({{ $i }})" id="star-{{ $i }}"
                                    xmlns="http://www.w3.org/2000/svg"
                                    class="h-8 w-8 text-gray-300 hover:scale-110 transition duration-200 star-icon"
                                    viewBox="0 0 20 20" fill="currentColor">
                                    <path
                                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                </svg>
                            @endfor

                            <span class="ml-2 text-lg font-bold text-gray-800" id="rating-text">0/5</span>
                        </div>
                        @error('rating')
                            <p class="text-red-500 text-xs mt-1">Harap pilih bintang rating.</p>
                        @enderror
                    </div>

                    {{-- 2. INPUT TEXTAREA --}}
                    <div class="mb-6">
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Ulasan Anda</label>
                        <textarea name="ulasan" rows="5"
                            class="w-full border border-gray-300 rounded-xl p-4 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition resize-none"
                            placeholder="Ceritakan pengalaman Anda di sini..." required></textarea>
                        @error('ulasan')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="flex gap-4">
                        <a href="{{ route('ulasan.show', $destinasi->id) }}"
                            class="w-1/3 bg-gray-200 hover:bg-gray-300 text-gray-800 font-bold py-3 rounded-xl text-center transition">
                            Batal
                        </a>
                        <button type="submit"
                            class="w-2/3 bg-[#6366F1] hover:bg-indigo-700 text-white font-bold py-3 rounded-xl shadow-md transition">
                            Kirim Ulasan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Script untuk Handle Bintang --}}
    <script>
        function setRating(rating) {
            // 1. Isi nilai ke input hidden
            document.getElementById('rating-input').value = rating;

            // 2. Update teks rating (misal: 4/5)
            document.getElementById('rating-text').innerText = rating + '/5';

            // 3. Update warna bintang
            for (let i = 1; i <= 5; i++) {
                let star = document.getElementById('star-' + i);
                if (i <= rating) {
                    // Jika bintang kurang dari atau sama dengan rating, warnai kuning
                    star.classList.remove('text-gray-300');
                    star.classList.add('text-yellow-400');
                } else {
                    // Sisanya warnai abu-abu
                    star.classList.remove('text-yellow-400');
                    star.classList.add('text-gray-300');
                }
            }
        }
    </script>
@endsection
