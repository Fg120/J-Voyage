@extends('layouts.auth.app')
@section('tittle')
    Verifikasi Email
@endsection

@section('form')
    <div class="bg-white w-full max-w-md p-8 rounded-lg text-neutral-900 shadow-lg">
        <div class="flex flex-col gap-2 mb-6 text-center">
            <div class="flex justify-center mb-2">
                <div class="bg-indigo-100 p-4 rounded-full">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10 text-indigo-500" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                    </svg>
                </div>
            </div>
            <h1 class="text-2xl font-bold">Verifikasi Email Anda</h1>
            <p class="text-sm text-gray-600">
                Terima kasih telah mendaftar! Sebelum memulai, silakan verifikasi alamat email Anda dengan mengklik tautan
                yang baru saja kami kirim ke:
            </p>
            <p class="text-indigo-600 font-semibold">{{ Auth::user()->email }}</p>
        </div>

        @if (session('status') == 'verification-link-sent')
            <div class="mb-4 p-3 bg-green-50 border border-green-200 rounded-lg">
                <p class="text-sm text-green-700 text-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 inline mr-1" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                    Link verifikasi baru telah dikirim ke alamat email Anda.
                </p>
            </div>
        @endif

        <div class="flex flex-col gap-3">
            <form method="POST" action="{{ route('verification.send') }}">
                @csrf
                <button type="submit"
                    class="w-full text-center bg-indigo-500 py-2.5 hover:bg-indigo-600 active:bg-indigo-700 transition rounded-lg font-semibold text-white shadow-sm">
                    Kirim Ulang Email Verifikasi
                </button>
            </form>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit"
                    class="w-full text-center bg-gray-100 py-2.5 hover:bg-gray-200 transition rounded-lg font-semibold text-gray-700">
                    Keluar
                </button>
            </form>
        </div>

        <p class="text-xs text-gray-500 text-center mt-6">
            Tidak menerima email? Periksa folder spam Anda atau klik tombol di atas untuk mengirim ulang.
        </p>
    </div>
@endsection