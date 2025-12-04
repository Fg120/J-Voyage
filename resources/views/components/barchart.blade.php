@props([
    'title' => 'Grafik Data',
    'data' => [],
    'labels' => [],
])

@php
    $chartId = 'chart-' . \Illuminate\Support\Str::random(10);
@endphp

{{-- 1. Container diganti jadi bg-neutral-800 dan text-white --}}
<div class="bg-neutral-800 rounded-2xl shadow-lg border border-neutral-700 p-6">
    <h3 class="text-lg font-bold text-white mb-6">{{ $title }}</h3>

    <div id="{{ $chartId }}"></div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const options = {
            series: [{
                name: 'Data',
                data: @json($data)
            }],
            chart: {
                type: 'bar',
                height: 350,
                toolbar: {
                    show: false
                },
                // Background chart transparan agar mengikuti parent
                background: 'transparent',
                fontFamily: 'inherit'
            },
            // Gunakan mode 'dark' agar tooltip otomatis warna gelap
            theme: {
                mode: 'dark'
            },
            xaxis: {
                categories: @json($labels),
                axisBorder: {
                    show: false
                },
                axisTicks: {
                    show: false
                },
                labels: {
                    style: {
                        // Warna Label Sumbu X (Abu-abu terang)
                        colors: '#a3a3a3',
                        fontSize: '12px'
                    }
                }
            },
            yaxis: {
                labels: {
                    style: {
                        // Warna Label Sumbu Y (Abu-abu terang)
                        colors: '#a3a3a3',
                        fontSize: '12px'
                    },
                    formatter: function(value) {
                        // Format angka ribuan (K) agar tidak kepanjangan
                        if (value >= 1000) {
                            return (value / 1000).toFixed(0) + 'k';
                        }
                        return value;
                    }
                }
            },
            grid: {
                // Warna garis grid (Abu-abu sangat gelap agar tidak mencolok)
                borderColor: '#404040',
                strokeDashArray: 4,
            },
            // Warna Batang Grafik (Indigo Terang agar kontras)
            colors: ['#818cf8'],
            plotOptions: {
                bar: {
                    borderRadius: 4,
                    columnWidth: '55%',
                }
            },
            dataLabels: {
                enabled: false
            }
        };

        const chart = new ApexCharts(document.querySelector("#{{ $chartId }}"), options);
        chart.render();
    });
</script>
