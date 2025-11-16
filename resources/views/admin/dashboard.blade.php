@extends('layouts.admin.app')

@section('content')
    <div class="space-y-6">
        <!-- Header -->
        <div>
            <h1 class="text-2xl font-semibold text-gray-900">Dasboard Admin</h1>
            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">Selamat datang di dasboard admin!</p>
        </div>

        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
            <!-- Card 1 -->
            <div class="bg-white dark:bg-neutral-800 rounded-lg shadow p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Total User</p>
                        <p class="text-2xl font-bold text-gray-900 dark:text-white mt-2">2,543</p>
                    </div>
                    <div class="p-3 bg-blue-100 dark:bg-blue-900/30 rounded-full">
                        <i data-lucide="users" class="size-6 text-blue-600 dark:text-blue-400"></i>
                    </div>
                </div>
                <div class="mt-4 flex items-center text-sm">
                    <span class="text-green-600 dark:text-green-400 font-medium">+12.5%</span>
                    <span class="text-gray-600 dark:text-gray-400 ml-2">dari bulan lalu</span>
                </div>
            </div>

            <!-- Card 2 -->
            <div class="bg-white dark:bg-neutral-800 rounded-lg shadow p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Pendapatan</p>
                        <p class="text-2xl font-bold text-gray-900 dark:text-white mt-2">$45,231</p>
                    </div>
                    <div class="p-3 bg-green-100 dark:bg-green-900/30 rounded-full">
                        <i data-lucide="dollar-sign" class="size-6 text-green-600 dark:text-green-400"></i>
                    </div>
                </div>
                <div class="mt-4 flex items-center text-sm">
                    <span class="text-green-600 dark:text-green-400 font-medium">+8.2%</span>
                    <span class="text-gray-600 dark:text-gray-400 ml-2">from last month</span>
                </div>
            </div>

            <!-- Card 3 -->
            <div class="bg-white dark:bg-neutral-800 rounded-lg shadow p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Pesanan</p>
                        <p class="text-2xl font-bold text-gray-900 dark:text-white mt-2">1,234</p>
                    </div>
                    <div class="p-3 bg-purple-100 dark:bg-purple-900/30 rounded-full">
                        <i data-lucide="shopping-cart" class="size-6 text-purple-600 dark:text-purple-400"></i>
                    </div>
                </div>
                <div class="mt-4 flex items-center text-sm">
                    <span class="text-red-600 dark:text-red-400 font-medium">-3.1%</span>
                    <span class="text-gray-600 dark:text-gray-400 ml-2">from last month</span>
                </div>
            </div>

            <!-- Card 4 -->
            <div class="bg-white dark:bg-neutral-800 rounded-lg shadow p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Pertumbuhan</p>
                        <p class="text-2xl font-bold text-gray-900 dark:text-white mt-2">24.5%</p>
                    </div>
                    <div class="p-3 bg-orange-100 dark:bg-orange-900/30 rounded-full">
                        <i data-lucide="trending-up" class="size-6 text-orange-600 dark:text-orange-400"></i>
                    </div>
                </div>
                <div class="mt-4 flex items-center text-sm">
                    <span class="text-green-600 dark:text-green-400 font-medium">+5.4%</span>
                    <span class="text-gray-600 dark:text-gray-400 ml-2">from last month</span>
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
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Penjualan Bulanan</h3>
                <div id="barChart"></div>
            </div>
        </div>

        <!-- Charts Row 2 -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Donut Chart -->
            <div class="bg-white dark:bg-neutral-800 rounded-lg shadow p-6">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Sumber Lalu Lintas</h3>
                <div id="donutChart"></div>
            </div>

            <!-- Area Chart -->
            <div class="bg-white dark:bg-neutral-800 rounded-lg shadow p-6 lg:col-span-2">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Analitik Pengunjung</h3>
                <div id="areaChart"></div>
            </div>
        </div>

        <!-- Charts Row 3 -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <!-- Radial Chart -->
            <div class="bg-white dark:bg-neutral-800 rounded-lg shadow p-6">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Penyelesaian Tujuan</h3>
                <div id="radialChart"></div>
            </div>

            <!-- Mixed Chart -->
            <div class="bg-white dark:bg-neutral-800 rounded-lg shadow p-6">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Pendapatan vs Laba</h3>
                <div id="mixedChart"></div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Check if dark mode is enabled
            const isDark = document.documentElement.classList.contains('dark');
            const textColor = isDark ? '#e5e7eb' : '#374151';
            const gridColor = isDark ? '#374151' : '#e5e7eb';

            // Line Chart
            const lineOptions = {
                series: [{
                    name: 'Revenue',
                    data: [31000, 40000, 28000, 51000, 42000, 109000, 100000, 91000, 125000, 135000, 142000, 158000]
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
                    categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
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
                            return '$' + val.toLocaleString();
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
                            return '$' + val.toLocaleString();
                        }
                    }
                }
            };
            const lineChart = new ApexCharts(document.querySelector("#lineChart"), lineOptions);
            lineChart.render();

            // Bar Chart
            const barOptions = {
                series: [{
                    name: 'Sales',
                    data: [44, 55, 41, 67, 22, 43, 21, 49, 56, 72, 68, 88]
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
                    categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
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

            // Donut Chart
            const donutOptions = {
                series: [44, 55, 13, 33],
                chart: {
                    type: 'donut',
                    height: 300,
                    background: 'transparent',
                    zoom: {
                        enabled: false
                    }
                },
                labels: ['Direct', 'Social', 'Email', 'Referral'],
                colors: ['#3b82f6', '#10b981', '#f59e0b', '#ef4444'],
                legend: {
                    position: 'bottom',
                    labels: {
                        colors: textColor
                    }
                },
                dataLabels: {
                    enabled: true,
                    style: {
                        colors: ['#fff']
                    }
                },
                tooltip: {
                    theme: isDark ? 'dark' : 'light'
                }
            };
            const donutChart = new ApexCharts(document.querySelector("#donutChart"), donutOptions);
            donutChart.render();

            // Area Chart
            const areaOptions = {
                series: [{
                    name: 'Visitors',
                    data: [31, 40, 28, 51, 42, 109, 100, 91, 125, 135, 142, 158]
                }],
                chart: {
                    height: 300,
                    type: 'area',
                    toolbar: {
                        show: false
                    },
                    background: 'transparent',
                    zoom: {
                        enabled: false
                    }
                },
                colors: ['#8b5cf6'],
                dataLabels: {
                    enabled: false
                },
                stroke: {
                    curve: 'smooth',
                    width: 2
                },
                fill: {
                    type: 'gradient',
                    gradient: {
                        shadeIntensity: 1,
                        opacityFrom: 0.7,
                        opacityTo: 0.2,
                    }
                },
                xaxis: {
                    categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
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
            const areaChart = new ApexCharts(document.querySelector("#areaChart"), areaOptions);
            areaChart.render();

            // Radial Chart
            const radialOptions = {
                series: [76, 67, 61, 82],
                chart: {
                    height: 300,
                    type: 'radialBar',
                    background: 'transparent',
                    zoom: {
                        enabled: false
                    }
                },
                plotOptions: {
                    radialBar: {
                        dataLabels: {
                            name: {
                                fontSize: '16px',
                                color: textColor
                            },
                            value: {
                                fontSize: '14px',
                                color: textColor
                            },
                            total: {
                                show: true,
                                label: 'Total',
                                color: textColor,
                                formatter: function(w) {
                                    return '71.5%'
                                }
                            }
                        }
                    }
                },
                labels: ['Q1', 'Q2', 'Q3', 'Q4'],
                colors: ['#3b82f6', '#10b981', '#f59e0b', '#ef4444'],
                legend: {
                    show: true,
                    position: 'bottom',
                    labels: {
                        colors: textColor
                    }
                }
            };
            const radialChart = new ApexCharts(document.querySelector("#radialChart"), radialOptions);
            radialChart.render();

            // Mixed Chart (Line + Column)
            const mixedOptions = {
                series: [{
                    name: 'Revenue',
                    type: 'column',
                    data: [23000, 42000, 35000, 27000, 43000, 22000, 17000, 31000, 22000, 22000, 12000, 16000]
                }, {
                    name: 'Profit',
                    type: 'line',
                    data: [5000, 8000, 7000, 5000, 9000, 4000, 3000, 6000, 4000, 4000, 2000, 3000]
                }],
                chart: {
                    height: 300,
                    type: 'line',
                    toolbar: {
                        show: false
                    },
                    background: 'transparent',
                    zoom: {
                        enabled: false
                    }
                },
                stroke: {
                    width: [0, 3],
                    curve: 'smooth'
                },
                plotOptions: {
                    bar: {
                        borderRadius: 6,
                        columnWidth: '50%'
                    }
                },
                colors: ['#3b82f6', '#10b981'],
                dataLabels: {
                    enabled: false
                },
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                xaxis: {
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
                            return '$' + val.toLocaleString();
                        }
                    }
                },
                grid: {
                    borderColor: gridColor
                },
                legend: {
                    labels: {
                        colors: textColor
                    }
                },
                tooltip: {
                    theme: isDark ? 'dark' : 'light',
                    shared: true,
                    intersect: false,
                    y: {
                        formatter: function(val) {
                            return '$' + val.toLocaleString();
                        }
                    }
                }
            };
            const mixedChart = new ApexCharts(document.querySelector("#mixedChart"), mixedOptions);
            mixedChart.render();

            // Re-render charts on dark mode toggle
            const darkModeToggle = document.getElementById('darkModeToggle');
            darkModeToggle?.addEventListener('click', () => {
                setTimeout(() => {
                    location.reload(); // Reload to re-render charts with new theme
                }, 100);
            });
        });
    </script>
@endsection
