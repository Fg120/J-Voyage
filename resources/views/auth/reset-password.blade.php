@extends('layouts.auth.app')
@section('tittle')
    Reset Password
@endsection

@section('form')
    <div class="bg-white w-full max-w-md p-8 rounded-lg text-neutral-900 shadow-lg">
        <div class="flex flex-col gap-2 mb-6 text-center">
            <div class="flex justify-center mb-2">
                <div class="bg-indigo-100 p-4 rounded-full">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10 text-indigo-500" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                    </svg>
                </div>
            </div>
            <h1 class="text-2xl font-bold">Buat Kata Sandi Baru</h1>
            <p class="text-sm text-gray-600">
                Masukkan kata sandi baru untuk akun Anda
            </p>
        </div>

        <form method="POST" action="{{ route('password.store') }}">
            @csrf

            <input type="hidden" name="token" value="{{ $request->route('token') }}">

            <div class="flex flex-col gap-4 mb-6">
                <!-- Email -->
                <div class="flex flex-col gap-1">
                    <label for="email" class="font-semibold text-sm">Email</label>
                    <input type="email" id="email" name="email" value="{{ old('email', $request->email) }}" required
                        autofocus autocomplete="username"
                        class="border-gray-300 rounded-lg py-2.5 px-3 focus:border-indigo-500 focus:ring focus:ring-indigo-200 transition bg-gray-50">
                    @error('email')
                        <div class="text-red-600 text-sm">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Password -->
                <div class="flex flex-col gap-1">
                    <label for="password" class="font-semibold text-sm">Kata Sandi Baru</label>
                    <div class="relative">
                        <input type="password" placeholder="Masukkan kata sandi baru" id="password" name="password" required
                            autocomplete="new-password"
                            class="w-full border-gray-300 rounded-lg py-2.5 pl-3 pr-10 focus:border-indigo-500 focus:ring focus:ring-indigo-200 transition">
                        <button type="button" onclick="togglePassword('password', 'icon-eye', 'icon-eye-slash')"
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
                        <div class="text-red-600 text-sm">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Confirm Password -->
                <div class="flex flex-col gap-1">
                    <label for="password_confirmation" class="font-semibold text-sm">Konfirmasi Kata Sandi</label>
                    <div class="relative">
                        <input type="password" placeholder="Konfirmasi kata sandi baru" id="password_confirmation"
                            name="password_confirmation" required autocomplete="new-password"
                            class="w-full border-gray-300 rounded-lg py-2.5 pl-3 pr-10 focus:border-indigo-500 focus:ring focus:ring-indigo-200 transition">
                        <button type="button"
                            onclick="togglePassword('password_confirmation', 'icon-eye-confirm', 'icon-eye-slash-confirm')"
                            class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-500 hover:text-indigo-600 transition">
                            <svg id="icon-eye-confirm" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="w-5 h-5 hidden">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            <svg id="icon-eye-slash-confirm" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 block">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M3.98 8.223A10.477 10.477 0 001.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.45 10.45 0 0112 4.5c4.756 0 8.773 3.162 10.065 7.498a10.523 10.523 0 01-4.293 5.774M6.228 6.228L3 3m3.228 3.228l3.65 3.65m7.894 7.894L21 21m-3.228-3.228l-3.65-3.65m0 0a3 3 0 10-4.243-4.243m4.242 4.242L9.88 9.88" />
                            </svg>
                        </button>
                    </div>
                    @error('password_confirmation')
                        <div class="text-red-600 text-sm">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <button type="submit"
                class="w-full text-center bg-indigo-500 py-2.5 hover:bg-indigo-600 active:bg-indigo-700 transition rounded-lg font-semibold text-white shadow-sm">
                Reset Kata Sandi
            </button>
        </form>
    </div>

    <script>
        function togglePassword(inputId, eyeId, eyeSlashId) {
            var passwordInput = document.getElementById(inputId);
            var iconEye = document.getElementById(eyeId);
            var iconEyeSlash = document.getElementById(eyeSlashId);

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