<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }} - Profile</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap"
        rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-['Poppins'] antialiased bg-gray-50 min-h-screen pb-20">

    <div class="relative bg-gradient-to-br from-indigo-600 to-violet-700 pb-24 pt-10 px-6 rounded-b-[3rem] shadow-lg overflow-hidden">

        <div class="absolute inset-0 opacity-10 pointer-events-none">
            <svg width="100%" height="100%" xmlns="http://www.w3.org/2000/svg">
                <defs>
                    <pattern id="grid" width="40" height="40" patternUnits="userSpaceOnUse">
                        <path d="M 40 0 L 0 0 0 40" fill="none" stroke="white" stroke-width="1" />
                    </pattern>
                </defs>
                <rect width="100%" height="100%" fill="url(#grid)" />
            </svg>
        </div>

        <div class="relative z-10 max-w-6xl mx-auto">
            <a href="{{ route('onboarding') }}"
                class="inline-flex items-center gap-2 text-white/80 hover:text-white transition mb-8 group">
                <div class="p-1 rounded-full bg-white/10 group-hover:bg-white/20 transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                    </svg>
                </div>
                <span class="font-medium text-sm">Kembali ke Beranda</span>
            </a>

            <div class="flex flex-col md:flex-row items-center md:items-end gap-6 text-center md:text-left">

                <div class="relative">
                    <div
                        class="w-28 h-28 md:w-32 md:h-32 rounded-full border-4 border-white/30 bg-white shadow-xl overflow-hidden flex items-center justify-center">
                        @if (Auth::user()->foto_profil)
                            <img src="{{ Storage::url(Auth::user()->foto_profil) }}" class="w-full h-full object-cover">
                        @else
                            <span
                                class="text-4xl font-bold text-indigo-600">{{ substr(Auth::user()->name, 0, 1) }}</span>
                        @endif
                    </div>
                    <div class="absolute bottom-2 right-2 bg-green-400 border-2 border-white w-5 h-5 rounded-full shadow-md"
                        title="Online"></div>
                </div>

                <div class="flex-1 mb-2">
                    <h1 class="text-3xl font-bold text-white tracking-tight">{{ Auth::user()->name }}</h1>
                    <p class="text-indigo-100 text-sm md:text-base mb-2">{{ Auth::user()->email }}</p>

                    <div
                        class="inline-flex items-center gap-1.5 bg-white/20 backdrop-blur-sm px-3 py-1 rounded-full text-xs text-white border border-white/10">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        <span>Bergabung sejak {{ Auth::user()->created_at->translatedFormat('F Y') }}</span>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <div class="max-w-6xl mx-auto px-6 -mt-10 relative z-20">

        <div
            class="bg-white rounded-2xl shadow-md border border-gray-100 p-2 mb-8 flex flex-wrap gap-2 justify-center md:justify-start">
            <a href="{{ route('profile.index') }}"
                class="px-5 py-2.5 rounded-xl text-sm font-semibold transition-all duration-300 {{ request()->routeIs('profile.index') || request()->routeIs('profile.edit') ? 'bg-indigo-600 text-white shadow-md' : 'text-gray-500 hover:bg-gray-50 hover:text-gray-900' }}">
                Profil Saya
            </a>
            <a href="{{ route('profile.history') }}"
                class="px-5 py-2.5 rounded-xl text-sm font-semibold transition-all duration-300 {{ request()->routeIs('profile.history') ? 'bg-indigo-600 text-white shadow-md' : 'text-gray-500 hover:bg-gray-50 hover:text-gray-900' }}">
                Riwayat Transaksi
            </a>
            <a href="{{ route('pengelola.index') }}"
                class="px-5 py-2.5 rounded-xl text-sm font-semibold transition-all duration-300 {{ request()->routeIs('pengelola.*') ? 'bg-indigo-600 text-white shadow-md' : 'text-gray-500 hover:bg-gray-50 hover:text-gray-900' }}">
                Pengajuan Pengelola
            </a>
        </div>

        @yield('content')
    </div>

    @stack('scripts')

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            if (typeof lucide !== 'undefined') {
                lucide.createIcons();
            }
        });
    </script>
</body>

</html>
