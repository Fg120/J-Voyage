@extends('layouts.profile.app')

@section('content')
    <!-- Grid Layout -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Informasi Pribadi Card -->
        <div class="bg-white rounded-2xl shadow-md p-8">
            <h2 class="text-2xl font-bold text-gray-900 mb-6">Informasi Pribadi</h2>

            <div class="space-y-6">
                <!-- Nama Lengkap -->
                <div class="flex items-start gap-4">
                    <div class="w-12 h-12 bg-indigo-100 rounded-full flex items-center justify-center flex-shrink-0">
                        <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-xs text-gray-500 mb-1">Nama Lengkap</p>
                        <p class="text-base font-semibold text-gray-900">{{ Auth::user()->name }}</p>
                    </div>
                </div>

                <!-- Email -->
                <div class="flex items-start gap-4">
                    <div class="w-12 h-12 bg-indigo-100 rounded-full flex items-center justify-center flex-shrink-0">
                        <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-xs text-gray-500 mb-1">Email</p>
                        <p class="text-base font-semibold text-gray-900">{{ Auth::user()->email }}</p>
                    </div>
                </div>

                <!-- Nomor Telepon -->
                <div class="flex items-start gap-4">
                    <div class="w-12 h-12 bg-indigo-100 rounded-full flex items-center justify-center flex-shrink-0">
                        <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-xs text-gray-500 mb-1">Nomor Telepon</p>
                        <p class="text-base font-semibold text-gray-900">{{ Auth::user()->telepon ?? '-' }}</p>
                    </div>
                </div>

                <!-- Bergabung Sejak -->
                <div class="flex items-start gap-4">
                    <div class="w-12 h-12 bg-indigo-100 rounded-full flex items-center justify-center flex-shrink-0">
                        <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-xs text-gray-500 mb-1">Bergabung Sejak</p>
                        <p class="text-base font-semibold text-gray-900">{{ Auth::user()->created_at->translatedFormat('d F Y') }}</p>
                    </div>
                </div>
            </div>

            <!-- Edit Button -->
            <a href="{{ route('profile.edit') }}" class="block w-full mt-6 bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-3 px-6 rounded-xl transition text-center">
                Edit Profil
            </a>
        </div>

        <!-- Statistik Card -->
        <div class="bg-white rounded-2xl shadow-md p-8">
            <h2 class="text-2xl font-bold text-gray-900 mb-6">Statistik</h2>

            <div class="grid grid-cols-2 gap-4">
                <!-- Total Booking -->
                <div class="bg-gradient-to-br from-indigo-50 to-indigo-100 rounded-xl p-6">
                    <div class="w-12 h-12 bg-indigo-600 rounded-full flex items-center justify-center mb-4">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                        </svg>
                    </div>
                    <p class="text-4xl font-extrabold text-indigo-600 mb-2">0</p>
                    <p class="text-sm text-gray-600">Total Booking</p>
                </div>

                <!-- Selesai -->
                <div class="bg-gradient-to-br from-green-50 to-green-100 rounded-xl p-6">
                    <div class="w-12 h-12 bg-green-500 rounded-full flex items-center justify-center mb-4">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <p class="text-4xl font-extrabold text-green-600 mb-2">0</p>
                    <p class="text-sm text-gray-600">Selesai</p>
                </div>

                <!-- Upcoming -->
                <div class="bg-gradient-to-br from-blue-50 to-blue-100 rounded-xl p-6">
                    <div class="w-12 h-12 bg-blue-500 rounded-full flex items-center justify-center mb-4">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <p class="text-4xl font-extrabold text-blue-600 mb-2">0</p>
                    <p class="text-sm text-gray-600">Upcoming</p>
                </div>

                <!-- Dibatalkan -->
                <div class="bg-gradient-to-br from-red-50 to-red-100 rounded-xl p-6">
                    <div class="w-12 h-12 bg-red-500 rounded-full flex items-center justify-center mb-4">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <p class="text-4xl font-extrabold text-red-600 mb-2">0</p>
                    <p class="text-sm text-gray-600">Dibatalkan</p>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
