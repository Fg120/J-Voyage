@extends('layouts.admin.app')

@section('content')
    <div class="max-w-3xl space-y-6">
        <!-- Header -->
        <div class="flex items-center gap-4">
            <a href="{{ route('admin.users.index') }}" class="text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-gray-200">
                <i data-lucide="arrow-left" class="size-6"></i>
            </a>
            <div>
                <h1 class="text-2xl font-semibold text-gray-900">Ubah User</h1>
                <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">Perbarui informasi user</p>
            </div>
        </div>

        <!-- Form -->
        <div class="bg-white dark:bg-neutral-800 rounded-lg shadow p-6">
            <form method="POST" action="{{ route('admin.users.update', $user->id) }}" class="space-y-6">
                @csrf
                @method('PUT')

                <!-- Name -->
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        Nama <span class="text-red-500">*</span>
                    </label>
                    <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}" required
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-hidden focus:ring-2 focus:ring-blue-500 dark:bg-neutral-700 dark:border-neutral-600 dark:text-white @error('name') border-red-500 @enderror">
                    @error('name')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Email -->
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        Email <span class="text-red-500">*</span>
                    </label>
                    <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}" required
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-hidden focus:ring-2 focus:ring-blue-500 dark:bg-neutral-700 dark:border-neutral-600 dark:text-white @error('email') border-red-500 @enderror">
                    @error('email')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Password -->
                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        Kata Sandi
                    </label>
                    <input type="password" id="password" name="password"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-hidden focus:ring-2 focus:ring-blue-500 dark:bg-neutral-700 dark:border-neutral-600 dark:text-white @error('password') border-red-500 @enderror">
                    <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Biarkan kosong untuk menyimpan kata sandi saat ini</p>
                    @error('password')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Password Confirmation -->
                <div>
                    <label for="password_confirmation" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        Konfirmasi Kata Sandi
                    </label>
                    <input type="password" id="password_confirmation" name="password_confirmation"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-hidden focus:ring-2 focus:ring-blue-500 dark:bg-neutral-700 dark:border-neutral-600 dark:text-white">
                </div>

                <!-- Roles -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        Peran
                    </label>
                    <div class="space-y-2">
                        @foreach ($roles as $role)
                            <label class="flex items-center">
                                <input type="checkbox" name="roles[]" value="{{ $role->name }}" {{ $user->hasRole($role->name) || in_array($role->name, old('roles', [])) ? 'checked' : '' }}
                                    class="rounded border-gray-300 text-blue-600 focus:ring-blue-500 dark:bg-neutral-700 dark:border-neutral-600">
                                <span class="ml-2 text-sm text-gray-700 dark:text-gray-300">{{ $role->name }}</span>
                            </label>
                        @endforeach
                    </div>
                    @error('roles')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Actions -->
                <div class="flex items-center gap-4 pt-4 border-t border-gray-200 dark:border-neutral-700">
                    <button type="submit" class="px-6 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg focus:outline-hidden focus:ring-2 focus:ring-blue-500">
                        Perbarui User
                    </button>
                    <a href="{{ route('admin.users.index') }}"
                        class="px-6 py-2 bg-gray-300 hover:bg-gray-400 text-gray-700 rounded-lg focus:outline-hidden focus:ring-2 focus:ring-gray-500 dark:bg-neutral-600 dark:hover:bg-neutral-500 dark:text-white">
                        Batal
                    </a>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            if (typeof lucide !== 'undefined') {
                lucide.createIcons();
            }
        });
    </script>
@endsection
