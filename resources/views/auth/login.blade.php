@extends('layouts.auth.app')
@section('tittle')
    Login
@endsection

@section('form')
<div class="bg-white w-full max-w-md p-8 rounded-lg text-neutral-900 shadow-lg">
        <div class="flex flex-col gap-2 mb-6">
            <h1 class="text-3xl font-bold">Selamat Datang</h1>
            <p class="text-sm text-gray-600">Masuk ke akun Anda untuk melanjutkan</p>
        </div>

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="flex flex-col gap-4 mb-4">
                 <!-- Email -->
            <div class="flex flex-col gap-1">
                <label for="email" class="font-semibold text-sm">Email</label>
                <input type="email" placeholder="nama@email.com" id="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="email" class="border-gray-300 rounded-lg py-2.5 px-3 focus:border-indigo-500 focus:ring focus:ring-indigo-200 transition">
                @error('email')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <!-- Password -->
            <div class="flex flex-col gap-1">
                <label for="password" class="font-semibold text-sm">Kata Sandi</label>
                <input type="password" placeholder="Masukkan password" id="password" name="password" required autocomplete="current-password" class="border-gray-300 rounded-lg py-2.5 px-3 focus:border-indigo-500 focus:ring focus:ring-indigo-200 transition">
                @error('password')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>
            </div>

            <!-- Remember Me -->
            <div class="flex justify-between items-center mb-6">
                <div class="flex items-center gap-2">
                <input type="checkbox" id="remember" name="remember" class="rounded cursor-pointer text-indigo-500 focus:ring-indigo-200">
                <label for="remember" class="text-sm text-gray-700">Ingat saya</label>
                </div>

                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" class="text-indigo-500 font-sans font-semibold text-sm hover:text-indigo-700 transition">Lupa kata sandi?</a>
                @endif
            </div>

            <!-- Login Button -->
            <button type="submit" class="w-full text-center bg-indigo-500 py-2.5 hover:bg-indigo-600 active:bg-indigo-700 transition rounded-lg font-semibold text-white shadow-sm"> Masuk </button>
            <div class="flex items-center gap-3 justify-center my-5">
                <div class="flex-1 bg-gray-300 h-px"></div>
                <p class="text-sm text-gray-500">atau</p>
                <div class="flex-1 bg-gray-300 h-px"></div>
            </div>
            <div class="flex justify-center">
                @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="text-sm  ">Belum Punya Akun? <span class="text-indigo-500 font-semibold hover:text-indigo-700 transition">Daftar Sekarang </span> </a>
                @endif
            </div>

        </form>
    </div>
@endsection
