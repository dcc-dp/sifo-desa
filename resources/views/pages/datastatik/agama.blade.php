@extends('layouts.user')

@section('title', 'Data Statistik Agama | Sistem Informasi Desa')

@section('content')

    @php
        $setting = \App\Models\Setting::first();
        $desaName = (!empty($setting?->nama_desa)) ? $setting->nama_desa : 'Rante Gola';
        $totalAgama = $islam + $kristen + $katolik + $hindu + $budha + $konghucu;
    @endphp

    {{-- 1. Standard Page Hero Header --}}
    <section class="page-hero-header">
        <div class="container">
            <div class="page-hero-eyebrow">
                <i class="fas fa-place-of-worship"></i>
                <span>Data & Statistik • Keberagaman</span>
            </div>
            <h1 class="page-hero-title">Statistik Keberagaman Agama</h1>
            <p class="page-hero-desc">Informasi sebaran pemeluk agama dan kepercayaan masyarakat Desa {{ $desaName }} yang menjunjung tinggi toleransi dan kerukunan.</p>
            <div class="page-hero-divider"></div>
            
            <div class="page-breadcrumbs">
                <a href="{{ route('home') }}"><i class="fas fa-home me-1"></i>Home</a>
                <span class="sep">/</span>
                <span>Data Statistik</span>
                <span class="sep">/</span>
                <span class="current">Statistik Agama</span>
            </div>
        </div>
    </section>

    {{-- 2. Content Section --}}
    <section class="profile-content-section">
        <div class="profile-content-container">

            {{-- Metric Stats Cards Grid --}}
            <div class="stats-metric-grid" style="grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));">
                <div class="stats-metric-card">
                    <div class="stats-metric-icon stats-icon-emerald">
                        <i class="fas fa-mosque"></i>
                    </div>
                    <div class="stats-metric-info">
                        <div class="stats-metric-title">Islam</div>
                        <div class="stats-metric-value">{{ number_format($islam) }} <span class="fs-6 fw-normal text-muted">Jiwa</span></div>
                    </div>
                </div>

                <div class="stats-metric-card">
                    <div class="stats-metric-icon stats-icon-blue">
                        <i class="fas fa-church"></i>
                    </div>
                    <div class="stats-metric-info">
                        <div class="stats-metric-title">Kristen</div>
                        <div class="stats-metric-value">{{ number_format($kristen) }} <span class="fs-6 fw-normal text-muted">Jiwa</span></div>
                    </div>
                </div>

                <div class="stats-metric-card">
                    <div class="stats-metric-icon stats-icon-purple">
                        <i class="fas fa-cross"></i>
                    </div>
                    <div class="stats-metric-info">
                        <div class="stats-metric-title">Katolik</div>
                        <div class="stats-metric-value">{{ number_format($katolik) }} <span class="fs-6 fw-normal text-muted">Jiwa</span></div>
                    </div>
                </div>

                <div class="stats-metric-card">
                    <div class="stats-metric-icon stats-icon-amber">
                        <i class="fas fa-om"></i>
                    </div>
                    <div class="stats-metric-info">
                        <div class="stats-metric-title">Hindu</div>
                        <div class="stats-metric-value">{{ number_format($hindu) }} <span class="fs-6 fw-normal text-muted">Jiwa</span></div>
                    </div>
                </div>

                <div class="stats-metric-card">
                    <div class="stats-metric-icon stats-icon-teal">
                        <i class="fas fa-dharmachakra"></i>
                    </div>
                    <div class="stats-metric-info">
                        <div class="stats-metric-title">Budha</div>
                        <div class="stats-metric-value">{{ number_format($budha) }} <span class="fs-6 fw-normal text-muted">Jiwa</span></div>
                    </div>
                </div>

                <div class="stats-metric-card">
                    <div class="stats-metric-icon stats-icon-pink">
                        <i class="fas fa-yin-yang"></i>
                    </div>
                    <div class="stats-metric-info">
                        <div class="stats-metric-title">Konghucu</div>
                        <div class="stats-metric-value">{{ number_format($konghucu) }} <span class="fs-6 fw-normal text-muted">Jiwa</span></div>
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
                                <i class="fas fa-chart-pie"></i>
                                <span>Grafik Komposisi Pemeluk Agama</span>
                            </h2>
                            <span class="chart-badge-total">
                                <i class="fas fa-place-of-worship"></i>
                                <span>{{ number_format($totalAgama) }} Jiwa Terdata</span>
                            </span>
                        </div>

                        {{-- Chart Container --}}
                        <div id="agamaChart"
                             data-islam="{{ $islam }}"
                             data-kristen="{{ $kristen }}"
                             data-katolik="{{ $katolik }}"
                             data-hindu="{{ $hindu }}"
                             data-budha="{{ $budha }}"
                             data-konghucu="{{ $konghucu }}"
                             style="min-height: 380px;">
                        </div>

                        {{-- Breakdown Info Cards Below Chart --}}
                        <div class="chart-breakdown-grid">
                            <div class="chart-breakdown-item">
                                <div class="chart-breakdown-label text-success">Islam</div>
                                <div class="chart-breakdown-val">{{ number_format($islam) }}</div>
                            </div>
                            <div class="chart-breakdown-item">
                                <div class="chart-breakdown-label text-primary">Kristen</div>
                                <div class="chart-breakdown-val">{{ number_format($kristen) }}</div>
                            </div>
                            <div class="chart-breakdown-item">
                                <div class="chart-breakdown-label text-purple" style="color: #9333ea;">Katolik</div>
                                <div class="chart-breakdown-val">{{ number_format($katolik) }}</div>
                            </div>
                            <div class="chart-breakdown-item">
                                <div class="chart-breakdown-label text-warning">Hindu</div>
                                <div class="chart-breakdown-val">{{ number_format($hindu) }}</div>
                            </div>
                            <div class="chart-breakdown-item">
                                <div class="chart-breakdown-label text-info">Budha</div>
                                <div class="chart-breakdown-val">{{ number_format($budha) }}</div>
                            </div>
                            <div class="chart-breakdown-item">
                                <div class="chart-breakdown-label text-danger">Konghucu</div>
                                <div class="chart-breakdown-val">{{ number_format($konghucu) }}</div>
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

                        <form method="GET" action="{{ route('user.statistik.agama') }}">
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
                                <a href="{{ route('user.statistik.agama') }}" class="filter-reset-link">
                                    <i class="fas fa-times-circle me-1"></i>Reset Filter Wilayah
                                </a>
                            @endif
                        </form>

                        <div class="filter-info-box">
                            <i class="fas fa-info-circle fs-5 mt-1"></i>
                            <div>
                                Filter wilayah untuk melihat data pemeluk agama pada tingkatan RW atau RT yang dipilih.
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
        const chartEl = document.querySelector("#agamaChart");
        if (!chartEl) return;

        const islam = parseInt(chartEl.dataset.islam) || 0;
        const kristen = parseInt(chartEl.dataset.kristen) || 0;
        const katolik = parseInt(chartEl.dataset.katolik) || 0;
        const hindu = parseInt(chartEl.dataset.hindu) || 0;
        const budha = parseInt(chartEl.dataset.budha) || 0;
        const konghucu = parseInt(chartEl.dataset.konghucu) || 0;

        const total = islam + kristen + katolik + hindu + budha + konghucu;

        if (total === 0) {
            chartEl.innerHTML = `
                <div class="d-flex flex-column align-items-center justify-content-center h-100 py-5 text-center text-muted">
                    <i class="fas fa-place-of-worship mb-3" style="font-size: 3rem; opacity: 0.35;"></i>
                    <h5 class="fw-bold">Belum Ada Data Agama</h5>
                    <p class="small mb-0">Tidak ada data keagamaan yang sesuai dengan filter wilayah yang dipilih.</p>
                </div>
            `;
            return;
        }

        const religions = [
            { name: 'Islam', value: islam, color: '#10b981' },
            { name: 'Kristen', value: kristen, color: '#3b82f6' },
            { name: 'Katolik', value: katolik, color: '#8b5cf6' },
            { name: 'Hindu', value: hindu, color: '#f59e0b' },
            { name: 'Budha', value: budha, color: '#0d9488' },
            { name: 'Konghucu', value: konghucu, color: '#ec4899' }
        ];

        // Filter agama yang memiliki penganut > 0 agar grafik proporsional
        const activeReligions = religions.filter(r => r.value > 0);
        const seriesData = activeReligions.map(r => r.value);
        const labelsData = activeReligions.map(r => r.name);
        const colorsData = activeReligions.map(r => r.color);

        const options = {
            series: seriesData,
            labels: labelsData,
            colors: colorsData,
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
                                label: 'Total Pemeluk',
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
