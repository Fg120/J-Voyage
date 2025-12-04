@extends('layouts.admin.app')

@section('content')
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        <div class="lg:col-span-1">
            <div class="bg-white dark:bg-neutral-800 rounded-xl shadow-sm p-6 sticky top-6">
                <h2 class="text-lg font-bold text-gray-800 dark:text-white mb-4">Tambah Highlight</h2>

                <form action="{{ route('pengelola.highlight.store') }}" method="POST">
                    @csrf
                    <div class="mb-4">
                        <label for="nama" class="block text-sm font-medium mb-2 text-gray-700 dark:text-gray-200">
                            Nama Highlight
                        </label>
                        <input type="text" id="nama" name="nama" placeholder="Contoh: Spot Foto Instagramable"
                            class="py-3 px-4 block w-full border-gray-200 rounded-lg text-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400"
                            required>
                    </div>
                    <button type="submit"
                        class="w-full py-3 px-4 inline-flex justify-center items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-indigo-600 text-white hover:bg-indigo-700 transition">
                        <i data-lucide="plus" class="w-4 h-4"></i>
                        Tambah
                    </button>
                </form>
            </div>
        </div>

        <div class="lg:col-span-2">
            <div class="bg-white dark:bg-neutral-800 rounded-xl shadow-sm p-6">
                <h2 class="text-lg font-bold text-gray-800 dark:text-white mb-4">Daftar Highlight</h2>

                @if (session('success'))
                    <div
                        class="bg-green-100 border border-green-200 text-green-700 px-4 py-3 rounded-lg mb-4 text-sm flex items-center gap-2">
                        <i data-lucide="check-circle" class="w-4 h-4"></i>
                        {{ session('success') }}
                    </div>
                @endif

                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200 dark:divide-neutral-700">
                        <thead class="bg-gray-50 dark:bg-neutral-700">
                            <tr>
                                <th
                                    class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase dark:text-neutral-400">
                                    Nama</th>
                                <th
                                    class="px-6 py-3 text-end text-xs font-medium text-gray-500 uppercase dark:text-neutral-400">
                                    Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 dark:divide-neutral-700">
                            @forelse ($highlights as $highlight)
                                <tr>
                                    <td
                                        class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800 dark:text-neutral-200">
                                        {{ $highlight->nama }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-end text-sm font-medium">
                                        <div class="flex justify-end gap-3">

                                            <button type="button" onclick="openModal('modal-edit-{{ $highlight->id }}')"
                                                class="text-indigo-600 hover:text-indigo-800 dark:text-indigo-400 dark:hover:text-indigo-300 flex items-center gap-1">
                                                <i data-lucide="edit-2" class="w-4 h-4"></i> Edit
                                            </button>

                                            <form action="{{ route('pengelola.highlight.destroy', $highlight->id) }}"
                                                method="POST" onsubmit="return confirm('Hapus permanen highlight ini?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="text-red-600 hover:text-red-800 dark:text-red-500 dark:hover:text-red-400 flex items-center gap-1">
                                                    <i data-lucide="trash-2" class="w-4 h-4"></i> Hapus
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="2" class="px-6 py-8 text-center text-gray-500 dark:text-neutral-400">
                                        <div class="flex flex-col items-center justify-center">
                                            <i data-lucide="folder-open" class="w-10 h-10 mb-2 text-gray-300"></i>
                                            <p>Belum ada highlight.</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    {{-- BAGIAN 3: MODAL (Manual JavaScript) --}}
    @foreach ($highlights as $highlight)
        <div id="modal-edit-{{ $highlight->id }}"
            class="fixed inset-0 z-[99] hidden overflow-y-auto overflow-x-hidden transition-all bg-black/50 backdrop-blur-sm flex items-center justify-center p-4">

            <div
                class="relative w-full max-w-lg bg-white dark:bg-neutral-800 rounded-xl shadow-2xl border dark:border-neutral-700 transform transition-all">

                <div class="flex justify-between items-center py-3 px-4 border-b dark:border-neutral-700">
                    <h3 class="font-bold text-gray-800 dark:text-white">Edit Highlight</h3>
                    <button type="button" onclick="closeModal('modal-edit-{{ $highlight->id }}')"
                        class="text-gray-500 hover:bg-gray-100 dark:hover:bg-neutral-700 rounded-full p-1 transition">
                        <i data-lucide="x" class="w-5 h-5"></i>
                    </button>
                </div>

                <div class="p-4">
                    <form action="{{ route('pengelola.highlight.update', $highlight->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-4">
                            <label class="block text-sm font-medium mb-2 text-left text-gray-700 dark:text-gray-200">
                                Nama Highlight
                            </label>
                            <input type="text" name="nama" value="{{ $highlight->nama }}"
                                class="py-3 px-4 block w-full border-gray-200 rounded-lg text-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400"
                                required>
                        </div>

                        <div class="flex justify-end gap-2">
                            <button type="button" onclick="closeModal('modal-edit-{{ $highlight->id }}')"
                                class="py-2 px-4 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 hover:bg-gray-50 dark:bg-neutral-900 dark:border-neutral-700 dark:text-white dark:hover:bg-neutral-800 transition">
                                Batal
                            </button>
                            <button type="submit"
                                class="py-2 px-4 text-sm font-semibold rounded-lg bg-indigo-600 text-white hover:bg-indigo-700 transition">
                                Simpan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endforeach

    {{-- SCRIPT SEDERHANA UNTUK MODAL --}}
    <script>
        function openModal(modalId) {
            document.getElementById(modalId).classList.remove('hidden');
        }

        function closeModal(modalId) {
            document.getElementById(modalId).classList.add('hidden');
        }
    </script>
@endsection
