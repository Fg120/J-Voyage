@extends('layouts.auth.app')
@section('tittle')
    Login
@endsection

@section('form')
<div class="bg-white w-[450px] h-[450px] p-8 rounded-lg text-neutral-900">
        <div class="flex flex-col gap-1 mb-5">
            <h1 class="text-3xl font-bold">Selamat Datang</h1>
            <p class="opacity-80">Masuk ke akun Anda untuk melanjutkan</p>
        </div>

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="flex flex-col gap-5 mb-2">
                 <!-- Email -->
            <div class="flex flex-col">
                <label for="email" class="font-semibold">Email</label>
                <input type="email" placeholder="nama@email.com" id="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="email" class="border-gray-400 rounded-lg">
                @error('email')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <!-- Password -->
            <div class="flex flex-col">
                <label for="password" class="font-semibold">Kata Sandi</label>
                <input type="password" placeholder="Masukkan password" id="password" name="password" required autocomplete="current-password" class="border-gray-400 rounded-lg">
                @error('password')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>
            </div>

            <!-- Remember Me -->
            <div class="flex justify-between mb-5">
                <div class="flex items-center gap-1 ">
                <input type="checkbox" id="remember" name="remember" class="rounded cursor-pointer">
                <label for="remember" class="text-sm">Ingat saya</label>
                </div>

                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" class="text-indigo-500 font-sans font-semibold text-sm hover:text-indigo-700 transition">Lupa kata sandi?</a>
                @endif
            </div>

            <!-- Login Button -->
            <button type="submit" class="w-full text-center bg-indigo-300 py-2 hover:bg-indigo-500 transition rounded-lg font-semibold text-neutral-50"> Masuk </button>
            <div class="flex items-center gap-2 justify-center mt-2">
                <div class="w-[150px] bg-neutral-200 h-1">
                </div>
                <p class="text-sm">
                    atau
                </p>
                <div class="w-[150px] bg-neutral-300 h-1">

                </div>
            </div>
            <div class="flex justify-center mt-2">
                @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="text-sm  ">Belum Punya Akun? <span class="text-indigo-500 font-semibold hover:text-indigo-700 transition">Daftar Sekarang </span> </a>
                @endif
            </div>

        </form>
    </div>
@endsection
