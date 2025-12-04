@extends('layouts.profile.app')

@section('content')
    <div class="bg-white rounded-2xl shadow-md p-8">
        <h2 class="text-2xl font-bold text-gray-900 mb-6">Status Pengajuan Pengelola</h2>

        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                {{ session('error') }}
            </div>
        @endif

        @if ($pengelola)
            <div class="space-y-4">
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="font-semibold text-gray-700">Nama Wisata:</label>
                        <p class="text-gray-900">{{ $pengelola->nama_wisata }}</p>
                    </div>
                    <div>
                        <label class="font-semibold text-gray-700">Status:</label>
                        <div class="mt-1">{!! $pengelola->status_badge !!}</div>
                    </div>
                </div>

                <div>
                    <label class="font-semibold text-gray-700">Alamat:</label>
                    <p class="text-gray-900">{{ $pengelola->alamat_wisata }}</p>
                    <p class="text-sm text-gray-600">
                        {{ $pengelola->desa?->nama }}, {{ $pengelola->kecamatan->nama }}
                    </p>
                </div>

                <div>
                    <label class="font-semibold text-gray-700">Deskripsi:</label>
                    <p class="text-gray-900">{{ $pengelola->deskripsi_wisata }}</p>
                </div>

                @if ($pengelola->catatan_admin)
                    <div class="bg-yellow-50 border border-yellow-200 rounded p-4">
                        <label class="font-semibold text-gray-700">Catatan Admin:</label>
                        <p class="text-gray-900 mt-1">{{ $pengelola->catatan_admin }}</p>
                    </div>
                @endif

                <div class="pt-4 border-t">
                    <p class="text-sm text-gray-500">
                        Diajukan pada: {{ $pengelola->created_at->format('d M Y H:i') }}
                    </p>
                    @if ($pengelola->verified_at)
                        <p class="text-sm text-gray-500">
                            Diverifikasi pada: {{ $pengelola->verified_at->format('d M Y H:i') }}
                        </p>
                    @endif

                    @if (in_array($pengelola->status, ['pending', 'rejected']))
                        <div class="mt-4">
                            <a href="{{ route('pengelola.edit') }}"
                                class="inline-flex items-center px-4 py-2 bg-indigo-500 hover:bg-indigo-600 text-white font-semibold rounded-lg transition">
                                Edit Pengajuan
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        @else
            <div class="text-center py-8">
                <div class="mb-4">
                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                        </path>
                    </svg>
                </div>
                <h3 class="text-lg font-medium text-gray-900 mb-2">Belum Ada Pengajuan</h3>
                <p class="text-gray-600 mb-6">Anda belum mengajukan sebagai pengelola wisata.</p>
                <a href="{{ route('pengelola.create') }}"
                    class="inline-flex items-center px-4 py-2 bg-indigo-500 hover:bg-indigo-600 text-white font-semibold rounded-lg transition">
                    Ajukan Sekarang
                </a>
            </div>
        @endif
    </div>
@endsection
