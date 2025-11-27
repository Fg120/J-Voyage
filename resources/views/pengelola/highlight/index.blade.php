@extends('layouts.admin.app')

@section('content')
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Form Section -->
        <div class="lg:col-span-1">
            <div class="bg-white dark:bg-neutral-800 rounded-xl shadow-sm p-6">
                <h2 class="text-lg font-bold text-gray-800 dark:text-white mb-4">Tambah Highlight</h2>
                <form action="{{ route('pengelola.highlight.store') }}" method="POST">
                    @csrf
                    <div class="mb-4">
                        <label for="nama" class="block text-sm font-medium mb-2 dark:text-white">Nama Highlight</label>
                        <input type="text" id="nama" name="nama" placeholder="Contoh: Spot Foto Instagramable"
                               class="py-3 px-4 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600" 
                               required>
                    </div>
                    <button type="submit" 
                            class="w-full py-3 px-4 inline-flex justify-center items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none">
                        Tambah
                    </button>
                </form>
            </div>
        </div>

        <!-- List Section -->
        <div class="lg:col-span-2">
            <div class="bg-white dark:bg-neutral-800 rounded-xl shadow-sm p-6">
                <h2 class="text-lg font-bold text-gray-800 dark:text-white mb-4">Daftar Highlight</h2>
                
                @if (session('success'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4" role="alert">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="flex flex-col">
                    <div class="-m-1.5 overflow-x-auto">
                        <div class="p-1.5 min-w-full inline-block align-middle">
                            <div class="overflow-hidden">
                                <table class="min-w-full divide-y divide-gray-200 dark:divide-neutral-700">
                                    <thead>
                                        <tr>
                                            <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">Nama</th>
                                            <th scope="col" class="px-6 py-3 text-end text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-gray-200 dark:divide-neutral-700">
                                        @forelse ($highlights as $highlight)
                                            <tr>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800 dark:text-neutral-200">
                                                    {{ $highlight->nama }}
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-end text-sm font-medium">
                                                    <div class="flex justify-end gap-2">
                                                        <!-- Edit Button (Modal Trigger) -->
                                                        <button type="button" 
                                                                data-hs-overlay="#hs-edit-highlight-{{ $highlight->id }}"
                                                                class="inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent text-blue-600 hover:text-blue-800 disabled:opacity-50 disabled:pointer-events-none dark:text-blue-500 dark:hover:text-blue-400">
                                                            Edit
                                                        </button>
                                                        
                                                        <!-- Delete Form -->
                                                        <form action="{{ route('pengelola.highlight.destroy', $highlight->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus highlight ini?');">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent text-red-600 hover:text-red-800 disabled:opacity-50 disabled:pointer-events-none dark:text-red-500 dark:hover:text-red-400">
                                                                Hapus
                                                            </button>
                                                        </form>
                                                    </div>

                                                    <!-- Edit Modal -->
                                                    <div id="hs-edit-highlight-{{ $highlight->id }}" class="hs-overlay hidden size-full fixed top-0 start-0 z-[80] overflow-x-hidden overflow-y-auto pointer-events-none">
                                                        <div class="hs-overlay-open:mt-7 hs-overlay-open:opacity-100 hs-overlay-open:duration-500 mt-0 opacity-0 ease-out transition-all sm:max-w-lg sm:w-full m-3 sm:mx-auto">
                                                            <div class="flex flex-col bg-white border shadow-sm rounded-xl pointer-events-auto dark:bg-neutral-800 dark:border-neutral-700 dark:shadow-neutral-700/70">
                                                                <div class="flex justify-between items-center py-3 px-4 border-b dark:border-neutral-700">
                                                                    <h3 class="font-bold text-gray-800 dark:text-white">
                                                                        Edit Highlight
                                                                    </h3>
                                                                    <button type="button" class="flex justify-center items-center size-7 text-sm font-semibold rounded-full border border-transparent text-gray-800 hover:bg-gray-100 disabled:opacity-50 disabled:pointer-events-none dark:text-white dark:hover:bg-neutral-700" data-hs-overlay="#hs-edit-highlight-{{ $highlight->id }}">
                                                                        <span class="sr-only">Close</span>
                                                                        <svg class="flex-shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                                            <path d="M18 6 6 18"></path>
                                                                            <path d="m6 6 12 12"></path>
                                                                        </svg>
                                                                    </button>
                                                                </div>
                                                                <div class="p-4 overflow-y-auto">
                                                                    <form action="{{ route('pengelola.highlight.update', $highlight->id) }}" method="POST">
                                                                        @csrf
                                                                        @method('PUT')
                                                                        <label for="nama-{{ $highlight->id }}" class="block text-sm font-medium mb-2 dark:text-white text-left">Nama Highlight</label>
                                                                        <input type="text" id="nama-{{ $highlight->id }}" name="nama" value="{{ $highlight->nama }}"
                                                                               class="py-3 px-4 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600" 
                                                                               required>
                                                                        <div class="mt-4 flex justify-end gap-x-2">
                                                                            <button type="button" class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-white dark:hover:bg-neutral-800" data-hs-overlay="#hs-edit-highlight-{{ $highlight->id }}">
                                                                                Batal
                                                                            </button>
                                                                            <button type="submit" class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none">
                                                                                Simpan
                                                                            </button>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="2" class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-center dark:text-neutral-400">
                                                    Belum ada highlight.
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
