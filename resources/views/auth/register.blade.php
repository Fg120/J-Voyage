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
                    <input type="text" placeholder="Masukkan Nama Lengkap" id="name" name="name" value="{{ old('name') }}"
                        required autofocus autocomplete="name"
                        class="border-gray-300 rounded-lg py-2.5 px-3 focus:border-indigo-500 focus:ring focus:ring-indigo-200 transition">
                    @error('name')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="flex flex-col gap-1">
                    <label for="email" class="font-semibold text-sm">Email</label>
                    <input type="email" placeholder="Masukkan Email Anda" id="email" name="email" value="{{ old('email') }}"
                        required autocomplete="email"
                        class="border-gray-300 rounded-lg py-2.5 px-3 focus:border-indigo-500 focus:ring focus:ring-indigo-200 transition">
                    @error('email')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="flex flex-col gap-1">
                    <label for="telepon" class="font-semibold text-sm">Telepon</label>
                    <input type="text" placeholder="Masukkan Nomor Telepon" id="telepon" name="telepon"
                        value="{{ old('telepon') }}" required autocomplete="tel"
                        class="border-gray-300 rounded-lg py-2.5 px-3 focus:border-indigo-500 focus:ring focus:ring-indigo-200 transition">
                    @error('telepon')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Password -->
                <div class="flex flex-col gap-1">
                    <label for="password" class="font-semibold text-sm">Kata Sandi</label>
                    <input type="password" placeholder="Masukkan Kata Sandi" id="password" name="password" required
                        autocomplete="new-password"
                        class="border-gray-300 rounded-lg py-2.5 px-3 focus:border-indigo-500 focus:ring focus:ring-indigo-200 transition">
                    @error('password')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="flex flex-col gap-1">
                    <label for="password-confirm" class="font-semibold text-sm">Konfirmasi Kata Sandi</label>
                    <input type="password" placeholder="Konfirmasi kata Sandi" id="password-confirm"
                        name="password_confirmation" required autocomplete="new-password"
                        class="border-gray-300 rounded-lg py-2.5 px-3 focus:border-indigo-500 focus:ring focus:ring-indigo-200 transition">
                    @error('password_confirmation')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <!-- Login Button -->
            <button type="submit"
                class="w-full text-center bg-indigo-500 hover:bg-indigo-600 active:bg-indigo-700 transition py-2.5 text-white rounded-lg font-semibold shadow-sm">Daftar</button>
            <div class="flex items-center gap-3 justify-center my-5">
                <div class="flex-1 bg-gray-300 h-px"></div>
                <p class="text-sm text-gray-500">atau</p>
                <div class="flex-1 bg-gray-300 h-px"></div>
            </div>
            <div class="mt-4">
                <a href="{{ route('google.login') }}"
                    class="w-full inline-flex items-center justify-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150">
                    <svg class="w-5 h-5 mr-2" viewBox="0 0 21 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <g clip-path="url(#clip0_13183_10121)">
                            <path
                                d="M20.3081 10.2303C20.3081 9.55056 20.253 8.86711 20.1354 8.19836H10.7031V12.0492H16.1046C15.8804 13.2911 15.1602 14.3898 14.1057 15.0879V17.5866H17.3282C19.2205 15.8449 20.3081 13.2728 20.3081 10.2303Z"
                                fill="#3F83F8" />
                            <path
                                d="M10.7019 20.0006C13.3989 20.0006 15.6734 19.1151 17.3306 17.5865L14.1081 15.0879C13.2115 15.6979 12.0541 16.0433 10.7056 16.0433C8.09669 16.0433 5.88468 14.2832 5.091 11.9169H1.76562V14.4927C3.46322 17.8695 6.92087 20.0006 10.7019 20.0006V20.0006Z"
                                fill="#34A853" />
                            <path
                                d="M5.08857 11.9169C4.66969 10.6749 4.66969 9.33008 5.08857 8.08811V5.51233H1.76688C0.348541 8.33798 0.348541 11.667 1.76688 14.4927L5.08857 11.9169V11.9169Z"
                                fill="#FBBC04" />
                            <path
                                d="M10.7019 3.95805C12.1276 3.936 13.5055 4.47247 14.538 5.45722L17.393 2.60218C15.5852 0.904587 13.1858 -0.0287217 10.7019 0.000673888C6.92087 0.000673888 3.46322 2.13185 1.76562 5.51234L5.08732 8.08813C5.87733 5.71811 8.09302 3.95805 10.7019 3.95805V3.95805Z"
                                fill="#EA4335" />
                        </g>
                    </svg>
                    Daftar dengan Google
                </a>
            </div>
            <div class="flex items-center gap-3 justify-center my-5">
                <div class="flex-1 bg-gray-300 h-px"></div>
            </div>
            <div class="flex justify-center">
                @if (Route::has('register'))
                    <a href="{{ route('login') }}" class="text-sm ">Sudah Punya Akun? <span
                            class="text-indigo-500 font-semibold hover:text-indigo-700 transition">Login</span> </a>
                @endif
            </div>

        </form>
    </div>
@endsection