@extends('layouts.admin.app')

@section('content')
    <div class="px-6 py-8">
        <div class="mb-6">
            <a href="{{ route('admin.pengelola.index') }}" class="text-indigo-600 hover:text-indigo-800 font-medium">
                ← Kembali ke Daftar
            </a>
        </div>

        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <div class="bg-white rounded-lg shadow-sm p-6">
            <div class="flex justify-between items-start mb-6">
                <div>
                    <h1 class="text-2xl font-bold text-gray-900">{{ $pengelola->nama_wisata }}</h1>
                    <p class="text-gray-600">Detail Pengajuan Pengelola</p>
                </div>
                <div>{!! $pengelola->status_badge !!}</div>
            </div>

            <!-- Informasi User -->
            <div class="mb-6 pb-6 border-b">
                <h2 class="text-lg font-semibold mb-4">Informasi Pemohon</h2>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="text-sm font-semibold text-gray-700">Nama:</label>
                        <p class="text-gray-900">{{ $pengelola->user->name }}</p>
                    </div>
                    <div>
                        <label class="text-sm font-semibold text-gray-700">Email:</label>
                        <p class="text-gray-900">{{ $pengelola->user->email }}</p>
                    </div>
                    <div>
                        <label class="text-sm font-semibold text-gray-700">Telepon:</label>
                        <p class="text-gray-900">{{ $pengelola->user->telepon ?? '-' }}</p>
                    </div>
                </div>
            </div>

            <!-- Informasi Wisata -->
            <div class="mb-6 pb-6 border-b">
                <h2 class="text-lg font-semibold mb-4">Informasi Wisata</h2>
                <div class="space-y-4">
                    <div>
                        <label class="text-sm font-semibold text-gray-700">Nama Wisata:</label>
                        <p class="text-gray-900">{{ $pengelola->nama_wisata }}</p>
                    </div>
                    <div>
                        <label class="text-sm font-semibold text-gray-700">Lokasi:</label>
                        <p class="text-gray-900">{{ $pengelola->alamat_wisata }}</p>
                        <p class="text-sm text-gray-600">
                            {{ $pengelola->desa?->nama }}, {{ $pengelola->kecamatan->nama }}
                        </p>
                    </div>
                    <div>
                        <label class="text-sm font-semibold text-gray-700">Deskripsi:</label>
                        <p class="text-gray-900">{{ $pengelola->deskripsi_wisata }}</p>
                    </div>
                    <div class="grid grid-cols-3 gap-4">
                        <div>
                            <label class="text-sm font-semibold text-gray-700">Kontak:</label>
                            <p class="text-gray-900">{{ $pengelola->kontak_wisata ?? '-' }}</p>
                        </div>
                        <div>
                            <label class="text-sm font-semibold text-gray-700">Jam Buka:</label>
                            <p class="text-gray-900">{{ $pengelola->jam_buka ?? '-' }}</p>
                        </div>
                        <div>
                            <label class="text-sm font-semibold text-gray-700">Jam Tutup:</label>
                            <p class="text-gray-900">{{ $pengelola->jam_tutup ?? '-' }}</p>
                        </div>
                    </div>
                    @if ($pengelola->foto_wisata)
                        <div>
                            <label class="text-sm font-semibold text-gray-700">Foto Wisata:</label>
                            <img src="{{ Storage::url($pengelola->foto_wisata) }}" alt="Foto Wisata" class="mt-2 max-w-md rounded-lg shadow">
                        </div>
                    @endif
                </div>
            </div>

            <!-- Dokumen -->
            <div class="mb-6 pb-6 border-b">
                <h2 class="text-lg font-semibold mb-4">Dokumen Persyaratan</h2>
                <div class="space-y-3">
                    @if ($pengelola->file_izin)
                        <div class="flex items-center gap-2">
                            <svg class="w-5 h-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4z"></path>
                            </svg>
                            <a href="{{ Storage::url($pengelola->file_izin) }}" target="_blank" class="text-indigo-600 hover:text-indigo-800">
                                File Izin Usaha
                            </a>
                        </div>
                    @endif
                    @if ($pengelola->file_ktp)
                        <div class="flex items-center gap-2">
                            <svg class="w-5 h-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4z"></path>
                            </svg>
                            <a href="{{ Storage::url($pengelola->file_ktp) }}" target="_blank" class="text-indigo-600 hover:text-indigo-800">
                                File KTP
                            </a>
                        </div>
                    @endif
                    @if ($pengelola->file_npwp)
                        <div class="flex items-center gap-2">
                            <svg class="w-5 h-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4z"></path>
                            </svg>
                            <a href="{{ Storage::url($pengelola->file_npwp) }}" target="_blank" class="text-indigo-600 hover:text-indigo-800">
                                File NPWP
                            </a>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Alasan Pengajuan -->
            <div class="mb-6 pb-6 border-b">
                <h2 class="text-lg font-semibold mb-4">Alasan Pengajuan</h2>
                <p class="text-gray-900">{{ $pengelola->alasan_pengajuan }}</p>
            </div>

            <!-- Catatan Admin -->
            @if ($pengelola->catatan_admin)
                <div class="mb-6 pb-6 border-b">
                    <h2 class="text-lg font-semibold mb-4">Catatan Admin</h2>
                    <div class="bg-yellow-50 border border-yellow-200 rounded p-4">
                        <p class="text-gray-900">{{ $pengelola->catatan_admin }}</p>
                    </div>
                </div>
            @endif

            <!-- Timeline -->
            <div class="mb-6 pb-6 border-b">
                <h2 class="text-lg font-semibold mb-4">Timeline</h2>
                <div class="space-y-2 text-sm text-gray-600">
                    <p>Diajukan: {{ $pengelola->created_at->format('d M Y H:i') }}</p>
                    @if ($pengelola->verified_at)
                        <p>Diverifikasi: {{ $pengelola->verified_at->format('d M Y H:i') }}</p>
                    @endif
                    <p>Terakhir diupdate: {{ $pengelola->updated_at->format('d M Y H:i') }}</p>
                </div>
            </div>

            <!-- Actions -->
            <div class="flex gap-4">
                @if ($pengelola->status === 'pending')
                    <form action="{{ route('admin.pengelola.approve', $pengelola) }}" method="POST">
                        @csrf
                        <button type="submit" class="px-6 py-2.5 bg-green-500 hover:bg-green-600 text-white font-semibold rounded-lg transition" onclick="return confirm('Setujui pengajuan ini?')">
                            ✓ Setujui
                        </button>
                    </form>

                    <button type="button" onclick="document.getElementById('rejectModal').classList.remove('hidden')"
                        class="px-6 py-2.5 bg-red-500 hover:bg-red-600 text-white font-semibold rounded-lg transition">
                        ✗ Tolak
                    </button>
                @endif

                @if ($pengelola->status === 'approved')
                    <button type="button" onclick="document.getElementById('blockModal').classList.remove('hidden')"
                        class="px-6 py-2.5 bg-gray-500 hover:bg-gray-600 text-white font-semibold rounded-lg transition">
                        Blokir Pengelola
                    </button>
                @endif

                @if ($pengelola->status === 'blocked')
                    <form action="{{ route('admin.pengelola.unblock', $pengelola) }}" method="POST">
                        @csrf
                        <button type="submit" class="px-6 py-2.5 bg-green-500 hover:bg-green-600 text-white font-semibold rounded-lg transition" onclick="return confirm('Buka blokir pengelola ini?')">
                            Buka Blokir
                        </button>
                    </form>
                @endif
            </div>
        </div>
    </div>

    <!-- Reject Modal -->
    <div id="rejectModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
        <div class="bg-white rounded-lg p-6 max-w-md w-full mx-4">
            <h3 class="text-lg font-semibold mb-4">Tolak Pengajuan</h3>
            <form action="{{ route('admin.pengelola.reject', $pengelola) }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label for="catatan_admin" class="block text-sm font-semibold text-gray-700 mb-1">Alasan Penolakan <span class="text-red-500">*</span></label>
                    <textarea id="catatan_admin" name="catatan_admin" rows="4" required class="w-full border-gray-300 rounded-lg py-2.5 px-3 focus:border-indigo-500 focus:ring focus:ring-indigo-200"
                        placeholder="Jelaskan alasan penolakan..."></textarea>
                </div>
                <div class="flex gap-4">
                    <button type="submit" class="flex-1 px-4 py-2 bg-red-500 hover:bg-red-600 text-white font-semibold rounded-lg transition">
                        Tolak
                    </button>
                    <button type="button" onclick="document.getElementById('rejectModal').classList.add('hidden')"
                        class="flex-1 px-4 py-2 bg-gray-300 hover:bg-gray-400 text-gray-700 font-semibold rounded-lg transition">
                        Batal
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Block Modal -->
    <div id="blockModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
        <div class="bg-white rounded-lg p-6 max-w-md w-full mx-4">
            <h3 class="text-lg font-semibold mb-4">Blokir Pengelola</h3>
            <form action="{{ route('admin.pengelola.block', $pengelola) }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label for="catatan_admin_block" class="block text-sm font-semibold text-gray-700 mb-1">Alasan Blokir <span class="text-red-500">*</span></label>
                    <textarea id="catatan_admin_block" name="catatan_admin" rows="4" required class="w-full border-gray-300 rounded-lg py-2.5 px-3 focus:border-indigo-500 focus:ring focus:ring-indigo-200"
                        placeholder="Jelaskan alasan memblokir..."></textarea>
                </div>
                <div class="flex gap-4">
                    <button type="submit" class="flex-1 px-4 py-2 bg-red-500 hover:bg-red-600 text-white font-semibold rounded-lg transition">
                        Blokir
                    </button>
                    <button type="button" onclick="document.getElementById('blockModal').classList.add('hidden')"
                        class="flex-1 px-4 py-2 bg-gray-300 hover:bg-gray-400 text-gray-700 font-semibold rounded-lg transition">
                        Batal
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
