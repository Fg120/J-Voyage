@extends('layouts.profile.app')

@section('content')
    <div class="space-y-6">
        <!-- Update Profile Information -->
        <div class="bg-white rounded-2xl shadow-md p-8">
            <div class="max-w-xl">
                <header class="mb-6">
                    <h2 class="text-xl font-bold text-gray-900">Informasi Profil</h2>
                    <p class="mt-1 text-sm text-gray-600">Perbarui informasi profil dan alamat email akun Anda.</p>
                </header>

                <form id="send-verification" method="post" action="{{ route('verification.send') }}">
                    @csrf
                </form>

                <form method="post" action="{{ route('profile.update') }}" class="space-y-6">
                    @csrf
                    @method('patch')

                    <div>
                        <label for="name" class="block font-semibold text-sm text-gray-700 mb-1">Nama</label>
                        <input id="name" name="name" type="text" class="w-full border-gray-300 rounded-lg py-2.5 px-3 focus:border-indigo-500 focus:ring focus:ring-indigo-200 transition"
                            value="{{ old('name', $user->name) }}" required autofocus autocomplete="name" />
                        @error('name')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="email" class="block font-semibold text-sm text-gray-700 mb-1">Email</label>
                        <input id="email" name="email" type="email" class="w-full border-gray-300 rounded-lg py-2.5 px-3 focus:border-indigo-500 focus:ring focus:ring-indigo-200 transition"
                            value="{{ old('email', $user->email) }}" required autocomplete="username" />
                        @error('email')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror

                        @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && !$user->hasVerifiedEmail())
                            <div class="mt-2">
                                <p class="text-sm text-gray-800">
                                    Email Anda belum diverifikasi.
                                    <button form="send-verification" class="underline text-sm text-indigo-600 hover:text-indigo-700">
                                        Klik di sini untuk mengirim ulang email verifikasi.
                                    </button>
                                </p>

                                @if (session('status') === 'verification-link-sent')
                                    <p class="mt-2 font-medium text-sm text-green-600">
                                        Link verifikasi baru telah dikirim ke alamat email Anda.
                                    </p>
                                @endif
                            </div>
                        @endif
                    </div>

                    <div>
                        <label for="telepon" class="block font-semibold text-sm text-gray-700 mb-1">Nomor Telepon</label>
                        <input id="telepon" name="telepon" type="tel" class="w-full border-gray-300 rounded-lg py-2.5 px-3 focus:border-indigo-500 focus:ring focus:ring-indigo-200 transition"
                            value="{{ old('telepon', $user->telepon) }}" placeholder="+62" autocomplete="tel" />
                        @error('telepon')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex items-center gap-4 pt-4">
                        <button type="submit" class="px-6 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white font-semibold rounded-lg transition">Simpan</button>

                        @if (session('status') === 'profile-updated')
                            <p class="text-sm text-green-600">Tersimpan.</p>
                        @endif
                    </div>
                </form>
            </div>
        </div>

        <!-- Update Password -->
        <div class="bg-white rounded-2xl shadow-md p-8">
            <div class="max-w-xl">
                <header class="mb-6">
                    <h2 class="text-xl font-bold text-gray-900">Perbarui Password</h2>
                    <p class="mt-1 text-sm text-gray-600">Pastikan akun Anda menggunakan password yang panjang dan acak agar tetap aman.</p>
                </header>

                <form method="post" action="{{ route('password.update') }}" class="space-y-6">
                    @csrf
                    @method('put')

                    <div>
                        <label for="update_password_current_password" class="block font-semibold text-sm text-gray-700 mb-1">Password Saat Ini</label>
                        <input id="update_password_current_password" name="current_password" type="password"
                            class="w-full border-gray-300 rounded-lg py-2.5 px-3 focus:border-indigo-500 focus:ring focus:ring-indigo-200 transition" autocomplete="current-password" />
                        @error('current_password', 'updatePassword')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="update_password_password" class="block font-semibold text-sm text-gray-700 mb-1">Password Baru</label>
                        <input id="update_password_password" name="password" type="password"
                            class="w-full border-gray-300 rounded-lg py-2.5 px-3 focus:border-indigo-500 focus:ring focus:ring-indigo-200 transition" autocomplete="new-password" />
                        @error('password', 'updatePassword')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="update_password_password_confirmation" class="block font-semibold text-sm text-gray-700 mb-1">Konfirmasi Password</label>
                        <input id="update_password_password_confirmation" name="password_confirmation" type="password"
                            class="w-full border-gray-300 rounded-lg py-2.5 px-3 focus:border-indigo-500 focus:ring focus:ring-indigo-200 transition" autocomplete="new-password" />
                        @error('password_confirmation', 'updatePassword')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex items-center gap-4 pt-4">
                        <button type="submit" class="px-6 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white font-semibold rounded-lg transition">Simpan</button>

                        @if (session('status') === 'password-updated')
                            <p class="text-sm text-green-600">Tersimpan.</p>
                        @endif
                    </div>
                </form>
            </div>
        </div>

        <!-- Delete Account -->
        <div class="bg-white rounded-2xl shadow-md p-8">
            <div class="max-w-xl">
                <header class="mb-6">
                    <h2 class="text-xl font-bold text-gray-900">Hapus Akun</h2>
                    <p class="mt-1 text-sm text-gray-600">Setelah akun Anda dihapus, semua sumber daya dan data akan dihapus secara permanen. Sebelum menghapus akun, harap unduh data atau informasi yang
                        ingin Anda simpan.</p>
                </header>

                <button type="button" onclick="document.getElementById('deleteModal').style.display='flex'" class="px-6 py-2.5 bg-red-600 hover:bg-red-700 text-white font-semibold rounded-lg transition">
                    Hapus Akun
                </button>

                <!-- Delete Confirmation Modal -->
                <div id="deleteModal" style="display: none;" class="fixed inset-0 bg-gray-500 bg-opacity-75 flex items-center justify-center z-50">
                    <div class="bg-white rounded-lg p-6 max-w-md w-full mx-4">
                        <form method="post" action="{{ route('profile.destroy') }}">
                            @csrf
                            @method('delete')

                            <h2 class="text-lg font-bold text-gray-900 mb-4">
                                Apakah Anda yakin ingin menghapus akun Anda?
                            </h2>

                            <p class="text-sm text-gray-600 mb-6">
                                Setelah akun Anda dihapus, semua sumber daya dan data akan dihapus secara permanen. Silakan masukkan password Anda untuk mengkonfirmasi bahwa Anda ingin menghapus akun
                                secara permanen.
                            </p>

                            <div class="mb-6">
                                <label for="password" class="sr-only">Password</label>
                                <input id="password" name="password" type="password"
                                    class="w-full border-gray-300 rounded-lg py-2.5 px-3 focus:border-indigo-500 focus:ring focus:ring-indigo-200 transition" placeholder="Password" />
                                @error('password', 'userDeletion')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="flex justify-end gap-3">
                                <button type="button" onclick="document.getElementById('deleteModal').style.display='none'"
                                    class="px-4 py-2 bg-gray-300 hover:bg-gray-400 text-gray-700 font-semibold rounded-lg transition">
                                    Batal
                                </button>
                                <button type="submit" class="px-4 py-2 bg-red-600 hover:bg-red-700 text-white font-semibold rounded-lg transition">
                                    Hapus Akun
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
