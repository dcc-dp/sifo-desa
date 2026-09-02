@extends('layouts.user')

@section('title', 'Data Statistik Pendidikan | Sistem Informasi Desa')

@section('content')

    @php
        $setting = \App\Models\Setting::first();
        $desaName = (!empty($setting?->nama_desa)) ? $setting->nama_desa : 'Rante Gola';
    @endphp

    {{-- 1. Standard Page Hero Header --}}
    <section class="page-hero-header">
        <div class="container">
            <div class="page-hero-eyebrow">
                <i class="fas fa-graduation-cap"></i>
                <span>Data & Statistik • Pendidikan</span>
            </div>
            <h1 class="page-hero-title">Statistik Tingkat Pendidikan</h1>
            <p class="page-hero-desc">Visualisasi jenjang pendidikan formal yang ditempuh oleh warga Desa {{ $desaName }}, mulai dari tingkat dasar hingga pendidikan tinggi.</p>
            <div class="page-hero-divider"></div>
            
            <div class="page-breadcrumbs">
                <a href="{{ route('home') }}"><i class="fas fa-home me-1"></i>Home</a>
                <span class="sep">/</span>
                <span>Data Statistik</span>
                <span class="sep">/</span>
                <span class="current">Statistik Pendidikan</span>
            </div>
        </div>
    </section>

    {{-- 2. Content Section --}}
    <section class="profile-content-section">
        <div class="profile-content-container">

            {{-- Metric Stats Cards Grid --}}
            <div class="stats-metric-grid" style="grid-template-columns: repeat(auto-fit, minmax(190px, 1fr));">
                <div class="stats-metric-card">
                    <div class="stats-metric-icon stats-icon-amber">
                        <i class="fas fa-user-times"></i>
                    </div>
                    <div class="stats-metric-info">
                        <div class="stats-metric-title">Tidak Sekolah</div>
                        <div class="stats-metric-value">{{ number_format($tidakSekolah) }} <span class="fs-6 fw-normal text-muted">Jiwa</span></div>
                    </div>
                </div>

                <div class="stats-metric-card">
                    <div class="stats-metric-icon stats-icon-blue">
                        <i class="fas fa-school"></i>
                    </div>
                    <div class="stats-metric-info">
                        <div class="stats-metric-title">SD / Sederajat</div>
                        <div class="stats-metric-value">{{ number_format($sd) }} <span class="fs-6 fw-normal text-muted">Jiwa</span></div>
                    </div>
                </div>

                <div class="stats-metric-card">
                    <div class="stats-metric-icon stats-icon-teal">
                        <i class="fas fa-book-open"></i>
                    </div>
                    <div class="stats-metric-info">
                        <div class="stats-metric-title">SMP / Sederajat</div>
                        <div class="stats-metric-value">{{ number_format($smp) }} <span class="fs-6 fw-normal text-muted">Jiwa</span></div>
                    </div>
                </div>

                <div class="stats-metric-card">
                    <div class="stats-metric-icon stats-icon-purple">
                        <i class="fas fa-graduation-cap"></i>
                    </div>
                    <div class="stats-metric-info">
                        <div class="stats-metric-title">SMA / Sederajat</div>
                        <div class="stats-metric-value">{{ number_format($sma) }} <span class="fs-6 fw-normal text-muted">Jiwa</span></div>
                    </div>
                </div>

                <div class="stats-metric-card">
                    <div class="stats-metric-icon stats-icon-emerald">
                        <i class="fas fa-user-graduate"></i>
                    </div>
                    <div class="stats-metric-info">
                        <div class="stats-metric-title">Diploma / S1</div>
                        <div class="stats-metric-value">{{ number_format($diploma) }} <span class="fs-6 fw-normal text-muted">Jiwa</span></div>
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
                                <i class="fas fa-chart-bar"></i>
                                <span>Grafik Jenjang Pendidikan</span>
                            </h2>
                            <span class="chart-badge-total">
                                <i class="fas fa-graduation-cap"></i>
                                <span>{{ number_format($total) }} Total Terdata</span>
                            </span>
                        </div>

                        {{-- Chart Container --}}
                        <div id="pendidikanChart"
                             data-tidak="{{ $tidakSekolah }}"
                             data-sd="{{ $sd }}"
                             data-smp="{{ $smp }}"
                             data-sma="{{ $sma }}"
                             data-diploma="{{ $diploma }}"
                             style="min-height: 380px;">
                        </div>

                        {{-- Breakdown Info Cards Below Chart --}}
                        <div class="chart-breakdown-grid">
                            <div class="chart-breakdown-item">
                                <div class="chart-breakdown-label text-warning">Tidak Sekolah</div>
                                <div class="chart-breakdown-val">{{ number_format($tidakSekolah) }}</div>
                            </div>
                            <div class="chart-breakdown-item">
                                <div class="chart-breakdown-label text-primary">SD</div>
                                <div class="chart-breakdown-val">{{ number_format($sd) }}</div>
                            </div>
                            <div class="chart-breakdown-item">
                                <div class="chart-breakdown-label text-info">SMP</div>
                                <div class="chart-breakdown-val">{{ number_format($smp) }}</div>
                            </div>
                            <div class="chart-breakdown-item">
                                <div class="chart-breakdown-label text-purple" style="color: #9333ea;">SMA</div>
                                <div class="chart-breakdown-val">{{ number_format($sma) }}</div>
                            </div>
                            <div class="chart-breakdown-item">
                                <div class="chart-breakdown-label text-success">Diploma / S1</div>
                                <div class="chart-breakdown-val">{{ number_format($diploma) }}</div>
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

                        <form method="GET" action="{{ route('user.statistik.pendidikan') }}">
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
                                <a href="{{ route('user.statistik.pendidikan') }}" class="filter-reset-link">
                                    <i class="fas fa-times-circle me-1"></i>Reset Filter Wilayah
                                </a>
                            @endif
                        </form>

                        <div class="filter-info-box">
                            <i class="fas fa-info-circle fs-5 mt-1"></i>
                            <div>
                                Filter berdasarkan RW atau RT untuk melihat data jenjang pendidikan pada tingkatan wilayah tertentu.
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
        const el = document.querySelector('#pendidikanChart');
        if (!el) return;

        const tidak = parseInt(el.dataset.tidak) || 0;
        const sd = parseInt(el.dataset.sd) || 0;
        const smp = parseInt(el.dataset.smp) || 0;
        const sma = parseInt(el.dataset.sma) || 0;
        const diploma = parseInt(el.dataset.diploma) || 0;
        const total = tidak + sd + smp + sma + diploma;

        if (total === 0) {
            el.innerHTML = `
                <div class="d-flex flex-column align-items-center justify-content-center h-100 py-5 text-center text-muted">
                    <i class="fas fa-user-graduate mb-3" style="font-size: 3rem; opacity: 0.35;"></i>
                    <h5 class="fw-bold">Belum Ada Data Pendidikan</h5>
                    <p class="small mb-0">Tidak ada data pendidikan yang sesuai dengan filter wilayah yang dipilih.</p>
                </div>
            `;
            return;
        }

        const options = {
            series: [{
                name: 'Jumlah Penduduk',
                data: [tidak, sd, smp, sma, diploma]
            }],
            chart: {
                type: 'bar',
                height: 380,
                toolbar: { show: false },
                fontFamily: 'inherit'
            },
            plotOptions: {
                bar: {
                    borderRadius: 6,
                    columnWidth: '45%',
                    distributed: true,
                    dataLabels: {
                        position: 'top'
                    }
                }
            },
            colors: ['#f59e0b', '#3b82f6', '#0d9488', '#8b5cf6', '#10b981'],
            dataLabels: {
                enabled: true,
                formatter: function (val) {
                    return val + ' Jiwa';
                },
                offsetY: -20,
                style: {
                    fontSize: '12px',
                    fontWeight: 700,
                    colors: ['#475569']
                }
            },
            xaxis: {
                categories: [
                    'Tidak Sekolah',
                    'SD / Sederajat',
                    'SMP / Sederajat',
                    'SMA / Sederajat',
                    'Diploma / S1'
                ],
                labels: {
                    style: {
                        fontSize: '12px',
                        fontWeight: 600
                    }
                },
                axisBorder: { show: false },
                axisTicks: { show: false }
            },
            yaxis: {
                labels: {
                    formatter: function (val) {
                        return Math.round(val);
                    }
                },
                title: {
                    text: 'Jumlah Jiwa',
                    style: {
                        color: '#94a3b8',
                        fontSize: '12px'
                    }
                }
            },
            legend: { show: false },
            grid: {
                borderColor: '#f1f5f9',
                strokeDashArray: 4
            },
            tooltip: {
                y: {
                    formatter: function (val) {
                        const pct = total > 0 ? ((val / total) * 100).toFixed(1) : 0;
                        return val.toLocaleString('id-ID') + ' Jiwa (' + pct + '%)';
                    }
                }
            }
        };

        const chart = new ApexCharts(el, options);
        chart.render();
    });
</script>
@endpush
