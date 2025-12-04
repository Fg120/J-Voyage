<!-- ========== HEADER ========== -->
<header class="flex flex-wrap md:justify-start md:flex-nowrap z-50 w-full bg-neutral-900 border-b border-neutral-700 sticky top-0 shadow-md">
    <nav class="relative max-w-[85rem] w-full mx-auto md:flex md:items-center md:justify-between md:gap-3 py-4 px-4 sm:px-6 lg:px-8 ">
        <div class="flex justify-between items-center gap-x-1">
            <a class="flex-none font-semibold text-xl text-white focus:outline-hidden focus:opacity-80 cursor-pointer" href="#" aria-label="Brand" href="/" >
                <span class="inline-flex items-center gap-x-2 text-xl font-semibold" >
                    <img class="w-10 h-auto" src="{{ asset('assets/images/logo.png') }}" alt="Logo">
                    J-Voyage
                </span>
            </a>

            <!-- Collapse Button -->
            <button type="button"
                class="hs-collapse-toggle md:hidden relative size-9 flex justify-center items-center font-medium text-sm rounded-lg border border-neutral-700 text-white hover:bg-neutral-700 focus:outline-hidden disabled:opacity-50 disabled:pointer-events-none"
                id="hs-header-base-collapse" aria-expanded="false" aria-controls="hs-header-base" aria-label="Toggle navigation" data-hs-collapse="#hs-header-base">
                <svg class="hs-collapse-open:hidden size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                    stroke-linecap="round" stroke-linejoin="round">
                    <line x1="3" x2="21" y1="6" y2="6" />
                    <line x1="3" x2="21" y1="12" y2="12" />
                    <line x1="3" x2="21" y1="18" y2="18" />
                </svg>
                <svg class="hs-collapse-open:block shrink-0 hidden size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M18 6 6 18" />
                    <path d="m6 6 12 12" />
                </svg>
                <span class="sr-only">Toggle navigation</span>
            </button>
            <!-- End Collapse Button -->
        </div>

        <!-- Collapse -->
        <div id="hs-header-base" class="hs-collapse hidden overflow-hidden transition-all duration-300 basis-full grow md:block" aria-labelledby="hs-header-base-collapse">
            <div
                class="overflow-hidden overflow-y-auto max-h-[75vh] [&::-webkit-scrollbar]:w-2 [&::-webkit-scrollbar-thumb]:rounded-full [&::-webkit-scrollbar-track]:bg-neutral-700 [&::-webkit-scrollbar-thumb]:bg-neutral-500">
                <div class="py-2 md:py-0 flex flex-col md:flex-row md:items-center gap-0.5 md:gap-1">
                    <div class="grow">
                        <div class="flex flex-col md:flex-row md:justify-end md:items-center gap-0.5 md:gap-1">
                            <a class="p-2 flex items-center text-sm text-white hover:bg-neutral-700 rounded-lg focus:outline-hidden"
                                href="#beranda">
                                Beranda
                            </a>

                            <a class="p-2 flex items-center text-sm text-white hover:bg-neutral-700 rounded-lg focus:outline-hidden" href="/#tentang">
                                Tentang Kami
                            </a>

                            <a class="p-2 flex items-center text-sm text-white hover:bg-neutral-700 rounded-lg focus:outline-hidden" href="/#wisata">
                                Wisata
                            </a>

                            <a class="p-2 flex items-center text-sm text-white hover:bg-neutral-700 rounded-lg focus:outline-hidden" href="/#faq">
                                FAQ
                            </a>
                        </div>
                    </div>

                    <div class="my-2 md:my-0 md:mx-2">
                        <div class="w-full h-px md:w-px md:h-4 bg-neutral-700"></div>
                    </div>

                    <!-- Button Group / Profile -->
                    <div class="flex flex-wrap items-center gap-x-1.5">
                        @auth
                            <!-- Dropdown -->
                            <div class="hs-dropdown [--placement:bottom-right] relative inline-flex">
                                <button id="hs-dropdown-account" type="button"
                                    class="inline-flex items-center gap-x-2 px-2 py-1 rounded-lg hover:bg-neutral-700 transition-colors focus:outline-hidden text-white" aria-haspopup="menu"
                                    aria-expanded="false" aria-label="User menu">
                                    <svg class="shrink-0 size-4" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path>
                                    </svg>
                                    {{ auth()->user()->name }}
                                    <i data-lucide="chevron-down" class="shrink-0 size-4"></i>
                                </button>

                                <div class="hs-dropdown-menu transition-[opacity,margin] duration hs-dropdown-open:opacity-100 opacity-0 hidden min-w-60 bg-neutral-800 shadow-black/50 shadow-xl rounded-lg mt-2 after:h-4 after:absolute after:-bottom-4 after:start-0 after:w-full before:h-4 before:absolute before:-top-4 before:start-0 before:w-full"
                                    role="menu" aria-orientation="vertical" aria-labelledby="hs-dropdown-account">
                                    <div class="p-1.5 space-y-0.5">
                                        @if (auth()->user()->hasRole('admin'))
                                            <a class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm text-neutral-200 hover:bg-neutral-700 focus:outline-hidden"
                                                href="{{ route('admin.dashboard') }}">
                                                Dashboard
                                            </a>
                                        @elseif(auth()->user()->hasRole('pengelola'))
                                            <a class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm text-neutral-200 hover:bg-neutral-700 focus:outline-hidden"
                                                href="{{ route('pengelola.dashboard') }}">
                                                Dashboard
                                            </a>
                                        @endif
                                        <a class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm text-neutral-200 hover:bg-neutral-700 focus:outline-hidden focus:bg-neutral-700"
                                            href="{{ route('profile.index') }}">
                                            Profile
                                        </a>

                                        <form method="POST" action="{{ route('logout') }}" class="w-full">
                                            @csrf
                                            <button type="submit" class="w-full flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm text-red-400 hover:bg-neutral-700 focus:outline-hidden">
                                                Logout
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @else
                            <a href="{{ route('login') }}" class="py-2 px-2.5 inline-flex items-center font-medium text-sm rounded-lg bg-indigo-300 text-black hover:bg-indigo-400">
                                LOGIN
                            </a>
                        @endauth
                    </div>
                    <!-- End Button Group -->
                </div>
            </div>
        </div>
        <!-- End Collapse -->
    </nav>
</header>
<!-- ========== END HEADER ========== -->
