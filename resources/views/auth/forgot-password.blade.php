@extends('layouts.auth.app')
@section('tittle')
    Lupa Password
@endsection

@section('form')
    <div class="bg-white w-full max-w-md p-8 rounded-lg text-neutral-900 shadow-lg">
        <div class="flex flex-col gap-2 mb-6 text-center">
            <div class="flex justify-center mb-2">
                <div class="bg-indigo-100 p-4 rounded-full">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10 text-indigo-500" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z" />
                    </svg>
                </div>
            </div>
            <h1 class="text-2xl font-bold">Lupa Kata Sandi?</h1>
            <p class="text-sm text-gray-600">
                Tidak masalah. Masukkan alamat email Anda dan kami akan mengirimkan tautan untuk mengatur ulang kata sandi.
            </p>
        </div>

        @if (session('status'))
            <div class="mb-4 p-3 bg-green-50 border border-green-200 rounded-lg">
                <p class="text-sm text-green-700 text-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 inline mr-1" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                    Link reset kata sandi telah dikirim ke email Anda.
                </p>
            </div>
        @endif

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <div class="flex flex-col gap-4 mb-6">
                <div class="flex flex-col gap-1">
                    <label for="email" class="font-semibold text-sm">Email</label>
                    <input type="email" placeholder="nama@email.com" id="email" name="email" value="{{ old('email') }}"
                        required autofocus
                        class="border-gray-300 rounded-lg py-2.5 px-3 focus:border-indigo-500 focus:ring focus:ring-indigo-200 transition">
                    @error('email')
                        <div class="text-red-600 text-sm">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <button type="submit"
                class="w-full text-center bg-indigo-500 py-2.5 hover:bg-indigo-600 active:bg-indigo-700 transition rounded-lg font-semibold text-white shadow-sm">
                Kirim Link Reset Password
            </button>
        </form>

        <div class="flex justify-center mt-6">
            <a href="{{ route('login') }}" class="text-sm text-indigo-500 hover:text-indigo-700 transition font-semibold">
                ← Kembali ke Login
            </a>
        </div>
    </div>
@endsection