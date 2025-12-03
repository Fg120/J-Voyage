<!-- ========== HEADER ========== -->
<header
    class="sticky top-0 inset-x-0 flex flex-wrap md:justify-start md:flex-nowrap z-[55] w-full bg-white border-b border-gray-200 text-sm py-2.5 lg:ps-0 dark:bg-neutral-800 dark:border-neutral-700 shadow-xl shadow-black/20">
    <nav class="px-4 sm:px-6 flex basis-full items-center w-full mx-auto">
        <div class="me-5 lg:me-0 lg:hidden">
            <!-- Mobile Menu Toggle -->
            <button type="button"
                class="hs-collapse-toggle inline-flex justify-center items-center gap-x-2 size-9 text-sm font-semibold rounded-lg border border-transparent text-gray-800 hover:bg-gray-100 focus:outline-hidden focus:bg-gray-100 disabled:opacity-50 disabled:pointer-events-none dark:text-white dark:hover:bg-neutral-700 dark:focus:bg-neutral-700"
                data-hs-overlay="#hs-application-sidebar" aria-expanded="false" aria-controls="hs-application-sidebar">
                <svg class="hs-collapse-open:hidden size-4" xmlns="http://www.w3.org/2000/svg" width="24"
                    height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                    stroke-linecap="round" stroke-linejoin="round">
                    <line x1="3" x2="21" y1="6" y2="6" />
                    <line x1="3" x2="21" y1="12" y2="12" />
                    <line x1="3" x2="21" y1="18" y2="18" />
                </svg>
                <svg class="hs-collapse-open:block hidden size-4" xmlns="http://www.w3.org/2000/svg" width="24"
                    height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                    stroke-linecap="round" stroke-linejoin="round">
                    <path d="M18 6l-12 12" />
                    <path d="M6 6l12 12" />
                </svg>
            </button>
            <div class="lg:hidden ms-1">
            </div>
        </div>

        <div class="w-full flex items-center justify-end gap-x-3 md:gap-x-4">

            <div class="flex flex-row items-center justify-end gap-3">

                <!-- Dark Mode Toggle -->
                {{-- <button type="button" id="darkModeToggle"
                    class="size-9 relative inline-flex justify-center items-center gap-x-2 text-sm font-semibold rounded-full border border-transparent text-gray-800 hover:bg-gray-100 focus:outline-hidden focus:bg-gray-100 disabled:opacity-50 disabled:pointer-events-none dark:text-white dark:hover:bg-neutral-700 dark:focus:bg-neutral-700">
                    <i data-lucide="sun" class="shrink-0 size-4 dark:hidden"></i>
                    <i data-lucide="moon" class="shrink-0 size-4 hidden dark:block"></i>
                    <span class="sr-only">Toggle Dark Mode</span>
                </button> --}}
                <!-- End Dark Mode Toggle -->

                <!-- Divider -->
                <div class="h-6 w-px bg-gray-300 dark:bg-neutral-600"></div>

                <!-- User Profile Dropdown -->
                <div class="hs-dropdown [--placement:bottom-right] relative inline-flex">
                    <button id="hs-dropdown-account" type="button"
                        class="inline-flex items-center gap-x-2 px-2 py-1 rounded-lg hover:bg-gray-100 dark:hover:bg-neutral-700 transition-colors focus:outline-hidden"
                        aria-haspopup="menu" aria-expanded="false" aria-label="User menu">
                        <img class="shrink-0 size-9 rounded-full ring-2 ring-gray-200 dark:ring-neutral-600"
                            src="https://images.unsplash.com/photo-1568602471122-7832951cc4c5?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=facearea&facepad=2&w=320&h=320&q=80"
                            alt="Avatar">
                        <div class="hidden md:block text-left">
                            <p class="text-sm font-semibold text-gray-800 dark:text-white">
                                {{ auth()->user()->name ?? 'User' }}</p>
                            <p class="text-xs text-gray-500 dark:text-neutral-400">
                                <span class="inline-flex items-center gap-x-1">
                                    <span class="size-1.5 rounded-full bg-green-500"></span>
                                    {{ ucfirst(auth()->user()->roles->first()->name ?? 'User') }}
                                </span>
                            </p>
                        </div>
                        <i data-lucide="chevron-down"
                            class="hidden md:block shrink-0 size-4 text-gray-500 dark:text-neutral-400"></i>
                    </button>

                    <div class="hs-dropdown-menu transition-[opacity,margin] duration hs-dropdown-open:opacity-100 opacity-0 hidden min-w-60 bg-white shadow-black/50 shadow-xl rounded-lg mt-2 dark:bg-neutral-800 dark:border dark:border-neutral-700 dark:divide-neutral-700 after:h-4 after:absolute after:-bottom-4 after:start-0 after:w-full before:h-4 before:absolute before:-top-4 before:start-0 before:w-full"
                        role="menu" aria-orientation="vertical" aria-labelledby="hs-dropdown-account">
                        <div class="py-3 px-5 bg-gray-100 rounded-t-lg dark:bg-neutral-700">
                            <p class="text-sm text-gray-500 dark:text-neutral-500">Masuk sebagai</p>
                            <p class="text-sm font-medium text-gray-800 dark:text-neutral-200">
                                {{ auth()->user()->name ?? 'User' }}</p>
                        </div>
                        <div class="p-1.5 space-y-0.5">
                            <form method="POST" action="{{ route('logout') }}" class="w-full">
                                @csrf
                                <button type="submit"
                                    class="w-full flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-gray-100 focus:outline-hidden focus:bg-gray-100 dark:text-neutral-400 dark:hover:bg-neutral-700 dark:hover:text-neutral-300 dark:focus:bg-neutral-700 dark:focus:text-neutral-300">
                                    <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24"
                                        height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4" />
                                        <polyline points="16 17 21 12 16 7" />
                                        <line x1="21" y1="12" x2="9" y2="12" />
                                    </svg>
                                    Logout
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- End Dropdown -->
            </div>
        </div>
    </nav>
</header>
<!-- ========== END HEADER ========== -->
