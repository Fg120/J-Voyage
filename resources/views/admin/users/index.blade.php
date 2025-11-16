@extends('layouts.admin.app')

@section('content')
    <div class="space-y-6">
        <!-- Header -->
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-semibold text-gray-900">Manajemen User</h1>
                <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">Kelola user dengan soft delete dan restore</p>
            </div>
            <a href="{{ route('admin.users.create') }}"
                class="inline-flex items-center gap-x-2 px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-lg focus:outline-hidden focus:ring-2 focus:ring-blue-500">
                <i data-lucide="plus" class="size-4"></i>
                Tambah User
            </a>
        </div>

        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg dark:bg-green-900/30 dark:border-green-800 dark:text-green-400">
                {{ session('success') }}
            </div>
        @endif

        <!-- Filters -->
        <div class="bg-white dark:bg-neutral-800 rounded-lg shadow p-4">
            <form method="GET" action="{{ route('admin.users.index') }}" class="flex flex-col md:flex-row gap-4">
                <div class="flex-1">
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari berdasarkan nama atau email..."
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-hidden focus:ring-2 focus:ring-blue-500 dark:bg-neutral-700 dark:border-neutral-600 dark:text-white">
                </div>
                <div class="flex gap-2">
                    <select name="status"
                        class="px-4 pe-8 py-2 border border-gray-300 rounded-lg focus:outline-hidden focus:ring-2 focus:ring-blue-500 dark:bg-neutral-700 dark:border-neutral-600 dark:text-white">
                        <option value="">User Aktif</option>
                        <option value="trashed" {{ request('status') === 'trashed' ? 'selected' : '' }}>User Terhapus</option>
                    </select>
                    <button type="submit" class="px-4 py-2 bg-gray-600 hover:bg-gray-700 text-white rounded-lg focus:outline-hidden focus:ring-2 focus:ring-gray-500">
                        Filter
                    </button>
                    <a href="{{ route('admin.users.index') }}"
                        class="px-4 py-2 bg-gray-300 hover:bg-gray-400 text-gray-700 rounded-lg focus:outline-hidden focus:ring-2 focus:ring-gray-500 dark:bg-neutral-600 dark:hover:bg-neutral-500 dark:text-white">
                        Reset
                    </a>
                </div>
            </form>
        </div>

        <!-- Table -->
        <div class="bg-white dark:bg-neutral-800 rounded-lg shadow overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200 dark:divide-neutral-700">
                    <thead class="bg-gray-50 dark:bg-neutral-700">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                User
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                Peran
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                Status
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                Dibuat Pada
                            </th>
                            <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                Tindakan
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white dark:bg-neutral-800 divide-y divide-gray-200 dark:divide-neutral-700">
                        @forelse ($users as $user)
                            <tr class="hover:bg-gray-50 dark:hover:bg-neutral-700">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="size-10 flex-shrink-0">
                                            <div class="size-10 rounded-full bg-gradient-to-br from-blue-500 to-purple-600 flex items-center justify-center text-white font-semibold">
                                                {{ strtoupper(substr($user->name, 0, 1)) }}
                                            </div>
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-sm font-medium text-gray-900 dark:text-white">
                                                {{ $user->name }}
                                            </div>
                                            <div class="text-sm text-gray-500 dark:text-gray-400">
                                                {{ $user->email }}
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex flex-wrap gap-1">
                                        @forelse ($user->roles as $role)
                                            <span class="px-2 py-1 text-xs font-medium rounded-full bg-blue-100 text-blue-800 dark:bg-blue-900/30 dark:text-blue-400">
                                                {{ $role->name }}
                                            </span>
                                        @empty
                                            <span class="text-sm text-gray-500 dark:text-gray-400">Tidak ada peran</span>
                                        @endforelse
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if ($user->trashed())
                                        <span class="px-2 py-1 text-xs font-medium rounded-full bg-red-100 text-red-800 dark:bg-red-900/30 dark:text-red-400">
                                            Dihapus
                                        </span>
                                    @else
                                        <span class="px-2 py-1 text-xs font-medium rounded-full bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-400">
                                            Aktif
                                        </span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                                    {{ $user->created_at->format('M d, Y') }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <div class="flex items-center justify-end gap-2">
                                        @if ($user->trashed())
                                            <!-- Restore Button -->
                                            <form method="POST" action="{{ route('admin.users.restore', $user->id) }}">
                                                @csrf
                                                <button type="submit" class="p-1 text-green-600 hover:text-green-900 dark:text-green-400 dark:hover:text-green-300 transition-colors"
                                                    onclick="return confirm('Apakah Anda yakin ingin mengembalikan user ini?')">
                                                    <i data-lucide="rotate-ccw" class="size-4"></i>
                                                </button>
                                            </form>
                                            <!-- Force Delete Button -->
                                            <form method="POST" action="{{ route('admin.users.force-delete', $user->id) }}">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="p-1 text-red-600 hover:text-red-900 dark:text-red-400 dark:hover:text-red-300 transition-colors"
                                                    onclick="return confirm('Apakah Anda yakin ingin menghapus user ini secara permanen? Tindakan ini tidak dapat dibatalkan!')">
                                                    <i data-lucide="trash-2" class="size-4"></i>
                                                </button>
                                            </form>
                                        @else
                                            <!-- View Button -->
                                            <a href="{{ route('admin.users.show', $user->id) }}"
                                                class="p-1 text-blue-600 hover:text-blue-900 dark:text-blue-400 dark:hover:text-blue-300 transition-colors">
                                                <i data-lucide="eye" class="size-4"></i>
                                            </a>
                                            <!-- Edit Button -->
                                            <a href="{{ route('admin.users.edit', $user->id) }}"
                                                class="p-1 text-yellow-600 hover:text-yellow-900 dark:text-yellow-400 dark:hover:text-yellow-300 transition-colors">
                                                <i data-lucide="edit" class="size-4"></i>
                                            </a>
                                            <!-- Delete Button -->
                                            <form method="POST" action="{{ route('admin.users.destroy', $user->id) }}">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="p-1 text-red-600 hover:text-red-900 dark:text-red-400 dark:hover:text-red-300 transition-colors"
                                                    onclick="return confirm('Apakah Anda yakin ingin menghapus user ini?')">
                                                    <i data-lucide="trash" class="size-4"></i>
                                                </button>
                                            </form>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-8 text-center text-gray-500 dark:text-gray-400">
                                    <i data-lucide="inbox" class="size-12 mx-auto mb-2 opacity-50"></i>
                                    <p>Tidak ada user ditemukan</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            @if ($users->hasPages())
                <div class="px-6 py-4 border-t border-gray-200 dark:border-neutral-700">
                    {{ $users->links() }}
                </div>
            @endif
        </div>
    </div>

    <script>
        // Re-render Lucide icons after page load
        document.addEventListener('DOMContentLoaded', () => {
            if (typeof lucide !== 'undefined') {
                lucide.createIcons();
            }
        });
    </script>
@endsection
