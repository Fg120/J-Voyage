@extends('layouts.public.app')

@section('content')
    <div class="max-w-4xl mx-auto px-4 py-8">
        <div class="bg-white rounded-lg shadow-md p-6">
            <h1 class="text-2xl font-bold mb-6">Edit Pengajuan Pengelola</h1>

            <form action="{{ route('pengelola.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="space-y-6">
                    <!-- Nama Wisata -->
                    <div>
                        <label for="nama_wisata" class="block font-semibold text-sm text-gray-700 mb-1">Nama Wisata <span class="text-red-500">*</span></label>
                        <input type="text" id="nama_wisata" name="nama_wisata" value="{{ old('nama_wisata', $pengelola->nama_wisata) }}" required
                            class="w-full border-gray-300 rounded-lg py-2.5 px-3 focus:border-indigo-500 focus:ring focus:ring-indigo-200 transition">
                        @error('nama_wisata')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Lokasi -->
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label for="kecamatan_id" class="block font-semibold text-sm text-gray-700 mb-1">Kecamatan <span class="text-red-500">*</span></label>
                            <select id="kecamatan_id" name="kecamatan_id" required
                                class="w-full border-gray-300 rounded-lg py-2.5 px-3 focus:border-indigo-500 focus:ring focus:ring-indigo-200 transition">
                                <option value="">Pilih Kecamatan</option>
                                @foreach ($kecamatans as $kecamatan)
                                    <option value="{{ $kecamatan->id }}" {{ old('kecamatan_id', $pengelola->kecamatan_id) == $kecamatan->id ? 'selected' : '' }}>
                                        {{ $kecamatan->nama }}
                                    </option>
                                @endforeach
                            </select>
                            @error('kecamatan_id')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="desa_id" class="block font-semibold text-sm text-gray-700 mb-1">Desa/Kelurahan</label>
                            <select id="desa_id" name="desa_id" class="w-full border-gray-300 rounded-lg py-2.5 px-3 focus:border-indigo-500 focus:ring focus:ring-indigo-200 transition">
                                <option value="">Pilih Desa</option>
                                @foreach($desas as $desa)
                                    <option value="{{ $desa->id }}" {{ old('desa_id', $pengelola->desa_id) == $desa->id ? 'selected' : '' }}>
                                        {{ $desa->nama }}
                                    </option>
                                @endforeach
                            </select>
                            @error('desa_id')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Alamat -->
                    <div>
                        <label for="alamat_wisata" class="block font-semibold text-sm text-gray-700 mb-1">Alamat Lengkap <span class="text-red-500">*</span></label>
                        <input type="text" id="alamat_wisata" name="alamat_wisata" value="{{ old('alamat_wisata', $pengelola->alamat_wisata) }}" required
                            class="w-full border-gray-300 rounded-lg py-2.5 px-3 focus:border-indigo-500 focus:ring focus:ring-indigo-200 transition">
                        @error('alamat_wisata')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Deskripsi -->
                    <div>
                        <label for="deskripsi_wisata" class="block font-semibold text-sm text-gray-700 mb-1">Deskripsi Wisata <span class="text-red-500">*</span></label>
                        <textarea id="deskripsi_wisata" name="deskripsi_wisata" rows="4" required
                            class="w-full border-gray-300 rounded-lg py-2.5 px-3 focus:border-indigo-500 focus:ring focus:ring-indigo-200 transition">{{ old('deskripsi_wisata', $pengelola->deskripsi_wisata) }}</textarea>
                        @error('deskripsi_wisata')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Kontak & Jam -->
                    <div class="grid grid-cols-3 gap-4">
                        <div>
                            <label for="kontak_wisata" class="block font-semibold text-sm text-gray-700 mb-1">Kontak</label>
                            <input type="text" id="kontak_wisata" name="kontak_wisata" value="{{ old('kontak_wisata', $pengelola->kontak_wisata) }}"
                                class="w-full border-gray-300 rounded-lg py-2.5 px-3 focus:border-indigo-500 focus:ring focus:ring-indigo-200 transition">
                            @error('kontak_wisata')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label for="jam_buka" class="block font-semibold text-sm text-gray-700 mb-1">Jam Buka</label>
                            <input type="text" id="jam_buka" name="jam_buka" value="{{ old('jam_buka', $pengelola->jam_buka) }}" placeholder="08:00"
                                class="w-full border-gray-300 rounded-lg py-2.5 px-3 focus:border-indigo-500 focus:ring focus:ring-indigo-200 transition">
                        </div>
                        <div>
                            <label for="jam_tutup" class="block font-semibold text-sm text-gray-700 mb-1">Jam Tutup</label>
                            <input type="text" id="jam_tutup" name="jam_tutup" value="{{ old('jam_tutup', $pengelola->jam_tutup) }}" placeholder="17:00"
                                class="w-full border-gray-300 rounded-lg py-2.5 px-3 focus:border-indigo-500 focus:ring focus:ring-indigo-200 transition">
                        </div>
                    </div>

                    <!-- Upload Files -->
                    <div class="border-t pt-6">
                        <h3 class="font-semibold text-lg mb-4">Dokumen Persyaratan</h3>

                        <div class="space-y-4">
                            <!-- Foto Wisata -->
                            <div>
                                <label for="foto_wisata" class="block font-semibold text-sm text-gray-700 mb-1">Foto Wisata (Opsional)</label>
                                @if($pengelola->foto_wisata)
                                    <p class="text-sm text-gray-600 mb-2">File saat ini: <a href="{{ Storage::url($pengelola->foto_wisata) }}" target="_blank" class="text-indigo-600">Lihat foto</a></p>
                                @endif
                                <input type="file" id="foto_wisata" name="foto_wisata" accept="image/*" class="w-full border-gray-300 rounded-lg">
                                <p class="text-xs text-gray-500 mt-1">Format: JPG, PNG. Maksimal 2MB. Kosongkan jika tidak ingin mengganti.</p>
                                @error('foto_wisata')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- File Izin -->
                            <div>
                                <label for="file_izin" class="block font-semibold text-sm text-gray-700 mb-1">File Izin Usaha</label>
                                @if($pengelola->file_izin)
                                    <p class="text-sm text-gray-600 mb-2">File saat ini: <a href="{{ Storage::url($pengelola->file_izin) }}" target="_blank" class="text-indigo-600">Lihat file</a></p>
                                @endif
                                <input type="file" id="file_izin" name="file_izin" accept=".pdf,image/*" class="w-full border-gray-300 rounded-lg">
                                <p class="text-xs text-gray-500 mt-1">Format: PDF, JPG, PNG. Maksimal 5MB. Kosongkan jika tidak ingin mengganti.</p>
                                @error('file_izin')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- File KTP -->
                            <div>
                                <label for="file_ktp" class="block font-semibold text-sm text-gray-700 mb-1">File KTP</label>
                                @if($pengelola->file_ktp)
                                    <p class="text-sm text-gray-600 mb-2">File saat ini: <a href="{{ Storage::url($pengelola->file_ktp) }}" target="_blank" class="text-indigo-600">Lihat file</a></p>
                                @endif
                                <input type="file" id="file_ktp" name="file_ktp" accept=".pdf,image/*" class="w-full border-gray-300 rounded-lg">
                                <p class="text-xs text-gray-500 mt-1">Format: PDF, JPG, PNG. Maksimal 2MB. Kosongkan jika tidak ingin mengganti.</p>
                                @error('file_ktp')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- File NPWP -->
                            <div>
                                <label for="file_npwp" class="block font-semibold text-sm text-gray-700 mb-1">File NPWP (Opsional)</label>
                                @if($pengelola->file_npwp)
                                    <p class="text-sm text-gray-600 mb-2">File saat ini: <a href="{{ Storage::url($pengelola->file_npwp) }}" target="_blank" class="text-indigo-600">Lihat file</a></p>
                                @endif
                                <input type="file" id="file_npwp" name="file_npwp" accept=".pdf,image/*" class="w-full border-gray-300 rounded-lg">
                                <p class="text-xs text-gray-500 mt-1">Format: PDF, JPG, PNG. Maksimal 2MB. Kosongkan jika tidak ingin mengganti.</p>
                                @error('file_npwp')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Alasan Pengajuan -->
                    <div>
                        <label for="alasan_pengajuan" class="block font-semibold text-sm text-gray-700 mb-1">Alasan Pengajuan <span class="text-red-500">*</span></label>
                        <textarea id="alasan_pengajuan" name="alasan_pengajuan" rows="4" required
                            class="w-full border-gray-300 rounded-lg py-2.5 px-3 focus:border-indigo-500 focus:ring focus:ring-indigo-200 transition"
                            placeholder="Jelaskan mengapa Anda ingin menjadi pengelola wisata ini...">{{ old('alasan_pengajuan', $pengelola->alasan_pengajuan) }}</textarea>
                        @error('alasan_pengajuan')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Buttons -->
                    <div class="flex gap-4 pt-4 border-t">
                        <button type="submit" class="px-6 py-2.5 bg-indigo-500 hover:bg-indigo-600 text-white font-semibold rounded-lg transition shadow-sm">
                            Perbarui Pengajuan
                        </button>
                        <a href="{{ route('pengelola.index') }}" class="px-6 py-2.5 bg-gray-300 hover:bg-gray-400 text-gray-700 font-semibold rounded-lg transition">
                            Batal
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>

    @push('scripts')
        <script>
            document.getElementById('kecamatan_id').addEventListener('change', function() {
                const kecamatanId = this.value;
                const desaSelect = document.getElementById('desa_id');

                desaSelect.innerHTML = '<option value="">Loading...</option>';

                if (kecamatanId) {
                    fetch(`/api/desa/${kecamatanId}`)
                        .then(response => response.json())
                        .then(data => {
                            desaSelect.innerHTML = '<option value="">Pilih Desa</option>';
                            data.forEach(desa => {
                                const option = document.createElement('option');
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
