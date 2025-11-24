<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }} - Profile</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-['Poppins'] antialiased bg-gray-50">
    <!-- Header dengan Background Gradient -->
    <div class="bg-gradient-to-r from-indigo-600 to-indigo-500 pt-12 pb-16">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <!-- Back Button -->
            <a href="{{ url('/') }}" class="inline-flex items-center gap-2 text-white hover:text-gray-200 transition mb-8">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
                <span class="font-semibold text-base">Kembali</span>
            </a>

            <!-- Profile Header -->
            <div class="flex items-center gap-6">
                <img class="w-24 h-24 rounded-full border-4 border-white shadow-lg object-cover"
                    src="https://images.unsplash.com/photo-1568602471122-7832951cc4c5?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=facearea&facepad=2&w=320&h=320&q=80"
                    alt="Profile">
                <div>
                    <h1 class="text-4xl font-extrabold text-white mb-2">{{ Auth::user()->name }}</h1>
                    <p class="text-white/90">Bergabung sejak {{ Auth::user()->created_at->translatedFormat('F Y') }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Content Section -->
    <div class="max-w-7xl mx-auto px-6 lg:px-8 py-8">
        <!-- Tabs -->
        <div class="border-b border-gray-200 mb-8">
            <nav class="flex gap-4">
                <a href="{{ route('profile.index') }}"
                    class="px-4 pb-4 text-lg font-semibold {{ request()->routeIs('profile.index') || request()->routeIs('profile.edit') ? 'text-indigo-600 border-b-2 border-indigo-600' : 'text-gray-500 hover:text-gray-700' }}">
                    Profil Saya
                </a>
                <a href="#" class="px-4 pb-4 text-lg font-semibold text-gray-500 hover:text-gray-700">
                    Riwayat Transaksi
                </a>
                <a href="{{ route('pengelola.index') }}"
                    class="px-4 pb-4 text-lg font-semibold {{ request()->routeIs('pengelola.*') ? 'text-indigo-600 border-b-2 border-indigo-600' : 'text-gray-500 hover:text-gray-700' }}">
                    Pengajuan Pengelola
                </a>
            </nav>
        </div>

        <!-- Content -->
        @yield('content')
    </div>

    @stack('scripts')

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize Lucide icons if available
            if (typeof lucide !== 'undefined') {
                lucide.createIcons();
            }
        });
    </script>
</body>

</html>
