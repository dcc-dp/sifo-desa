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
        var options = {
            series: [120, 340, 360, 28],
            labels: ["Kepala Keluarga", "Laki-Laki", "Perempuan", "Disabilitas"],
            colors: ["#ee1f1fff", "#3918f3ff", "#eeaee4ff", "#83f07bff"],
            chart: { type: "donut", height: 360 },
            legend: { position: "bottom" },
            dataLabels: {
                enabled: true,
                formatter: function (val) {
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
                                label: "Total",
                                formatter: () => "848"
                            }
                        }
                    }
                }
            }
        };

        var chart = new ApexCharts(document.querySelector("#pendudukChart"), options);
        chart.render();
    </script>


    <!-- script grafik pendidikan -->
    <script>
    var options = {
        series: [{
            name: 'Jumlah',
            data: [40, 180, 150, 210, 95]
        }],
        chart: {
            type: 'bar',
            height: 360
        },
        colors: ["#16a34a"],
        plotOptions: {
            bar: {
                borderRadius: 6,
                horizontal: false,
                columnWidth: '45%'
            }
        },
        dataLabels: {
            enabled: true
        },
        xaxis: {
            categories: [
                "Tidak Sekolah", 
                "SD", 
                "SMP", 
                "SMA", 
                "Diploma / Sarjana"
            ]
        },
        legend: {
            position: "bottom"
        }
    };

    var chart = new ApexCharts(
        document.querySelector("#pendidikanChart"), 
        options
    );
    chart.render();
</script>


<!-- script grafik pekerjaan -->
<script>
        var pekerjaanOptions = {
            series: [{
                name: 'Jumlah',
                data: [210, 140, 175, 38]
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
            dataLabels: { enabled: false },
            xaxis: {
                categories: ["Petani", "Buruh", "Wiraswasta", "PNS"]
            },
            legend: { show: false }
        };

        var pekerjaanChart = new ApexCharts(document.querySelector("#pekerjaanChart"), pekerjaanOptions);
        pekerjaanChart.render();
    </script>
    

    <!-- script grafik agama -->
    <script>
        var agamaOptions = {
            series: [680, 120, 45, 28],
            labels: ["Islam", "Kristen", "Hindu", "Budha"],
            chart: {
                type: 'pie',
                height: 360
            },
            colors: ["#3b82f6", "#22c55e", "#f97316", "#8b5cf6"],
            legend: {
                position: "bottom"
            },
            dataLabels: {
                enabled: true,
                formatter: function (value) {
                    return value.toFixed(1) + "%";
                }
            }
        };

        var agamaChart = new ApexCharts(document.querySelector("#agamaChart"), agamaOptions);
        agamaChart.render();
    </script>
</body>
</html>
