@extends('layouts.user')

@section('title', 'Data Statistik Pekerjaan | Sistem Informasi Desa')

@section('content')

    @php
        $setting = \App\Models\Setting::first();
        $desaName = (!empty($setting?->nama_desa)) ? $setting->nama_desa : 'Rante Gola';
        $topProfesi = $statistikPekerjaan->first();
    @endphp

    {{-- 1. Standard Page Hero Header --}}
    <section class="page-hero-header">
        <div class="container">
            <div class="page-hero-eyebrow">
                <i class="fas fa-briefcase"></i>
                <span>Data & Statistik • Pekerjaan</span>
            </div>
            <h1 class="page-hero-title">Statistik Mata Pencaharian & Profesi</h1>
            <p class="page-hero-desc">Distribusi mata pencaharian dan ragam profesi penduduk produktif Desa {{ $desaName }} untuk pemetaan potensi ekonomi kemasyarakatan.</p>
            <div class="page-hero-divider"></div>
            
            <div class="page-breadcrumbs">
                <a href="{{ route('home') }}"><i class="fas fa-home me-1"></i>Home</a>
                <span class="sep">/</span>
                <span>Data Statistik</span>
                <span class="sep">/</span>
                <span class="current">Statistik Pekerjaan</span>
            </div>
        </div>
    </section>

    {{-- 2. Content Section --}}
    <section class="profile-content-section">
        <div class="profile-content-container">

            {{-- Metric Stats Cards Grid --}}
            <div class="stats-metric-grid" style="grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));">
                <div class="stats-metric-card">
                    <div class="stats-metric-icon stats-icon-blue">
                        <i class="fas fa-users-cog"></i>
                    </div>
                    <div class="stats-metric-info">
                        <div class="stats-metric-title">Total Penduduk Terdata</div>
                        <div class="stats-metric-value">{{ number_format($total) }} <span class="fs-6 fw-normal text-muted">Jiwa</span></div>
                    </div>
                </div>

                <div class="stats-metric-card">
                    <div class="stats-metric-icon stats-icon-emerald">
                        <i class="fas fa-briefcase"></i>
                    </div>
                    <div class="stats-metric-info">
                        <div class="stats-metric-title">Ragam Profesi</div>
                        <div class="stats-metric-value">{{ $statistikPekerjaan->count() }} <span class="fs-6 fw-normal text-muted">Kategori</span></div>
                    </div>
                </div>

                <div class="stats-metric-card">
                    <div class="stats-metric-icon stats-icon-amber">
                        <i class="fas fa-chart-line"></i>
                    </div>
                    <div class="stats-metric-info">
                        <div class="stats-metric-title">Profesi Terbanyak</div>
                        <div class="stats-metric-value text-truncate" style="max-width: 200px; font-size: 1.35rem;" title="{{ $topProfesi?->pekerjaan ?? '-' }}">
                            {{ $topProfesi?->pekerjaan ?? '-' }}
                        </div>
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
                                <span>Grafik Jumlah Berdasarkan Profesi</span>
                            </h2>
                            <span class="chart-badge-total">
                                <i class="fas fa-briefcase"></i>
                                <span>{{ number_format($total) }} Jiwa Terdata</span>
                            </span>
                        </div>

                        {{-- Chart Container --}}
                        <div id="pekerjaanChart"
                             data-labels='@json($statistikPekerjaan->pluck("pekerjaan"))'
                             data-values='@json($statistikPekerjaan->pluck("total"))'
                             style="min-height: 380px;">
                        </div>

                        {{-- Breakdown Info Cards Below Chart --}}
                        @if($statistikPekerjaan->count() > 0)
                            <div class="chart-breakdown-grid">
                                @foreach($statistikPekerjaan as $item)
                                    <div class="chart-breakdown-item">
                                        <div class="chart-breakdown-label text-truncate" title="{{ $item->pekerjaan }}">
                                            {{ $item->pekerjaan }}
                                        </div>
                                        <div class="chart-breakdown-val">
                                            {{ number_format($item->total) }} <span class="fs-7 text-muted">Jiwa</span>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif
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

                        <form method="GET" action="{{ route('user.statistik.pekerjaan') }}">
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
                                <a href="{{ route('user.statistik.pekerjaan') }}" class="filter-reset-link">
                                    <i class="fas fa-times-circle me-1"></i>Reset Filter Wilayah
                                </a>
                            @endif
                        </form>

                        <div class="filter-info-box">
                            <i class="fas fa-info-circle fs-5 mt-1"></i>
                            <div>
                                Filter wilayah untuk melihat variasi mata pencaharian penduduk berdasarkan RW atau RT tertentu.
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
        const chartEl = document.querySelector("#pekerjaanChart");
        if (!chartEl) return;

        let labels = [];
        let values = [];
        try {
            labels = JSON.parse(chartEl.dataset.labels || '[]');
            values = JSON.parse(chartEl.dataset.values || '[]');
        } catch (e) {
            console.error("Error parsing pekerjaan data", e);
        }

        const total = values.reduce((a, b) => a + b, 0);

        if (!values || values.length === 0 || total === 0) {
            chartEl.innerHTML = `
                <div class="d-flex flex-column align-items-center justify-content-center h-100 py-5 text-center text-muted">
                    <i class="fas fa-briefcase mb-3" style="font-size: 3rem; opacity: 0.35;"></i>
                    <h5 class="fw-bold">Belum Ada Data Pekerjaan</h5>
                    <p class="small mb-0">Tidak ada data profesi yang sesuai dengan filter wilayah yang dipilih.</p>
                </div>
            `;
            return;
        }

        const options = {
            series: [{
                name: 'Jumlah Jiwa',
                data: values
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
                    horizontal: labels.length > 5,
                    columnWidth: '45%',
                    dataLabels: {
                        position: labels.length > 5 ? 'right' : 'top'
                    }
                }
            },
            colors: ['#0284c7'],
            dataLabels: {
                enabled: true,
                formatter: function (val) {
                    return val + ' Jiwa';
                },
                offsetY: labels.length > 5 ? 0 : -20,
                offsetX: labels.length > 5 ? 10 : 0,
                style: {
                    fontSize: '12px',
                    fontWeight: 700,
                    colors: ['#475569']
                }
            },
            xaxis: {
                categories: labels,
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
                }
            },
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

        const chart = new ApexCharts(chartEl, options);
        chart.render();
    });
</script>
@endpush