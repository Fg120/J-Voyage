@extends('layouts.admin.app')

@section('content')
    <div class="bg-white dark:bg-neutral-800 rounded-xl shadow-sm p-6">
        <div class="mb-6">
            <h2 class="text-2xl font-bold text-gray-800 dark:text-white">Edit Profile Usaha</h2>
            <p class="text-sm text-gray-600 dark:text-gray-400">Perbarui informasi usaha wisata Anda.</p>
        </div>

        <form action="{{ route('pengelola.profile.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Nama Wisata -->
                <div class="col-span-2">
                    <label for="nama_wisata" class="block text-sm font-medium mb-2 dark:text-white">Nama Wisata</label>
                    <input type="text" id="nama_wisata" name="nama_wisata" 
                           class="py-3 px-4 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600" 
                           value="{{ old('nama_wisata', $pengelola->nama_wisata) }}" required>
                    @error('nama_wisata')
                        <p class="text-sm text-red-600 mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Kecamatan -->
                <div>
                    <label for="kecamatan_id" class="block text-sm font-medium mb-2 dark:text-white">Kecamatan</label>
                    <select id="kecamatan_id" name="kecamatan_id" 
                            class="py-3 px-4 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600" required>
                        <option value="">Pilih Kecamatan</option>
                        @foreach($kecamatans as $kecamatan)
                            <option value="{{ $kecamatan->id }}" {{ old('kecamatan_id', $pengelola->kecamatan_id) == $kecamatan->id ? 'selected' : '' }}>
                                {{ $kecamatan->nama }}
                            </option>
                        @endforeach
                    </select>
                    @error('kecamatan_id')
                        <p class="text-sm text-red-600 mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Desa -->
                <div>
                    <label for="desa_id" class="block text-sm font-medium mb-2 dark:text-white">Desa</label>
                    <select id="desa_id" name="desa_id" 
                            class="py-3 px-4 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600">
                        <option value="">Pilih Desa</option>
                        @foreach($desas as $desa)
                            <option value="{{ $desa->id }}" {{ old('desa_id', $pengelola->desa_id) == $desa->id ? 'selected' : '' }}>
                                {{ $desa->nama }}
                            </option>
                        @endforeach
                    </select>
                    @error('desa_id')
                        <p class="text-sm text-red-600 mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Alamat Detail -->
                <div class="col-span-2">
                    <label for="alamat_wisata" class="block text-sm font-medium mb-2 dark:text-white">Alamat Lengkap</label>
                    <textarea id="alamat_wisata" name="alamat_wisata" rows="3" 
                              class="py-3 px-4 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600" required>{{ old('alamat_wisata', $pengelola->alamat_wisata) }}</textarea>
                    @error('alamat_wisata')
                        <p class="text-sm text-red-600 mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Deskripsi -->
                <div class="col-span-2">
                    <label for="deskripsi_wisata" class="block text-sm font-medium mb-2 dark:text-white">Deskripsi Wisata</label>
                    <textarea id="deskripsi_wisata" name="deskripsi_wisata" rows="5" 
                              class="py-3 px-4 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600" required>{{ old('deskripsi_wisata', $pengelola->deskripsi_wisata) }}</textarea>
                    @error('deskripsi_wisata')
                        <p class="text-sm text-red-600 mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Kontak -->
                <div>
                    <label for="kontak_wisata" class="block text-sm font-medium mb-2 dark:text-white">Kontak (HP/WA)</label>
                    <input type="text" id="kontak_wisata" name="kontak_wisata" 
                           class="py-3 px-4 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600" 
                           value="{{ old('kontak_wisata', $pengelola->kontak_wisata) }}">
                    @error('kontak_wisata')
                        <p class="text-sm text-red-600 mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Jam Operasional -->
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label for="jam_buka" class="block text-sm font-medium mb-2 dark:text-white">Jam Buka</label>
                        <input type="time" id="jam_buka" name="jam_buka" 
                               class="py-3 px-4 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600" 
                               value="{{ old('jam_buka', $pengelola->jam_buka) }}">
                    </div>
                    <div>
                        <label for="jam_tutup" class="block text-sm font-medium mb-2 dark:text-white">Jam Tutup</label>
                        <input type="time" id="jam_tutup" name="jam_tutup" 
                               class="py-3 px-4 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600" 
                               value="{{ old('jam_tutup', $pengelola->jam_tutup) }}">
                    </div>
                </div>

                <!-- Harga Tiket -->
                <div class="col-span-2">
                    <label for="harga" class="block text-sm font-medium mb-2 dark:text-white">Harga Tiket Masuk (Rp)</label>
                    <input type="number" id="harga" name="harga" min="0"
                           class="py-3 px-4 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600" 
                           value="{{ old('harga', $pengelola->harga) }}" required>
                    @error('harga')
                        <p class="text-sm text-red-600 mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Foto Wisata -->
                <div class="col-span-2">
                    <label for="foto_wisata" class="block text-sm font-medium mb-2 dark:text-white">Foto Wisata</label>
                    @if($pengelola->foto_wisata)
                        <div class="mb-4">
                            <img src="{{ Storage::url($pengelola->foto_wisata) }}" alt="Current Photo" class="h-32 w-auto rounded-lg object-cover">
                        </div>
                    @endif
                    <input type="file" id="foto_wisata" name="foto_wisata" accept="image/*"
                           class="block w-full border border-gray-200 shadow-sm rounded-lg text-sm focus:z-10 focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400
                           file:bg-gray-50 file:border-0
                           file:me-4
                           file:py-3 file:px-4
                           dark:file:bg-neutral-700 dark:file:text-neutral-400">
                    <p class="text-xs text-gray-500 mt-2">Format: JPG, PNG. Max: 2MB.</p>
                    @error('foto_wisata')
                        <p class="text-sm text-red-600 mt-2">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="mt-6">
                <!-- Informasi Pembayaran -->
                <div class="col-span-2 border-t border-gray-200 dark:border-neutral-700 pt-6 mt-2">
                    <h3 class="text-lg font-semibold text-gray-800 dark:text-white mb-4">Informasi Pembayaran (Rekening)</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label for="nama_bank" class="block text-sm font-medium mb-2 dark:text-white">Nama Bank</label>
                            <input type="text" id="nama_bank" name="nama_bank" placeholder="Contoh: BRI"
                                   class="py-3 px-4 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600" 
                                   value="{{ old('nama_bank', $pengelola->nama_bank) }}">
                            @error('nama_bank')
                                <p class="text-sm text-red-600 mt-2">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label for="nomor_rekening" class="block text-sm font-medium mb-2 dark:text-white">Nomor Rekening</label>
                            <input type="text" id="nomor_rekening" name="nomor_rekening" 
                                   class="py-3 px-4 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600" 
                                   value="{{ old('nomor_rekening', $pengelola->nomor_rekening) }}">
                            @error('nomor_rekening')
                                <p class="text-sm text-red-600 mt-2">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label for="nama_pemilik_rekening" class="block text-sm font-medium mb-2 dark:text-white">Atas Nama</label>
                            <input type="text" id="nama_pemilik_rekening" name="nama_pemilik_rekening" 
                                   class="py-3 px-4 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600" 
                                   value="{{ old('nama_pemilik_rekening', $pengelola->nama_pemilik_rekening) }}">
                            @error('nama_pemilik_rekening')
                                <p class="text-sm text-red-600 mt-2">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
            

            <div class="mt-6 flex justify-end gap-x-2">
                <a href="{{ route('pengelola.profile.index') }}" 
                   class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-white dark:hover:bg-neutral-800">
                    Batal
                </a>
                <button type="submit" 
                        class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none">
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>

    @push('script')
    <script>
        document.getElementById('kecamatan_id').addEventListener('change', function() {
            var kecamatanId = this.value;
            var desaSelect = document.getElementById('desa_id');
            
            desaSelect.innerHTML = '<option value="">Loading...</option>';
            
            if(kecamatanId) {
                fetch('/api/desa/' + kecamatanId)
                    .then(response => response.json())
                    .then(data => {
                        desaSelect.innerHTML = '<option value="">Pilih Desa</option>';
                        data.forEach(desa => {
                            var option = document.createElement('option');
                            option.value = desa.id;
                            option.textContent = desa.nama;
                            desaSelect.appendChild(option);
                        });
                    });
            } else {
                desaSelect.innerHTML = '<option value="">Pilih Desa</option>';
            }
        });
    </script>
    @endpush
@endsection
