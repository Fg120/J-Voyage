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
                    <input type="email" placeholder="nama@email.com" id="email" name="email" value="{{ old('email') }}"
                        required autofocus autocomplete="email"
                        class="border-gray-300 rounded-lg py-2.5 px-3 focus:border-indigo-500 focus:ring focus:ring-indigo-200 transition">
                    @error('email')
                        <div class="error text-red-600">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Password -->
                <div class="flex flex-col gap-1">
                    <label for="password" class="font-semibold text-sm">Kata Sandi</label>


                    <div class="relative">
                        <input type="password" placeholder="Masukkan password" id="password" name="password" required
                            autocomplete="current-password"
                            class="w-full border-gray-300 rounded-lg py-2.5 pl-3 pr-10 focus:border-indigo-500 focus:ring focus:ring-indigo-200 transition">

                        <button type="button" onclick="togglePassword()"
                            class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-500 hover:text-indigo-600 transition">

                            <svg id="icon-eye" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="w-5 h-5 hidden">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>

                            <svg id="icon-eye-slash" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="w-5 h-5 block">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M3.98 8.223A10.477 10.477 0 001.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.45 10.45 0 0112 4.5c4.756 0 8.773 3.162 10.065 7.498a10.523 10.523 0 01-4.293 5.774M6.228 6.228L3 3m3.228 3.228l3.65 3.65m7.894 7.894L21 21m-3.228-3.228l-3.65-3.65m0 0a3 3 0 10-4.243-4.243m4.242 4.242L9.88 9.88" />
                            </svg>
                        </button>
                    </div>
                    @error('password')
                        <div class="error text-red-600">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <!-- Remember Me -->
            <div class="flex justify-between items-center mb-6">
                <div class="flex items-center gap-2">
                    <input type="checkbox" id="remember" name="remember"
                        class="rounded cursor-pointer text-indigo-500 focus:ring-indigo-200">
                    <label for="remember" class="text-sm text-gray-700">Ingat saya</label>
                </div>

                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}"
                        class="text-indigo-500 font-sans font-semibold text-sm hover:text-indigo-700 transition">Lupa kata
                        sandi?</a>
                @endif
            </div>

            <!-- Login Button -->
            <button type="submit"
                class="w-full text-center bg-indigo-500 py-2.5 hover:bg-indigo-600 active:bg-indigo-700 transition rounded-lg font-semibold text-white shadow-sm">
                Masuk </button>
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
                    Masuk dengan Google
                </a>
            </div>
            <div class="flex items-center gap-3 justify-center my-5">
                <div class="flex-1 bg-gray-300 h-px"></div>
            </div>
            <div class="flex justify-center">
                @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="text-sm  ">Belum Punya Akun? <span
                            class="text-indigo-500 font-semibold hover:text-indigo-700 transition">Daftar Sekarang </span> </a>
                @endif
            </div>

        </form>
    </div>

    <script>
        function togglePassword() {
            var passwordInput = document.getElementById("password");
            var iconEye = document.getElementById("icon-eye");
            var iconEyeSlash = document.getElementById("icon-eye-slash");

            if (passwordInput.type === "password") {
                passwordInput.type = "text";
                iconEye.classList.remove("hidden");
                iconEyeSlash.classList.add("hidden");
            } else {
                passwordInput.type = "password";
                iconEye.classList.add("hidden");
                iconEyeSlash.classList.remove("hidden");
            }
        }
    </script>
@endsection