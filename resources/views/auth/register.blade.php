@extends('layouts.auth.app')
@section('tittle')
    Register
@endsection

@section('form')
    <div class="bg-white w-[450px] h-auto p-8 rounded-lg text-neutral-900">
        <div class="flex flex-col gap-1 mb-5">
            <h1 class="text-3xl font-bold">Buat Akun Baru</h1>
            <p class="opacity-80">Daftar sekarang dan mulai petualangan Anda</p>
        </div>

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="flex flex-col gap-5 mb-8">
                <!-- Email -->
                <div class="flex flex-col gap-1">
                    <label for="nama" class="font-semibold">Nama Lengkap</label>
                    <input type="text" placeholder="Masukkan Nama Lengkap" id="nama" name="nama" value="{{ old('nama') }}" required autofocus autocomplete="email"
                        class="border-gray-400 rounded-lg">
                    @error('nama')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="flex flex-col gap-1">
                    <label for="nama" class="font-semibold">Email</label>
                    <input type="email" placeholder="Masukkan Email Anda" id="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="email"
                        class="border-gray-400 rounded-lg">
                    @error('email')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="flex flex-col gap-1">
                    <label for="telepon" class="font-semibold">Telepon</label>
                    <input type="text" placeholder="Masukkan Nomor Telepon" id="telepon" name="telepon" value="{{ old('telepon') }}" required autofocus autocomplete="email"
                        class="border-gray-400 rounded-lg ">
                    @error('telepon')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Password -->
                <div class="flex flex-col gap-1">
                    <label for="password" class="font-semibold">Kata Sandi</label>
                    <input type="password" placeholder="Masukkan Kata Sandi" id="password" name="password" required autocomplete="current-password" class="border-gray-400 rounded-lg">
                    @error('password')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="flex flex-col gap-1">
                    <label for="password-confirm" class="font-semibold">Konfirmasi Kata Sandi</label>
                    <input type="password" placeholder="Konfirmasi kata Sandi" id="password-confirm" name="password-confirm" required autocomplete="current-password" class="border-gray-400 rounded-lg">
                    @error('password-confirm')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <!-- Login Button -->
            <button type="submit" class="w-full text-center bg-indigo-300 hover:bg-indigo-500 transition py-2 text-neutral-50 rounded-lg font-semibold">Daftar</button>
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
                    <a href="{{ route('login') }}" class="text-sm ">Sudah Punya Akun? <span class="text-indigo-500 font-semibold hover:text-indigo-700 transition">Login</span> </a>
                @endif
            </div>

        </form>
    </div>
@endsection
