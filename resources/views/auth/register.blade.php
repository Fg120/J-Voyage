@extends('layouts.auth.app')
@section('tittle')
    Register
@endsection

@section('form')
    <div class="bg-white w-full max-w-md p-8 rounded-lg text-neutral-900 shadow-lg">
        <div class="flex flex-col gap-2 mb-6">
            <h1 class="text-3xl font-bold">Buat Akun Baru</h1>
            <p class="text-sm text-gray-600">Daftar sekarang dan mulai petualangan Anda</p>
        </div>

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div class="flex flex-col gap-4 mb-6">
                <!-- Email -->
                <div class="flex flex-col gap-1">
                    <label for="nama" class="font-semibold text-sm">Nama Lengkap</label>
                    <input type="text" placeholder="Masukkan Nama Lengkap" id="name" name="name" value="{{ old('name') }}" required autofocus autocomplete="name"
                        class="border-gray-300 rounded-lg py-2.5 px-3 focus:border-indigo-500 focus:ring focus:ring-indigo-200 transition">
                    @error('name')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="flex flex-col gap-1">
                    <label for="email" class="font-semibold text-sm">Email</label>
                    <input type="email" placeholder="Masukkan Email Anda" id="email" name="email" value="{{ old('email') }}" required autocomplete="email"
                        class="border-gray-300 rounded-lg py-2.5 px-3 focus:border-indigo-500 focus:ring focus:ring-indigo-200 transition">
                    @error('email')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="flex flex-col gap-1">
                    <label for="telepon" class="font-semibold text-sm">Telepon</label>
                    <input type="text" placeholder="Masukkan Nomor Telepon" id="telepon" name="telepon" value="{{ old('telepon') }}" required autocomplete="tel"
                        class="border-gray-300 rounded-lg py-2.5 px-3 focus:border-indigo-500 focus:ring focus:ring-indigo-200 transition">
                    @error('telepon')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Password -->
                <div class="flex flex-col gap-1">
                    <label for="password" class="font-semibold text-sm">Kata Sandi</label>
                    <input type="password" placeholder="Masukkan Kata Sandi" id="password" name="password" required autocomplete="new-password" class="border-gray-300 rounded-lg py-2.5 px-3 focus:border-indigo-500 focus:ring focus:ring-indigo-200 transition">
                    @error('password')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="flex flex-col gap-1">
                    <label for="password-confirm" class="font-semibold text-sm">Konfirmasi Kata Sandi</label>
                    <input type="password" placeholder="Konfirmasi kata Sandi" id="password-confirm" name="password_confirmation" required autocomplete="new-password"
                        class="border-gray-300 rounded-lg py-2.5 px-3 focus:border-indigo-500 focus:ring focus:ring-indigo-200 transition">
                    @error('password_confirmation')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <!-- Login Button -->
            <button type="submit" class="w-full text-center bg-indigo-500 hover:bg-indigo-600 active:bg-indigo-700 transition py-2.5 text-white rounded-lg font-semibold shadow-sm">Daftar</button>
            <div class="flex items-center gap-3 justify-center my-5">
                <div class="flex-1 bg-gray-300 h-px"></div>
                <p class="text-sm text-gray-500">atau</p>
                <div class="flex-1 bg-gray-300 h-px"></div>
            </div>
            <div class="flex justify-center">
                @if (Route::has('register'))
                    <a href="{{ route('login') }}" class="text-sm ">Sudah Punya Akun? <span class="text-indigo-500 font-semibold hover:text-indigo-700 transition">Login</span> </a>
                @endif
            </div>

        </form>
    </div>
@endsection
