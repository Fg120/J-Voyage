@props([
    'title' => 'Grafik Donut',
    'data' => [],
    'labels' => [],
])

@php
    $chartId = 'donut-' . \Illuminate\Support\Str::random(10);
@endphp

<div class="bg-white dark:bg-neutral-800 rounded-2xl shadow-lg border border-neutral-200 dark:border-neutral-700 p-6">
    <h3 class="text-lg font-bold text-gray-800 dark:text-white mb-6">{{ $title }}</h3>

    <div id="{{ $chartId }}"></div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const options = {
            series: @json($data), // Data donut berupa array angka [10, 20, 5]
            chart: {
                type: 'donut',
                height: 350,
                background: 'transparent',
                fontFamily: 'inherit'
            },
            labels: @json($labels), // Label [Admin, User, Pengelola]
            colors: ['#3b82f6', '#10b981', '#f59e0b', '#ef4444', '#8b5cf6'], // Warna-warni
            theme: {
                mode: 'dark' // Agar tooltip gelap
            },
            plotOptions: {
                pie: {
                    donut: {
                        size: '65%', // Ketebalan donut
                        labels: {
                            show: true,
                            total: {
                                show: true,
                                label: 'Total',
                                color: '#a3a3a3',
                                formatter: function(w) {
                                    return w.globals.seriesTotals.reduce((a, b) => {
                                        return a + b
                                    }, 0)
                                }
                            }
                        }
                    }
                }
            },
            legend: {
                position: 'bottom',
                labels: {
                    colors: '#a3a3a3'
                }
            },
            dataLabels: {
                enabled: false // Matikan angka di dalam donut agar bersih
            },
            stroke: {
                show: false // Hilangkan garis putih pemisah
            }
        };

        const chart = new ApexCharts(document.querySelector("#{{ $chartId }}"), options);
        chart.render();
    });
</script>
