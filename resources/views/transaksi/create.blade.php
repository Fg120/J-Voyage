@extends('layouts.public.sub')

@section('content')
    <div class="bg-[#FAFAFA] min-h-screen pb-20 font-poppins ">
         <div class="bg-neutral-900 border-b border-[#E5E5E5] py-4 px-4 lg:px-24 sticky top-0 z-50 text-white">
                <a href="{{ route('destinasi.show', $destinasi->id) }}" class="flex items-center gap-2 text-[#404040] hover:text-indigo-600 transition">
                    <div class="border-2 border-[#404040] rounded-full p-1">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M19 12H5"/>
                        <path d="m12 19-7-7 7-7"/>
                    </svg>
                </div>
                <span class="font-semibold text-white">Kembali</span>
                </a>
            </div>

        <div class="container mx-auto px-4 lg:px-24 pt-5">
            <h1 class="font-extrabold text-4xl lg:text-5xl text-[#171717] mb-8">Form Pemesanan</h1>
            <div class="flex flex-col lg:flex-row gap-8">
                <!-- Left Column: Form -->
                <div class="w-full lg:w-[65%]">
                    <form action="{{ route('transaksi.store', $destinasi->id) }}" method="POST" class="bg-white rounded-2xl shadow-lg p-8">
                        @csrf

                        <!-- Informasi Pemesan -->
                        <div class="mb-8">
                            <h2 class="font-bold text-2xl text-[#171717] mb-6">Informasi Pemesan</h2>

                            <div class="space-y-6">
                                <div>
                                    <label for="nama" class="block font-semibold text-base text-[#171717] mb-2">Nama Lengkap</label>
                                    <input type="text" id="nama" name="nama" value="{{ old('nama', auth()->user()->name ?? '') }}"
                                           class="w-full border-2 border-[#E5E5E5] rounded-xl px-4 py-3 focus:border-indigo-500 focus:ring-indigo-500 transition"
                                           placeholder="John Doe" required>
                                    @error('nama') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                                </div>

                                <div>
                                    <label for="email" class="block font-semibold text-base text-[#171717] mb-2">Email</label>
                                    <input type="email" id="email" name="email" value="{{ old('email', auth()->user()->email ?? '') }}"
                                           class="w-full border-2 border-[#E5E5E5] rounded-xl px-4 py-3 focus:border-indigo-500 focus:ring-indigo-500 transition"
                                           placeholder="john.doe@email.com" required>
                                    @error('email') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                                </div>

                                <div>
                                    <label for="telepon" class="block font-semibold text-base text-[#171717] mb-2">Nomor Telepon</label>
                                    <input type="tel" id="telepon" name="telepon" value="{{ old('telepon', auth()->user()->telepon ?? '') }}"
                                           class="w-full border-2 border-[#E5E5E5] rounded-xl px-4 py-3 focus:border-indigo-500 focus:ring-indigo-500 transition"
                                           placeholder="+62 812-3456-7890" required>
                                    @error('telepon') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Detail Kunjungan -->
                        <div class="mb-8">
                            <h2 class="font-bold text-2xl text-[#171717] mb-6">Detail Kunjungan</h2>

                            <div class="space-y-6">
                                <div>
                                    <label for="tanggal_kunjungan" class="block font-semibold text-base text-[#171717] mb-2">Tanggal Kunjungan</label>
                                    <input type="date" id="tanggal_kunjungan" name="tanggal_kunjungan" value="{{ old('tanggal_kunjungan') }}"
                                           class="w-full border-2 border-[#E5E5E5] rounded-xl px-4 py-3 focus:border-indigo-500 focus:ring-indigo-500 transition"
                                           required>
                                    @error('tanggal_kunjungan') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                                </div>

                                <div>
                                    <label for="jumlah" class="block font-semibold text-base text-[#171717] mb-2">Jumlah Orang</label>
                                    <input type="number" id="jumlah" name="jumlah" value="{{ old('jumlah', 1) }}" min="1" max="50"
                                           class="w-full border-2 border-[#E5E5E5] rounded-xl px-4 py-3 focus:border-indigo-500 focus:ring-indigo-500 transition"
                                           required onchange="updateTotal()">
                                    <p class="text-[#737373] text-xs mt-1">Maksimal 50 orang</p>
                                    @error('jumlah') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                                </div>

                                <div>
                                    <label for="catatan" class="block font-semibold text-base text-[#171717] mb-2">Catatan (Opsional)</label>
                                    <textarea id="catatan" name="catatan" rows="4"
                                              class="w-full border-2 border-[#E5E5E5] rounded-xl px-4 py-3 focus:border-indigo-500 focus:ring-indigo-500 transition"
                                              placeholder="Tambahkan catatan khusus untuk pemesanan Anda...">{{ old('catatan') }}</textarea>
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="w-full bg-[#6366F1] hover:bg-indigo-700 text-white font-semibold text-lg py-4 rounded-xl transition shadow-md hover:shadow-lg">
                            Lanjutkan ke Pembayaran
                        </button>
                    </form>
                </div>

                <!-- Right Column: Summary -->
                <div class="w-full lg:w-[35%]">
                    <div class="bg-white rounded-2xl shadow-lg p-6  border border-gray-100">
                        <h3 class="font-bold text-xl text-[#171717] mb-4">Ringkasan Pesanan</h3>

                        <div class="flex gap-4 mb-6">
                            @if($destinasi->foto_wisata)
                                <img src="{{ Storage::url($destinasi->foto_wisata) }}" alt="{{ $destinasi->nama_wisata }}" class="w-24 h-24 object-cover rounded-xl">
                            @else
                                <div class="w-24 h-24 bg-gray-200 rounded-xl"></div>
                            @endif
                            <div>
                                <h4 class="font-semibold text-base text-[#171717]">{{ $destinasi->nama_wisata }}</h4>
                                <p class="text-sm text-[#525252]">{{ $destinasi->kecamatan->nama }}</p>
                            </div>
                        </div>

                        <div class="border-t border-[#E5E5E5] pt-4 space-y-3">
                            <div class="flex justify-between items-center">
                                <span class="text-[#525252]">Harga per orang</span>
                                <span class="font-semibold text-[#171717]">Rp {{ number_format($destinasi->harga, 0, ',', '.') }}</span>
                            </div>
                            <div class="flex justify-between items-center">
                                <span class="text-[#525252]">Jumlah orang</span>
                                <span class="font-semibold text-[#171717]" id="summary-jumlah">1 orang</span>
                            </div>
                        </div>

                        <div class="border-t border-[#E5E5E5] pt-4 mt-4">
                            <div class="flex justify-between items-center mb-1">
                                <span class="font-bold text-lg text-[#171717]">Total</span>
                                <span class="font-extrabold text-2xl text-[#818CF8]" id="summary-total">Rp {{ number_format($destinasi->harga, 0, ',', '.') }}</span>
                            </div>
                            <p class="text-[#737373] text-xs">Harga sudah termasuk pajak</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        const hargaSatuan = {{ $destinasi->harga }};
        const jumlahInput = document.getElementById('jumlah');
        const summaryJumlah = document.getElementById('summary-jumlah');
        const summaryTotal = document.getElementById('summary-total');

        function updateTotal() {
            const jumlah = parseInt(jumlahInput.value) || 0;
            const total = jumlah * hargaSatuan;

            summaryJumlah.textContent = jumlah + ' orang';
            summaryTotal.textContent = 'Rp ' + new Intl.NumberFormat('id-ID').format(total);
        }

        jumlahInput.addEventListener('input', updateTotal);
    </script>
@endsection
