<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name') }}</title>

    <script>
        if (localStorage.getItem('theme') === 'dark' || (!localStorage.getItem('theme') && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        }
    </script>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @stack('css')
    @stack('script')
</head>

<body class="font-sans antialiased">
    <div class="min-h-screen">
        @include('layouts.admin.sidebar')

        <div class="lg:ps-64 flex flex-col min-h-screen">
            @include('layouts.admin.header')
            @include('layouts.admin.breadcrumb')

            <!-- Content -->
            <div class="flex-1">
                <div class="p-4 sm:p-6 space-y-4 sm:space-y-6">
                    @yield('content')
                </div>
            </div>
            <!-- End Content -->
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize Lucide icons
            if (typeof lucide !== 'undefined') {
                lucide.createIcons();
            }

            // Sidebar Toggle
            const sidebar = document.getElementById('hs-application-sidebar');
            const overlay = document.getElementById('sidebar-overlay');
            const toggleBtn = document.querySelector('[data-hs-overlay="#hs-application-sidebar"]');

            function openSidebar() {
                sidebar.classList.remove('-translate-x-full');
                overlay.classList.remove('hidden');
            }

            function closeSidebar() {
                sidebar.classList.add('-translate-x-full');
                overlay.classList.add('hidden');
            }

            if (toggleBtn) {
                toggleBtn.addEventListener('click', function(e) {
                    e.preventDefault();
                    if (sidebar.classList.contains('-translate-x-full')) {
                        openSidebar();
                    } else {
                        closeSidebar();
                    }
                });
            }

            if (overlay) {
                overlay.addEventListener('click', closeSidebar);
            }

            // Close on menu click (mobile)
            const menuLinks = sidebar.querySelectorAll('a');
            menuLinks.forEach(link => {
                link.addEventListener('click', function() {
                    if (window.innerWidth < 1024) {
                        closeSidebar();
                    }
                });
            });

            // Dark Mode Toggle
            const darkModeToggle = document.getElementById('darkModeToggle');
            const html = document.documentElement;

            if (darkModeToggle) {
                darkModeToggle.addEventListener('click', () => {
                    html.classList.toggle('dark');
                    const theme = html.classList.contains('dark') ? 'dark' : 'light';
                    localStorage.setItem('theme', theme);

                    setTimeout(() => {
                        if (typeof lucide !== 'undefined') {
                            lucide.createIcons();
                        }
                    }, 10);
                });
            }

            // Profile Dropdown Toggle
            const dropdownButton = document.getElementById('hs-dropdown-account');
            const dropdownMenu = dropdownButton?.nextElementSibling;

            if (dropdownButton && dropdownMenu) {
                let currentState = 'closed'; // 'closed', 'opening', 'open', 'closing'
                let animationTimeout = null;

                function setState(newState) {
                    currentState = newState;
                }

                function openDropdown() {
                    // Clear any pending animations
                    if (animationTimeout) {
                        clearTimeout(animationTimeout);
                        animationTimeout = null;
                    }

                    // Force reset to ensure clean state
                    dropdownMenu.classList.remove('hidden', 'opacity-0');
                    dropdownMenu.classList.add('opacity-100');
                    dropdownButton.setAttribute('aria-expanded', 'true');
                    setState('open');
                }

                function closeDropdown() {
                    // Clear any pending animations
                    if (animationTimeout) {
                        clearTimeout(animationTimeout);
                        animationTimeout = null;
                    }

                    setState('closing');
                    dropdownMenu.classList.remove('opacity-100');
                    dropdownMenu.classList.add('opacity-0');
                    dropdownButton.setAttribute('aria-expanded', 'false');

                    animationTimeout = setTimeout(() => {
                        if (currentState === 'closing') {
                            dropdownMenu.classList.add('hidden');
                            setState('closed');
                        }
                        animationTimeout = null;
                    }, 150);
                }

                dropdownButton.addEventListener('click', function(e) {
                    e.preventDefault();
                    e.stopPropagation();

                    // Always check actual DOM state as source of truth
                    const isVisible = !dropdownMenu.classList.contains('hidden');

                    if (isVisible) {
                        closeDropdown();
                    } else {
                        openDropdown();
                    }
                });

                // Close dropdown when clicking outside
                document.addEventListener('click', function(e) {
                    if (!dropdownButton.contains(e.target) && !dropdownMenu.contains(e.target)) {
                        const isVisible = !dropdownMenu.classList.contains('hidden');
                        if (isVisible) {
                            closeDropdown();
                        }
                    }
                });

                // Close on ESC key
                document.addEventListener('keydown', function(e) {
                    if (e.key === 'Escape') {
                        const isVisible = !dropdownMenu.classList.contains('hidden');
                        if (isVisible) {
                            closeDropdown();
                        }
                    }
                });
            }
        });
    </script>
</body>

</html>
