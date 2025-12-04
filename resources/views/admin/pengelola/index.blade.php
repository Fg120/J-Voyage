@extends('layouts.admin.app')

@section('content')
    <div class="px-6 py-8 min-h-screen  text-black font-poppins">

        <div class="mb-8 flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
            <div>
                <h1 class="text-2xl font-bold text-black">Manajemen Pengelola</h1>
                <p class="text-neutral-400 text-sm mt-1">Kelola pengajuan dan status pengelola wisata</p>
            </div>
        </div>

        @if (session('success'))
            <div
                class="bg-green-500/10 border border-green-500/20 text-green-400 px-4 py-3 rounded-lg mb-6 flex items-center gap-2">
                <i data-lucide="check-circle" class="w-5 h-5"></i>
                {{ session('success') }}
            </div>
        @endif

        <div class="bg-neutral-800 p-2 rounded-xl mb-6 flex flex-col md:flex-row gap-2">
            <form method="GET" action="{{ route('admin.pengelola.index') }}" class="flex-1 flex gap-2 w-full">
                <div class="relative flex-1">
                    <i data-lucide="search" class="absolute left-3 top-1/2 -translate-y-1/2 w-5 h-5 text-neutral-500"></i>
                    <input type="text" name="search" value="{{ request('search') }}"
                        placeholder="Cari berdasarkan nama user atau wisata..."
                        class="w-full bg-neutral-700/50 border-none text-white placeholder-neutral-500 text-sm rounded-lg pl-10 pr-4 py-2.5 focus:ring-2 focus:ring-indigo-500 focus:bg-neutral-700 transition">
                </div>

                <select name="status"
                    class="bg-neutral-700/50 border-none text-white text-sm rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-indigo-500 cursor-pointer w-40">
                    <option value="all" {{ request('status') == 'all' ? 'selected' : '' }}>Semua Status</option>
                    <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="approved" {{ request('status') == 'approved' ? 'selected' : '' }}>Disetujui</option>
                    <option value="rejected" {{ request('status') == 'rejected' ? 'selected' : '' }}>Ditolak</option>
                    <option value="blocked" {{ request('status') == 'blocked' ? 'selected' : '' }}>Diblokir</option>
                </select>

                <button type="submit"
                    class="bg-neutral-700 hover:bg-neutral-600 text-white px-4 py-2.5 rounded-lg text-sm font-medium transition">
                    Filter
                </button>

                <a href="{{ route('admin.pengelola.index') }}"
                    class="bg-neutral-700 hover:bg-neutral-600 text-white px-4 py-2.5 rounded-lg text-sm font-medium transition">
                    Reset
                </a>
            </form>
        </div>

        <div class="bg-neutral-800 rounded-xl overflow-hidden border border-neutral-700/50">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr
                            class="bg-neutral-800/50 border-b border-neutral-700 text-xs uppercase tracking-wider text-neutral-400">
                            <th class="px-6 py-4 font-medium">User</th>
                            <th class="px-6 py-4 font-medium">Nama Wisata</th>
                            <th class="px-6 py-4 font-medium">Lokasi</th>
                            <th class="px-6 py-4 font-medium">Status</th>
                            <th class="px-6 py-4 font-medium">Tanggal Daftar</th>
                            <th class="px-6 py-4 font-medium text-right">Tindakan</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-neutral-700/50">
                        @forelse($pengelolas as $pengelola)
                            <tr class="hover:bg-neutral-700/30 transition duration-150">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center gap-3">
                                        <div
                                            class="w-10 h-10 rounded-full flex items-center justify-center text-sm font-bold text-white shadow-sm
                                            {{-- Random background color logic based on ID --}}
                                            {{ ['bg-blue-600', 'bg-indigo-600', 'bg-purple-600', 'bg-emerald-600', 'bg-rose-600'][$pengelola->user->id % 5] }}">
                                            {{ substr($pengelola->user->name, 0, 1) }}
                                        </div>
                                        <div>
                                            <div class="text-sm font-medium text-white">{{ $pengelola->user->name }}</div>
                                            <div class="text-xs text-neutral-400">{{ $pengelola->user->email }}</div>
                                        </div>
                                    </div>
                                </td>

                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-white font-medium">{{ $pengelola->nama_wisata }}</div>
                                </td>

                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-neutral-300">{{ $pengelola->kecamatan->nama }}</div>
                                    @if ($pengelola->desa)
                                        <div class="text-xs text-neutral-500">{{ $pengelola->desa->nama }}</div>
                                    @endif
                                </td>

                                <td class="px-6 py-4 whitespace-nowrap">
                                    {{-- Pastikan accessor status_badge di model menghasilkan class Tailwind --}}
                                    {{-- Jika accessornya output badge biasa, kita bisa styling manual di sini --}}
                                    @if ($pengelola->status == 'approved')
                                        <span
                                            class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-medium bg-green-500/10 text-green-500 border border-green-500/20">
                                            <span class="w-1.5 h-1.5 rounded-full bg-green-500"></span> Disetujui
                                        </span>
                                    @elseif($pengelola->status == 'pending')
                                        <span
                                            class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-medium bg-yellow-500/10 text-yellow-500 border border-yellow-500/20">
                                            <span class="w-1.5 h-1.5 rounded-full bg-yellow-500"></span> Pending
                                        </span>
                                    @elseif($pengelola->status == 'rejected')
                                        <span
                                            class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-medium bg-red-500/10 text-red-500 border border-red-500/20">
                                            <span class="w-1.5 h-1.5 rounded-full bg-red-500"></span> Ditolak
                                        </span>
                                    @else
                                        <span
                                            class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-medium bg-neutral-500/10 text-neutral-400 border border-neutral-500/20">
                                            {{ ucfirst($pengelola->status) }}
                                        </span>
                                    @endif
                                </td>

                                <td class="px-6 py-4 whitespace-nowrap text-sm text-neutral-400">
                                    {{ $pengelola->created_at->format('M d, Y') }}
                                </td>

                                <td class="px-6 py-4 whitespace-nowrap text-right">
                                    <div class="flex items-center justify-end gap-2">
                                        <a href="{{ route('admin.pengelola.show', $pengelola) }}"
                                            class="p-2 text-blue-400 hover:text-blue-300 hover:bg-blue-400/10 rounded-lg transition"
                                            title="Lihat Detail">
                                            <i data-lucide="eye" class="w-4 h-4"></i>
                                        </a>

                                        {{-- <a href="#" class="p-2 text-amber-400 hover:text-amber-300 hover:bg-amber-400/10 rounded-lg transition" title="Edit">
                                            <i data-lucide="edit-2" class="w-4 h-4"></i>
                                        </a> --}}

                                        {{-- <form action="#" method="POST" class="inline-block" onsubmit="return confirm('Hapus pengelola ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="p-2 text-red-400 hover:text-red-300 hover:bg-red-400/10 rounded-lg transition" title="Hapus">
                                                <i data-lucide="trash-2" class="w-4 h-4"></i>
                                            </button>
                                        </form> --}}
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-12 text-center">
                                    <div class="flex flex-col items-center justify-center text-neutral-500">
                                        <i data-lucide="inbox" class="w-12 h-12 mb-3 opacity-50"></i>
                                        <p class="text-base font-medium">Tidak ada data pengelola ditemukan</p>
                                        <p class="text-sm mt-1">Coba ubah filter atau kata kunci pencarian</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if ($pengelolas->hasPages())
                <div class="px-6 py-4 border-t border-neutral-700">
                    {{-- Pastikan menggunakan pagination view yang support dark mode atau custom --}}
                    {{ $pengelolas->withQueryString()->links() }}
                </div>
            @endif
        </div>
    </div>

    {{-- Script untuk icon Lucide --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            if (typeof lucide !== 'undefined') {
                lucide.createIcons();
            }
        });
    </script>
@endsection
