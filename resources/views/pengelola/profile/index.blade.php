@extends('layouts.admin.app')

@section('content')
    <div class="bg-white dark:bg-neutral-800 rounded-xl shadow-sm p-6">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-bold text-gray-800 dark:text-white">Profile Usaha</h2>
            <a href="{{ route('pengelola.profile.edit') }}" 
               class="py-2 px-4 inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none">
                <i data-lucide="edit" class="size-4"></i>
                Edit Profile
            </a>
        </div>

        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4" role="alert">
                {{ session('success') }}
            </div>
        @endif

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- Left Column: Image & Basic Info -->
            <div class="md:col-span-1 space-y-6">
                <div class="aspect-video w-full overflow-hidden rounded-xl bg-gray-100 dark:bg-neutral-700 relative group">
                    @if($pengelola->foto_wisata)
                        <img src="{{ Storage::url($pengelola->foto_wisata) }}" alt="{{ $pengelola->nama_wisata }}" class="w-full h-full object-cover">
                    @else
                        <div class="flex items-center justify-center h-full text-gray-400">
                            <i data-lucide="image" class="size-12"></i>
                        </div>
                    @endif
                </div>

                <div class="bg-gray-50 dark:bg-neutral-700/50 p-4 rounded-xl">
                    <h3 class="font-semibold text-gray-800 dark:text-white mb-2">Status Akun</h3>
                    <div class="flex items-center gap-2">
                        {!! $pengelola->status_badge !!}
                        @if($pengelola->verified_at)
                            <span class="text-xs text-gray-500 dark:text-gray-400">
                                (Verified: {{ $pengelola->verified_at->format('d M Y') }})
                            </span>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Right Column: Details -->
            <div class="md:col-span-2 space-y-6">
                <div>
                    <h3 class="text-lg font-semibold text-gray-800 dark:text-white mb-4">Informasi Umum</h3>
                    <dl class="grid grid-cols-1 sm:grid-cols-2 gap-x-4 gap-y-6">
                        <div>
                            <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Nama Wisata</dt>
                            <dd class="mt-1 text-sm text-gray-900 dark:text-gray-200 font-medium">{{ $pengelola->nama_wisata }}</dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Kontak</dt>
                            <dd class="mt-1 text-sm text-gray-900 dark:text-gray-200">{{ $pengelola->kontak_wisata ?? '-' }}</dd>
                        </div>
                        <div class="sm:col-span-2">
                            <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Alamat</dt>
                            <dd class="mt-1 text-sm text-gray-900 dark:text-gray-200">
                                {{ $pengelola->alamat_wisata }}<br>
                                {{ $pengelola->desa?->nama }}, {{ $pengelola->kecamatan->nama }}
                            </dd>
                        </div>
                    </dl>
                </div>

                <div class="border-t border-gray-200 dark:border-neutral-700 pt-6">
                    <h3 class="text-lg font-semibold text-gray-800 dark:text-white mb-4">Jam Operasional & Harga</h3>
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                        <div>
                            <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Jam Buka</dt>
                            <dd class="mt-1 text-sm text-gray-900 dark:text-gray-200">{{ $pengelola->jam_buka ?? '-' }}</dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Jam Tutup</dt>
                            <dd class="mt-1 text-sm text-gray-900 dark:text-gray-200">{{ $pengelola->jam_tutup ?? '-' }}</dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Harga Tiket</dt>
                            <dd class="mt-1 text-sm text-gray-900 dark:text-gray-200">Rp {{ number_format($pengelola->harga, 0, ',', '.') }}</dd>
                        </div>
                    </div>
                </div>

                @if($pengelola->nama_bank || $pengelola->nomor_rekening)
                <div class="border-t border-gray-200 dark:border-neutral-700 pt-6">
                    <h3 class="text-lg font-semibold text-gray-800 dark:text-white mb-4">Informasi Pembayaran</h3>
                    <dl class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                        <div>
                            <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Bank</dt>
                            <dd class="mt-1 text-sm text-gray-900 dark:text-gray-200">{{ $pengelola->nama_bank ?? '-' }}</dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">No. Rekening</dt>
                            <dd class="mt-1 text-sm text-gray-900 dark:text-gray-200">{{ $pengelola->nomor_rekening ?? '-' }}</dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Atas Nama</dt>
                            <dd class="mt-1 text-sm text-gray-900 dark:text-gray-200">{{ $pengelola->nama_pemilik_rekening ?? '-' }}</dd>
                        </div>
                    </dl>
                </div>
                @endif

                <div class="border-t border-gray-200 dark:border-neutral-700 pt-6">
                    <h3 class="text-lg font-semibold text-gray-800 dark:text-white mb-4">Deskripsi</h3>
                    <div class="prose prose-sm dark:prose-invert max-w-none text-gray-600 dark:text-gray-300">
                        {!! nl2br(e($pengelola->deskripsi_wisata)) !!}
                    </div>
                </div>

                <div class="border-t border-gray-200 dark:border-neutral-700 pt-6">
                    <h3 class="text-lg font-semibold text-gray-800 dark:text-white mb-4">Dokumen Legalitas</h3>
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                        @if($pengelola->file_izin)
                            <a href="{{ Storage::url($pengelola->file_izin) }}" target="_blank" class="flex items-center p-3 border border-gray-200 dark:border-neutral-700 rounded-lg hover:bg-gray-50 dark:hover:bg-neutral-700 transition">
                                <i data-lucide="file-text" class="size-5 text-blue-500 mr-2"></i>
                                <span class="text-sm font-medium text-gray-700 dark:text-gray-200">Izin Usaha</span>
                            </a>
                        @endif
                        @if($pengelola->file_ktp)
                            <a href="{{ Storage::url($pengelola->file_ktp) }}" target="_blank" class="flex items-center p-3 border border-gray-200 dark:border-neutral-700 rounded-lg hover:bg-gray-50 dark:hover:bg-neutral-700 transition">
                                <i data-lucide="file-text" class="size-5 text-blue-500 mr-2"></i>
                                <span class="text-sm font-medium text-gray-700 dark:text-gray-200">KTP</span>
                            </a>
                        @endif
                        @if($pengelola->file_npwp)
                            <a href="{{ Storage::url($pengelola->file_npwp) }}" target="_blank" class="flex items-center p-3 border border-gray-200 dark:border-neutral-700 rounded-lg hover:bg-gray-50 dark:hover:bg-neutral-700 transition">
                                <i data-lucide="file-text" class="size-5 text-blue-500 mr-2"></i>
                                <span class="text-sm font-medium text-gray-700 dark:text-gray-200">NPWP</span>
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
