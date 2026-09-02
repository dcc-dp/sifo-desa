@extends('layouts.user')

@section('title', 'Data Statistik Penduduk | Sistem Informasi Desa')

@section('content')

    @php
        $setting = \App\Models\Setting::first();
        $desaName = (!empty($setting?->nama_desa)) ? $setting->nama_desa : 'Rante Gola';
        $pctLaki = $totalPenduduk > 0 ? round(($laki / $totalPenduduk) * 100, 1) : 0;
        $pctPerempuan = $totalPenduduk > 0 ? round(($perempuan / $totalPenduduk) * 100, 1) : 0;
    @endphp

    {{-- 1. Standard Page Hero Header --}}
    <section class="page-hero-header">
        <div class="container">
            <div class="page-hero-eyebrow">
                <i class="fas fa-chart-pie"></i>
                <span>Data & Statistik • Kependudukan</span>
            </div>
            <h1 class="page-hero-title">Statistik Demografi & Penduduk</h1>
            <p class="page-hero-desc">Data komposisi penduduk Desa {{ $desaName }} berdasarkan jenis kelamin dan persebaran wilayah RT / RW secara aktual.</p>
            <div class="page-hero-divider"></div>
            
            <div class="page-breadcrumbs">
                <a href="{{ route('home') }}"><i class="fas fa-home me-1"></i>Home</a>
                <span class="sep">/</span>
                <span>Data Statistik</span>
                <span class="sep">/</span>
                <span class="current">Statistik Penduduk</span>
            </div>
        </div>
    </section>

    {{-- 2. Content Section --}}
    <section class="profile-content-section">
        <div class="profile-content-container">

            {{-- Metric Stats Cards Grid --}}
            <div class="stats-metric-grid">
                <div class="stats-metric-card">
                    <div class="stats-metric-icon stats-icon-emerald">
                        <i class="fas fa-users"></i>
                    </div>
                    <div class="stats-metric-info">
                        <div class="stats-metric-title">Total Penduduk</div>
                        <div class="stats-metric-value">{{ number_format($totalPenduduk) }} <span class="fs-6 fw-normal text-muted">Jiwa</span></div>
                    </div>
                </div>

                <div class="stats-metric-card">
                    <div class="stats-metric-icon stats-icon-blue">
                        <i class="fas fa-mars"></i>
                    </div>
                    <div class="stats-metric-info">
                        <div class="stats-metric-title">Laki-Laki</div>
                        <div class="stats-metric-value">{{ number_format($laki) }} <span class="fs-6 fw-normal text-muted">Jiwa ({{ $pctLaki }}%)</span></div>
                    </div>
                </div>

                <div class="stats-metric-card">
                    <div class="stats-metric-icon stats-icon-pink">
                        <i class="fas fa-venus"></i>
                    </div>
                    <div class="stats-metric-info">
                        <div class="stats-metric-title">Perempuan</div>
                        <div class="stats-metric-value">{{ number_format($perempuan) }} <span class="fs-6 fw-normal text-muted">Jiwa ({{ $pctPerempuan }}%)</span></div>
                    </div>
                </div>
            </div>

            {{-- Main Chart & Filter Row --}}
            <div class="row g-4 align-items-start">

                {{-- Left: Chart Box --}}
                <div class="col-lg-8">
                    <div class="chart-card-box">
                        <div class="chart-card-header">
                            <h2 class="chart-card-title">
                                <i class="fas fa-chart-donut"></i>
                                <span>Grafik Komposisi Jenis Kelamin</span>
                            </h2>
                            <span class="chart-badge-total">
                                <i class="fas fa-users"></i>
                                <span>{{ number_format($totalPenduduk) }} Jiwa Terdata</span>
                            </span>
                        </div>

                        {{-- Chart Container --}}
                        <div id="pendudukChart"
                             data-laki="{{ $laki }}"
                             data-perempuan="{{ $perempuan }}"
                             data-total="{{ $totalPenduduk }}"
                             style="min-height: 380px;">
                        </div>

                        {{-- Breakdown Info Cards Below Chart --}}
                        <div class="chart-breakdown-grid">
                            <div class="chart-breakdown-item">
                                <div class="chart-breakdown-label text-success">Total Penduduk</div>
                                <div class="chart-breakdown-val">{{ number_format($totalPenduduk) }}</div>
                            </div>
                            <div class="chart-breakdown-item">
                                <div class="chart-breakdown-label text-primary">Laki-Laki</div>
                                <div class="chart-breakdown-val">{{ number_format($laki) }} <span class="fs-7 text-muted">({{ $pctLaki }}%)</span></div>
                            </div>
                            <div class="chart-breakdown-item">
                                <div class="chart-breakdown-label text-danger">Perempuan</div>
                                <div class="chart-breakdown-val">{{ number_format($perempuan) }} <span class="fs-7 text-muted">({{ $pctPerempuan }}%)</span></div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Right: Filter Box --}}
                <div class="col-lg-4">
                    <div class="filter-card-box">
                        <h3 class="filter-header-title">
                            <div class="filter-header-icon">
                                <i class="fas fa-filter"></i>
                            </div>
                            <span>Filter Wilayah</span>
                        </h3>

                        <form method="GET" action="{{ route('user.statistik.penduduk') }}">
                            <div class="filter-form-group">
                                <label class="filter-form-label">
                                    <i class="fas fa-map-marker-alt text-success"></i>
                                    <span>Pilih RW</span>
                                </label>
                                <select name="rw" class="filter-select-modern" onchange="this.form.submit()">
                                    <option value="">-- Semua RW --</option>
                                    @foreach($rwList as $item)
                                        <option value="{{ $item->id }}" {{ request('rw') == $item->id ? 'selected' : '' }}>
                                            RW {{ $item->nomor_rw }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="filter-form-group">
                                <label class="filter-form-label">
                                    <i class="fas fa-map-pin text-success"></i>
                                    <span>Pilih RT</span>
                                </label>
                                <select name="rt" class="filter-select-modern">
                                    <option value="">-- Semua RT --</option>
                                    @foreach($rtList as $item)
                                        <option value="{{ $item->id }}" {{ request('rt') == $item->id ? 'selected' : '' }}>
                                            RT {{ $item->nomor_rt }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <button type="submit" class="filter-btn-submit">
                                <i class="fas fa-check"></i>
                                <span>Terapkan Filter</span>
                            </button>

                            @if(request('rw') || request('rt'))
                                <a href="{{ route('user.statistik.penduduk') }}" class="filter-reset-link">
                                    <i class="fas fa-times-circle me-1"></i>Reset Filter Wilayah
                                </a>
                            @endif
                        </form>

                        <div class="filter-info-box">
                            <i class="fas fa-info-circle fs-5 mt-1"></i>
                            <div>
                                Pilih RW untuk memfilter daftar RT di bawahnya dan memperbarui visualisasi grafik secara spesifik per wilayah.
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </section>

@endsection

@push('scripts')
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const chartEl = document.querySelector("#pendudukChart");
        if (!chartEl) return;

        const laki = parseInt(chartEl.dataset.laki) || 0;
        const perempuan = parseInt(chartEl.dataset.perempuan) || 0;
        const total = laki + perempuan;

        if (total === 0) {
            chartEl.innerHTML = `
                <div class="d-flex flex-column align-items-center justify-content-center h-100 py-5 text-center text-muted">
                    <i class="fas fa-users-slash mb-3" style="font-size: 3rem; opacity: 0.35;"></i>
                    <h5 class="fw-bold">Belum Ada Data Penduduk</h5>
                    <p class="small mb-0">Tidak ada data kependudukan yang sesuai dengan filter wilayah yang dipilih.</p>
                </div>
            `;
            return;
        }

        const options = {
            series: [laki, perempuan],
            labels: ['Laki-Laki', 'Perempuan'],
            colors: ['#0284c7', '#ec4899'],
            chart: {
                type: 'donut',
                height: 380,
                fontFamily: 'inherit'
            },
            stroke: {
                width: 3,
                colors: ['#ffffff']
            },
            legend: {
                position: 'bottom',
                fontSize: '14px',
                markers: {
                    width: 12,
                    height: 12,
                    radius: 4
                },
                itemMargin: {
                    horizontal: 14,
                    vertical: 8
                }
            },
            dataLabels: {
                enabled: true,
                formatter: function (val) {
                    return val.toFixed(1) + '%';
                },
                style: {
                    fontSize: '13px',
                    fontWeight: 700
                },
                dropShadow: {
                    enabled: false
                }
            },
            plotOptions: {
                pie: {
                    donut: {
                        size: '68%',
                        labels: {
                            show: true,
                            name: {
                                show: true,
                                fontSize: '15px',
                                fontWeight: 600,
                                color: '#64748b'
                            },
                            value: {
                                show: true,
                                fontSize: '24px',
                                fontWeight: 800,
                                color: '#1e293b',
                                formatter: function (val) {
                                    return parseInt(val).toLocaleString('id-ID') + ' Jiwa';
                                }
                            },
                            total: {
                                show: true,
                                label: 'Total Penduduk',
                                fontSize: '14px',
                                fontWeight: 600,
                                color: '#64748b',
                                formatter: function () {
                                    return total.toLocaleString('id-ID') + ' Jiwa';
                                }
                            }
                        }
                    }
                }
            },
            tooltip: {
                y: {
                    formatter: function (val) {
                        const pct = ((val / total) * 100).toFixed(1);
                        return val.toLocaleString('id-ID') + ' Jiwa (' + pct + '%)';
                    }
                }
            },
            responsive: [{
                breakpoint: 480,
                options: {
                    chart: {
                        height: 320
                    },
                    legend: {
                        position: 'bottom'
                    }
                }
            }]
        };

        const chart = new ApexCharts(chartEl, options);
        chart.render();
    });
</script>
@endpush
