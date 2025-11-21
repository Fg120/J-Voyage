@extends('layouts.admin.app')

@section('content')
    {{-- <div class="max-w-4xl space-y-6"> --}}
    <div class="w-full space-y-6">
        <!-- Header -->
        <div class="flex items-center justify-between">
            <div class="flex items-center gap-4">
                <a href="{{ route('admin.users.index') }}" class="text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-gray-200">
                    <i data-lucide="arrow-left" class="size-6"></i>
                </a>
                <div>
                    <h1 class="text-2xl font-semibold text-gray-900">Detail User</h1>
                    <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">Lihat informasi user</p>
                </div>
            </div>
            <a href="{{ route('admin.users.edit', $user->id) }}"
                class="inline-flex items-center gap-x-2 px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-lg focus:outline-hidden focus:ring-2 focus:ring-blue-500">
                <i data-lucide="edit" class="size-4"></i>
                Ubah
            </a>
        </div>

        <!-- User Info Card -->
        <div class="bg-white dark:bg-neutral-800 rounded-lg shadow overflow-hidden">
            <!-- Header -->
            <div class="bg-gradient-to-r from-blue-500 to-purple-600 h-32"></div>

            <!-- Content -->
            <div class="px-6 pb-6">
                <!-- Avatar -->
                <div class="relative -mt-16 mb-4">
                    <div class="size-32 rounded-full bg-white dark:bg-neutral-800 p-2 shadow-lg">
                        <div class="size-full rounded-full bg-gradient-to-br from-blue-500 to-purple-600 flex items-center justify-center text-white text-4xl font-bold">
                            {{ strtoupper(substr($user->name, 0, 1)) }}
                        </div>
                    </div>
                </div>

                <!-- Info Grid -->
                <div class="space-y-4">
                    <!-- Name -->
                    <div>
                        <label class="block text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Nama</label>
                        <p class="text-lg font-semibold text-gray-900 dark:text-white">{{ $user->name }}</p>
                    </div>

                    <!-- Email -->
                    <div>
                        <label class="block text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Email</label>
                        <p class="text-lg text-gray-900 dark:text-white">{{ $user->email }}</p>
                    </div>

                    <!-- Telepon -->
                    <div>
                        <label class="block text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Telepon</label>
                        <p class="text-lg text-gray-900 dark:text-white">{{ $user->telepon }}</p>
                    </div>

                    <!-- Roles -->
                    <div>
                        <label class="block text-sm font-medium text-gray-500 dark:text-gray-400 mb-2">Peran</label>
                        <div class="flex flex-wrap gap-2">
                            @forelse ($user->roles as $role)
                                <span class="px-3 py-1 text-sm font-medium rounded-full bg-blue-100 text-blue-800 dark:bg-blue-900/30 dark:text-blue-400">
                                    {{ $role->name }}
                                </span>
                            @empty
                                <span class="text-gray-500 dark:text-gray-400">Tidak ada peran yang ditugaskan</span>
                            @endforelse
                        </div>
                    </div>

                    <!-- Permissions -->
                    @if ($user->getAllPermissions()->isNotEmpty())
                        <div>
                            <label class="block text-sm font-medium text-gray-500 dark:text-gray-400 mb-2">Izin</label>
                            <div class="flex flex-wrap gap-2">
                                @foreach ($user->getAllPermissions() as $permission)
                                    <span class="px-3 py-1 text-sm rounded-full bg-purple-100 text-purple-800 dark:bg-purple-900/30 dark:text-purple-400">
                                        {{ $permission->name }}
                                    </span>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    <!-- Status -->
                    <div>
                        <label class="block text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Status</label>
                        <span class="inline-flex px-3 py-1 text-sm font-medium rounded-full bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-400">
                            Aktif
                        </span>
                    </div>

                    <!-- Timestamps -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 pt-4 border-t border-gray-200 dark:border-neutral-700">
                        <div>
                            <label class="block text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Dibuat Pada</label>
                            <p class="text-sm text-gray-900 dark:text-white">
                                {{ $user->created_at->format('F d, Y h:i A') }}
                            </p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Pembaruan Terakhir</label>
                            <p class="text-sm text-gray-900 dark:text-white">
                                {{ $user->updated_at->format('F d, Y h:i A') }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Danger Zone -->
        <div class="bg-white dark:bg-neutral-800 rounded-lg shadow p-6 border-l-4 border-red-500">
            <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">Zona Berbahaya</h3>
            <p class="text-sm text-gray-600 dark:text-gray-400 mb-4">
                Setelah Anda menghapus user ini, akun akan dihapus secara soft dan dapat dipulihkan nanti.
            </p>
            <form method="POST" action="{{ route('admin.users.destroy', $user->id) }}" class="inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="px-4 py-2 bg-red-600 hover:bg-red-700 text-white text-sm font-medium rounded-lg focus:outline-hidden focus:ring-2 focus:ring-red-500"
                    onclick="return confirm('Apakah Anda yakin ingin menghapus user ini?')">
                    Hapus User
                </button>
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
