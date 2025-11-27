<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class=" scroll-smooth">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans text-gray-900 antialiased bg-neutral-100 " >
    @include('components.onboarding.navbar')
    @yield('content')
    @include('components.onboarding.footer')

    @stack('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            if (typeof lucide !== 'undefined') {
                lucide.createIcons();
            }

            const dropdownButton = document.getElementById('hs-dropdown-account');
            const dropdownMenu = dropdownButton?.nextElementSibling;

            if (dropdownButton && dropdownMenu) {
                let currentState = 'closed';
                let animationTimeout = null;

                function setState(newState) {
                    currentState = newState;
                }

                function openDropdown() {
                    if (animationTimeout) {
                        clearTimeout(animationTimeout);
                        animationTimeout = null;
                    }

                    dropdownMenu.classList.remove('hidden', 'opacity-0');
                    dropdownMenu.classList.add('opacity-100');
                    dropdownButton.setAttribute('aria-expanded', 'true');
                    setState('open');
                }

                function closeDropdown() {
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
                    console.log('Dropdown clicked');

                    e.preventDefault();
                    e.stopPropagation();

                    const isVisible = !dropdownMenu.classList.contains('hidden');

                    if (isVisible) {
                        closeDropdown();
                    } else {
                        openDropdown();
                    }
                });

                document.addEventListener('click', function(e) {
                    if (!dropdownButton.contains(e.target) && !dropdownMenu.contains(e.target)) {
                        const isVisible = !dropdownMenu.classList.contains('hidden');
                        if (isVisible) {
                            closeDropdown();
                        }
                    }
                });

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
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init();
    </script>
</body>

</html>
