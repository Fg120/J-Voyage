@extends('layouts.public.app')

@section('content')
    <div class="bg-[#FAFAFA] min-h-screen pb-20 font-poppins pt-24">
        <div class="container mx-auto px-4 lg:px-24">
            <h1 class="font-extrabold text-4xl lg:text-5xl text-[#171717] mb-8">Pembayaran</h1>

            <div class="flex flex-col lg:flex-row gap-8">
                <!-- Left Column: Payment Methods -->
                <div class="w-full lg:w-[65%]">
                    <div class="bg-white rounded-2xl shadow-lg p-8">
                        <h2 class="font-bold text-2xl text-[#171717] mb-6">Pilih Metode Pembayaran</h2>

                        <form action="{{ route('transaksi.processPayment', $transaksi->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            
                            <!-- Bank Transfer Option -->
                            <div class="mb-6">
                                <label class="mb-3 flex items-center p-4 border-2 border-[#818CF8] bg-[#EEF2FF] rounded-xl cursor-pointer transition">
                                    <input type="radio" name="metode_pembayaran" value="bank_transfer" checked class="w-6 h-6 text-indigo-600 focus:ring-indigo-500">
                                    <div class="ml-4 flex-1">
                                        <div class="flex items-center gap-4 mb-2">
                                            <div class="w-12 h-12 bg-[#818CF8] rounded-full flex items-center justify-center text-white">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 14v3m4-3v3m4-3v3M3 21h18M3 10h18M3 7l9-4 9 4M4 10h16v11H4V10z" />
                                                </svg>
                                            </div>
                                            <span class="font-semibold text-lg text-[#171717]">Transfer Bank</span>
                                        </div>
                                        <div class="flex gap-2">
                                            <span class="bg-gray-100 text-gray-600 px-2 py-1 rounded text-xs">BCA</span>
                                            <span class="bg-gray-100 text-gray-600 px-2 py-1 rounded text-xs">Mandiri</span>
                                            <span class="bg-gray-100 text-gray-600 px-2 py-1 rounded text-xs">BNI</span>
                                            <span class="bg-gray-100 text-gray-600 px-2 py-1 rounded text-xs">BRI</span>
                                        </div>
                                    </div>
                                </label>
                                <label class="mb-3 flex items-center p-4 border-2 border-[#818CF8] bg-[#EEF2FF] rounded-xl cursor-pointer transition">
                                    <input type="radio" name="metode_pembayaran" value="bank_transfer" checked class="w-6 h-6 text-indigo-600 focus:ring-indigo-500">
                                    <div class="ml-4 flex-1">
                                        <div class="flex items-center gap-4 mb-2">
                                            <div class="w-12 h-12 bg-[#818CF8] rounded-full flex items-center justify-center text-white">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 14v3m4-3v3m4-3v3M3 21h18M3 10h18M3 7l9-4 9 4M4 10h16v11H4V10z" />
                                                </svg>
                                            </div>
                                            <span class="font-semibold text-lg text-[#171717]">E-Wallet</span>
                                        </div>
                                        <div class="flex gap-2">
                                            <span class="bg-gray-100 text-gray-600 px-2 py-1 rounded text-xs">Shopeepay</span>
                                            <span class="bg-gray-100 text-gray-600 px-2 py-1 rounded text-xs">Gopay</span>
                                            <span class="bg-gray-100 text-gray-600 px-2 py-1 rounded text-xs">Dana</span>
                                            <span class="bg-gray-100 text-gray-600 px-2 py-1 rounded text-xs">OVO</span>
                                        </div>
                                    </div>
                                </label>
                            </div>

                            <!-- Payment Instructions -->
                            <div class="bg-[#EEF2FF] rounded-xl p-6 mb-8">
                                <h3 class="font-semibold text-base text-[#171717] mb-4">Instruksi Pembayaran</h3>
                                <ol class="list-decimal list-inside space-y-2 text-[#404040]">
                                    <li>Transfer ke rekening berikut: <br>
                                        <strong>{{ $transaksi->pengelola->nama_bank }} - {{ $transaksi->pengelola->nomor_rekening }}</strong><br>
                                        a.n. <strong>{{ $transaksi->pengelola->nama_pemilik_rekening }}</strong>
                                    </li>
                                    <li>Transfer sesuai nominal: <strong>Rp {{ number_format($transaksi->total_harga, 0, ',', '.') }}</strong></li>
                                    <li>Simpan bukti transfer.</li>
                                    <li>Upload bukti transfer pada form di bawah ini.</li>
                                </ol>
                            </div>

                            <!-- File Upload -->
                            <div class="mb-8">
                                <label for="bukti_pembayaran" class="block font-semibold text-base text-[#171717] mb-2">Upload Bukti Pembayaran</label>
                                <input type="file" id="bukti_pembayaran" name="bukti_pembayaran" accept="image/*,application/pdf"
                                       class="w-full border-2 border-[#E5E5E5] rounded-xl px-4 py-3 focus:border-indigo-500 focus:ring-indigo-500 transition file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100"
                                       required>
                                <p class="text-[#737373] text-xs mt-1">Format: JPG, PNG, PDF. Maksimal 2MB.</p>
                                @error('bukti_pembayaran') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                            </div>

                            <button type="submit" class="w-full bg-[#6366F1] hover:bg-indigo-700 text-white font-semibold text-lg py-4 rounded-xl transition shadow-md hover:shadow-lg">
                                Bayar Sekarang
                            </button>
                        </form>
                    </div>
                </div>

                <!-- Right Column: Summary -->
                <div class="w-full lg:w-[35%]">
                    <div class="bg-white rounded-2xl shadow-lg p-6 sticky top-24 border border-gray-100">
                        <h3 class="font-bold text-xl text-[#171717] mb-4">Ringkasan Pemesanan</h3>
                        
                        <div class="flex gap-4 mb-6">
                            @if($transaksi->pengelola->foto_wisata)
                                <img src="{{ Storage::url($transaksi->pengelola->foto_wisata) }}" alt="{{ $transaksi->pengelola->nama_wisata }}" class="w-full h-32 object-cover rounded-xl">
                            @else
                                <div class="w-full h-32 bg-gray-200 rounded-xl"></div>
                            @endif
                        </div>
                        <h4 class="font-semibold text-lg text-[#171717] mb-1">{{ $transaksi->pengelola->nama_wisata }}</h4>
                        <p class="text-sm text-[#525252] mb-4">{{ $transaksi->pengelola->kecamatan->nama }}</p>

                        <div class="border-t border-[#E5E5E5] pt-4 space-y-3">
                            <div class="flex justify-between items-center">
                                <span class="text-[#525252]">Nama Pemesan</span>
                                <span class="font-semibold text-[#171717] text-right">{{ $transaksi->nama }}</span>
                            </div>
                            <div class="flex justify-between items-center">
                                <span class="text-[#525252]">Email</span>
                                <span class="font-semibold text-[#171717] text-xs text-right">{{ $transaksi->email }}</span>
                            </div>
                            <div class="flex justify-between items-center">
                                <span class="text-[#525252]">Telepon</span>
                                <span class="font-semibold text-[#171717] text-right">{{ $transaksi->telepon }}</span>
                            </div>
                            <div class="flex justify-between items-center">
                                <span class="text-[#525252]">Tanggal</span>
                                <span class="font-semibold text-[#171717] text-right">{{ $transaksi->tanggal_kunjungan->format('d M Y') }}</span>
                            </div>
                            <div class="flex justify-between items-center">
                                <span class="text-[#525252]">Jumlah Orang</span>
                                <span class="font-semibold text-[#171717] text-right">{{ $transaksi->jumlah }} orang</span>
                            </div>
                        </div>

                        <div class="border-t border-[#E5E5E5] pt-4 mt-4">
                            <div class="flex justify-between items-center mb-1">
                                <span class="font-bold text-lg text-[#171717]">Total Pembayaran</span>
                                <span class="font-extrabold text-2xl text-[#818CF8]">Rp {{ number_format($transaksi->total_harga, 0, ',', '.') }}</span>
                            </div>
                            <p class="text-[#737373] text-xs">Harga sudah termasuk pajak</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
