@extends('layouts.admin.app')

@section('content')
    <div class="space-y-6">
        <!-- Header -->
        <div>
            <h1 class="text-2xl font-semibold text-gray-900">Dasboard Pengelola</h1>
            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">Selamat datang di dasboard Pengelola!</p>
        </div>

        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
            <!-- Card 1 -->
            <div class="bg-neutral-800 rounded-lg shadow p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Jumlah Pengunjung</p>
                        <p class="text-2xl font-bold text-gray-900 dark:text-white mt-2">{{ $jumlahpengunjung }}</p>
                    </div>
                    <div class="p-3 bg-blue-100 dark:bg-blue-900/30 rounded-full">
                        <i data-lucide="users" class="size-6 text-blue-600 dark:text-blue-400"></i>
                    </div>
                </div>
            </div>

            <!-- Card 2 -->
            <div class="bg-white dark:bg-neutral-800 rounded-lg shadow p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Transaksi Belum Disetujui</p>
                        <p class="text-2xl font-bold text-gray-900 dark:text-white mt-2">{{ $belumdisetujui }}</p>
                    </div>
                    <div class="p-3  dark:bg-orange-900/30 rounded-full">
                        <i data-lucide="circle-alert" class="size-6 text-orange-600"></i>
                    </div>
                </div>
            </div>

            <!-- Card 3 -->
            <div class="bg-white dark:bg-neutral-800 rounded-lg shadow p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Transaksi Berhasil</p>
                        <p class="text-2xl font-bold text-gray-900 dark:text-white mt-2">{{ $transaksiberhasil }}</p>
                    </div>
                    <div class="p-3 bg-green-900/30 rounded-full">
                        <i data-lucide="circle-check-big" class="size-6 text-green-600 "></i>
                    </div>
                </div>
            </div>

            <!-- Card 4 -->
            <div class="bg-white dark:bg-neutral-800 rounded-lg shadow p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Total Pendapatan</p>
                        <p class="text-2xl font-bold text-gray-900 dark:text-white mt-2">Rp. {{ $pendapatan }}</p>
                    </div>
                    <div class="p-3 bg-purple-900/30 rounded-full">
                        <i data-lucide="dollar-sign" class="size-6 text-purple-600 "></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Charts Row 1 -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <!-- Line Chart -->
            <div class="bg-white dark:bg-neutral-800 rounded-lg shadow p-6">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Ringkasan Pendapatan</h3>
                <div id="lineChart"></div>
            </div>

            <!-- Bar Chart -->
            <div class="bg-white dark:bg-neutral-800 rounded-lg shadow p-6">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4"> Jumlah Pengunjung Bulanan</h3>
                <div id="barChart"></div>
            </div>
        </div>

    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Check if dark mode is enabled
            const isDark = document.documentElement.classList.contains('dark');
            const textColor = isDark ? '#e5e7eb' : '#374151';
            const gridColor = isDark ? '#374151' : '#e5e7eb';

            var RevenueData = @json($dataChart);
            var PengunjungData = @json($datapengunjungperbulan);

            // Line Chart
            const lineOptions = {
                series: [{
                    name: 'Revenue',
                    data: RevenueData
                }],
                chart: {
                    height: 350,
                    type: 'line',
                    toolbar: {
                        show: false
                    },
                    background: 'transparent',
                    zoom: {
                        enabled: false
                    }
                },
                colors: ['#3b82f6'],
                dataLabels: {
                    enabled: false
                },
                stroke: {
                    curve: 'smooth',
                    width: 3
                },
                xaxis: {
                    categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov',
                        'Dec'
                    ],
                    labels: {
                        style: {
                            colors: textColor
                        }
                    }
                },
                yaxis: {
                    labels: {
                        style: {
                            colors: textColor
                        },
                        formatter: function(val) {
                            return 'Rp' + val.toLocaleString();
                        }
                    }
                },
                grid: {
                    borderColor: gridColor
                },
                tooltip: {
                    theme: isDark ? 'dark' : 'light',
                    y: {
                        formatter: function(val) {
                            return 'Rp' + val.toLocaleString();
                        }
                    }
                }
            };
            const lineChart = new ApexCharts(document.querySelector("#lineChart"), lineOptions);
            lineChart.render();

            // Bar Chart
            const barOptions = {
                series: [{
                    name: 'Pengunjung',
                    data: PengunjungData
                }],
                chart: {
                    type: 'bar',
                    height: 350,
                    toolbar: {
                        show: false
                    },
                    background: 'transparent',
                    zoom: {
                        enabled: false
                    }
                },
                colors: ['#10b981'],
                plotOptions: {
                    bar: {
                        borderRadius: 8,
                        dataLabels: {
                            position: 'top',
                        },
                    }
                },
                dataLabels: {
                    enabled: false
                },
                xaxis: {
                    categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov',
                        'Dec'
                    ],
                    labels: {
                        style: {
                            colors: textColor
                        }
                    }
                },
                yaxis: {
                    labels: {
                        style: {
                            colors: textColor
                        }
                    }
                },
                grid: {
                    borderColor: gridColor
                },
                tooltip: {
                    theme: isDark ? 'dark' : 'light'
                }
            };
            const barChart = new ApexCharts(document.querySelector("#barChart"), barOptions);
            barChart.render();

        });
    </script>
@endsection
