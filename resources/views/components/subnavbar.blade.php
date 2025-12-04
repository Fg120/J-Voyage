<div
    class="bg-neutral-800 backdrop-blur-md border-b border-neutral-800 py-4 px-4 lg:px-24 sticky top-0 z-50 transition-all duration-300">
    <a href="{{ $backUrl ?? route('onboarding') }}"
        class="inline-flex items-center gap-3 text-gray-600 hover:text-indigo-600 transition group">
        <div class="p-2 rounded-full bg-white group-hover:bg-indigo-50 transition">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M19 12H5" />
                <path d="m12 19-7-7 7-7" />
            </svg>
        </div>
        <span class="font-semibold text-sm md:text-base text-white">Kembali ke Beranda</span>
    </a>
</div>
