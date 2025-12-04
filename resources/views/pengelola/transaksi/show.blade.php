@extends('layouts.admin.app')

@section('content')
    <div class="container px-6 mx-auto grid">
        <h2 class="my-6 text-2xl font-semibold text-gray-700">
            Detail Transaksi
        </h2>

        <div class="px-4 py-3 mb-8 bg-white rounded-lg shadow-md">
            <!-- Status & Code -->
            <div class="flex justify-between items-center mb-6 border-b pb-4">
                <div>
                    <span class="text-gray-600">Status:</span>
                    @if ($transaksi->status == 'pending')
                        <span
                            class="px-2 py-1 font-semibold leading-tight text-orange-700 bg-orange-100 rounded-full">Pending</span>
                    @elseif($transaksi->status == 'verified' && $transaksi->scanned_at)
                        <div class="flex gap-2">
                            <span class="px-2 py-1 font-semibold leading-tight text-green-700 bg-green-100 rounded-full">
                                Verified
                            </span>
                            <span
                                class="px-2 py-1 font-semibold leading-tight border-amber-300 bg-amber-100 rounded-full text-amber-600">
                                Scanned
                            </span>
                        </div>
                    @elseif($transaksi->status == 'verified')
                        <span
                            class="px-2 py-1 font-semibold leading-tight text-green-700 bg-green-100 rounded-full">Verified</span>
                    @elseif($transaksi->status == 'rejected')
                        <span
                            class="px-2 py-1 font-semibold leading-tight text-red-700 bg-red-100 rounded-full">Rejected</span>
                    @endif
                </div>
                @if ($transaksi->kode)
                    <div class="text-right">
                        <span class="text-gray-600 block text-sm">Kode Tiket:</span>
                        <span class="text-xl font-bold text-purple-600">{{ $transaksi->kode }}</span>
                    </div>
                @endif
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Data Pemesan -->
                <div>
                    <h3 class="text-lg font-semibold text-gray-700 mb-4">Data Pemesan</h3>
                    <div class="space-y-3 text-sm">
                        <div class="flex justify-between">
                            <span class="text-gray-600">Nama:</span>
                            <span class="font-semibold">{{ $transaksi->nama }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Email:</span>
                            <span class="font-semibold">{{ $transaksi->email }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Telepon:</span>
                            <span class="font-semibold">{{ $transaksi->telepon }}</span>
                        </div>
                    </div>
                </div>

                <!-- Detail Kunjungan -->
                <div>
                    <h3 class="text-lg font-semibold text-gray-700 mb-4">Detail Kunjungan</h3>
                    <div class="space-y-3 text-sm">
                        <div class="flex justify-between">
                            <span class="text-gray-600">Tanggal:</span>
                            <span class="font-semibold">{{ $transaksi->tanggal_kunjungan->format('d M Y') }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Jumlah Orang:</span>
                            <span class="font-semibold">{{ $transaksi->jumlah }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Total Harga:</span>
                            <span class="font-semibold">Rp {{ number_format($transaksi->total_harga, 0, ',', '.') }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Metode Pembayaran:</span>
                            <span
                                class="font-semibold uppercase">{{ str_replace('_', ' ', $transaksi->metode_pembayaran) }}</span>
                        </div>
                    </div>
                </div>
            </div>

            @if ($transaksi->catatan)
                <div class="mt-6">
                    <h3 class="text-sm font-semibold text-gray-600 mb-2">Catatan:</h3>
                    <p class="text-gray-700 bg-gray-50 p-3 rounded">{{ $transaksi->catatan }}</p>
                </div>
            @endif

            <!-- Bukti Pembayaran -->
            <div class="mt-8 border-t pt-6">
                <h3 class="text-lg font-semibold text-gray-700 mb-4">Bukti Pembayaran</h3>
                @if ($transaksi->bukti_pembayaran)
                    <div class="border rounded-lg p-2 inline-block">
                        @if (Str::endsWith($transaksi->bukti_pembayaran, '.pdf'))
                            <a href="{{ Storage::url($transaksi->bukti_pembayaran) }}" target="_blank"
                                class="flex items-center gap-2 text-purple-600 hover:underline">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z">
                                    </path>
                                </svg>
                                Lihat Dokumen PDF
                            </a>
                        @else
                            <img src="{{ Storage::url($transaksi->bukti_pembayaran) }}" alt="Bukti Pembayaran"
                                class="max-w-md rounded shadow-sm">
                        @endif
                    </div>
                @else
                    <p class="text-gray-500 italic">Belum ada bukti pembayaran yang diupload.</p>
                @endif
            </div>

            <!-- Actions -->
            @if ($transaksi->status == 'pending')
                <div class="mt-8 flex gap-4 border-t pt-6">
                    <form action="{{ route('pengelola.transaksi.approve', $transaksi->id) }}" method="POST">
                        @csrf
                        <button type="submit"
                            class="px-5 py-3 font-medium leading-5 text-white transition-colors duration-150 bg-green-600 border border-transparent rounded-lg active:bg-green-600 hover:bg-green-700 focus:outline-none focus:shadow-outline-green">
                            Setujui Transaksi
                        </button>
                    </form>

                    <form action="{{ route('pengelola.transaksi.reject', $transaksi->id) }}" method="POST"
                        onsubmit="return confirm('Apakah Anda yakin ingin menolak transaksi ini?');">
                        @csrf
                        <button type="submit"
                            class="px-5 py-3 font-medium leading-5 text-white transition-colors duration-150 bg-red-600 border border-transparent rounded-lg active:bg-red-600 hover:bg-red-700 focus:outline-none focus:shadow-outline-red">
                            Tolak Transaksi
                        </button>
                    </form>
                </div>
            @endif
        </div>
    </div>
@endsection
