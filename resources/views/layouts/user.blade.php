<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Sistem Informasi & Pengaduan Desa')</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

    {{-- File CSS kamu --}}
    <link rel="stylesheet" href="{{ asset('assets/css/user/style.css') }}">

    @stack('styles')
</head>

<body>

    {{-- Header --}}
    @include('layouts.user_header')

    {{-- Konten Halaman --}}
    <main id="main-content">
        @yield('content')
    </main>

    {{-- Footer --}}
    @include('layouts.user_footer')

    {{-- Script --}}
    <script src="{{ asset('assets/js/user/scripts.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>


    <!-- script grafik penduduk -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const chartElement = document.getElementById('pendudukChart');

            if (chartElement) {
                // Ambil data dari data attributes
                const laki = parseInt(chartElement.dataset.laki) || 0;
                const perempuan = parseInt(chartElement.dataset.perempuan) || 0;
                const kepalaKeluarga = parseInt(chartElement.dataset.kepala) || 0;

                // Hitung total
                const total = laki + perempuan;

                var options = {
                    series: [kepalaKeluarga, laki, perempuan],
                    labels: ["Kepala Keluarga", "Laki-Laki", "Perempuan"],
                    colors: ["#ee1f1fff", "#3918f3ff", "#eeaee4ff"],
                    chart: {
                        type: "donut",
                        height: 360
                    },
                    legend: {
                        position: "bottom",
                        fontSize: '14px',
                        fontFamily: 'inherit'
                    },
                    dataLabels: {
                        enabled: true,
                        formatter: function(val) {
                            return val.toFixed(1) + "%";
                        }
                    },
                    plotOptions: {
                        pie: {
                            donut: {
                                size: "65%",
                                labels: {
                                    show: true,
                                    total: {
                                        show: true,
                                        label: "Total Penduduk",
                                        fontSize: '16px',
                                        fontWeight: 600,
                                        formatter: () => total.toString()
                                    }
                                }
                            }
                        }
                    },
                    tooltip: {
                        y: {
                            formatter: function(val) {
                                return val + ' orang';
                            }
                        }
                    },
                    responsive: [{
                        breakpoint: 480,
                        options: {
                            chart: {
                                height: 300
                            },
                            legend: {
                                position: 'bottom'
                            }
                        }
                    }]
                };

                var chart = new ApexCharts(chartElement, options);
                chart.render();
            }
        });
    </script>

    <!-- script grafik pendidikan -->
    <script>
        const el = document.querySelector('#pendidikanChart');
    
        const tidak = parseInt(el.dataset.tidak);
        const sd = parseInt(el.dataset.sd);
        const smp = parseInt(el.dataset.smp);
        const sma = parseInt(el.dataset.sma);
        const diploma = parseInt(el.dataset.diploma);
    
        var options = {
            series: [{
                name: 'Jumlah',
                data: [tidak, sd, smp, sma, diploma]
            }],
            chart: {
                type: 'bar',
                height: 360
            },
            plotOptions: {
                bar: {
                    borderRadius: 5,
                    columnWidth: '45%'
                }
            },
            dataLabels: {
                enabled: false
            },
            xaxis: {
                categories: [
                    'Tidak Sekolah',
                    'SD',
                    'SMP',
                    'SMA',
                    'Diploma / Sarjana'
                ]
            },
            colors: ['#10b981'],
            legend: {
                show: false
            }
        };
    
        new ApexCharts(el, options).render();
    </script>
    

    <!-- script grafik pekerjaan -->
    <script>
        const chartEl = document.querySelector("#pekerjaanChart");
    
        const petani = parseInt(chartEl.dataset.petani);
        const buruh = parseInt(chartEl.dataset.buruh);
        const wiraswasta = parseInt(chartEl.dataset.wiraswasta);
        const pns = parseInt(chartEl.dataset.pns);
    
        var pekerjaanOptions = {
            series: [{
                name: 'Jumlah',
                data: [petani, buruh, wiraswasta, pns]
            }],
            chart: {
                type: 'bar',
                height: 360
            },
            colors: ['#3b82f6'],
            plotOptions: {
                bar: {
                    borderRadius: 5,
                    horizontal: false,
                    columnWidth: '45%'
                }
            },
            dataLabels: {
                enabled: false
            },
            xaxis: {
                categories: ["Petani", "Buruh", "Wiraswasta", "PNS"]
            },
            legend: {
                show: false
            }
        };
    
        var pekerjaanChart = new ApexCharts(chartEl, pekerjaanOptions);
        pekerjaanChart.render();
    </script>
    


    <!-- script grafik agama -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const chartElement = document.getElementById('agamaChart');
            
            if (chartElement) {
                // Ambil data dari data attributes
                const islam = parseInt(chartElement.dataset.islam) || 0;
                const kristen = parseInt(chartElement.dataset.kristen) || 0;
                const hindu = parseInt(chartElement.dataset.hindu) || 0;
                const budha = parseInt(chartElement.dataset.budha) || 0;
                const katolik = parseInt(chartElement.dataset.katolik) || 0;
                const konghucu = parseInt(chartElement.dataset.konghucu) || 0;
                
                // Filter data yang > 0
                const seriesData = [];
                const labelsData = [];
                const colorsData = [];
                
                const religions = [
                    { name: 'Islam', value: islam, color: '#10b981' },
                    { name: 'Kristen', value: kristen, color: '#3b82f6' },
                    { name: 'Katolik', value: katolik, color: '#8b5cf6' },
                    { name: 'Hindu', value: hindu, color: '#f59e0b' },
                    { name: 'Budha', value: budha, color: '#ef4444' },
                    { name: 'Konghucu', value: konghucu, color: '#ec4899' }
                ];
                
                religions.forEach(religion => {
                    if (religion.value > 0) {
                        seriesData.push(religion.value);
                        labelsData.push(religion.name);
                        colorsData.push(religion.color);
                    }
                });
                
                // Hitung total
                const total = seriesData.reduce((a, b) => a + b, 0);
                
                var options = {
                    series: seriesData,
                    labels: labelsData,
                    colors: colorsData,
                    chart: { 
                        type: "pie", 
                        height: 360 
                    },
                    legend: { 
                        position: "bottom",
                        fontSize: '14px',
                        fontFamily: 'inherit',
                        markers: {
                            width: 12,
                            height: 12,
                            radius: 2
                        }
                    },
                    dataLabels: {
                        enabled: true,
                        formatter: function (val, opts) {
                            const value = opts.w.config.series[opts.seriesIndex];
                            return value + ' (' + val.toFixed(1) + '%)';
                        },
                        style: {
                            fontSize: '12px',
                            fontWeight: 'bold'
                        },
                        dropShadow: {
                            enabled: false
                        }
                    },
                    plotOptions: {
                        pie: {
                            expandOnClick: true,
                            dataLabels: {
                                offset: -10
                            }
                        }
                    },
                    tooltip: {
                        y: {
                            formatter: function(val) {
                                const percentage = ((val / total) * 100).toFixed(1);
                                return val + ' orang (' + percentage + '%)';
                            }
                        }
                    },
                    responsive: [{
                        breakpoint: 480,
                        options: {
                            chart: {
                                height: 300
                            },
                            legend: {
                                position: 'bottom'
                            }
                        }
                    }]
                };
        
                var chart = new ApexCharts(chartElement, options);
                chart.render();
            }
        });
        </script>
        

    @stack('scripts')
</body>

</html>
