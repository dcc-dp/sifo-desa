@extends('layouts.user')

@section('title', 'Data Statistik Pekerjaan | Sistem Informasi Desa')

@section('content')

    <section>

        <div class="dashboard-container">
            <div class="dashboard-header mb-4">

                <h2>Statistik Pekerjaan</h2>

                <div class="header-right">
                    <a href="{{ route('home') }}">Dashboard</a>
                    <span>/</span>
                    <span>Statistik Pekerjaan</span>
                </div>

            </div>
            <div class="stats-grid">

                @foreach($statistikPekerjaan as $item)

                    <div class="stat-card">

                        <div class="stat-icon">
                            💼
                        </div>

                        <div class="stat-content">
                            <p class="stat-title">
                                {{ $item->pekerjaan }}
                            </p>

                            <p class="stat-value">
                                {{ $item->total }}
                            </p>
                        </div>

                    </div>

                @endforeach

            </div>

            <div class="row g-4 align-items-stretch">

                <div class="col-lg-8">

                    <div class="card shadow-sm border-0 h-100">

                        <div class="card-body">

                            <div class="d-flex justify-content-between align-items-center mb-4">

                                <h5 class="fw-bold mb-0">
                                    Grafik Jumlah Pekerjaan
                                </h5>

                                <span class="total-badge">
                                    💼 Statistik Pekerjaan
                                </span>

                            </div>

                            <div id="pekerjaanChart" data-labels='@json($statistikPekerjaan->pluck("pekerjaan"))'
                                data-values='@json($statistikPekerjaan->pluck("total"))' style="height:420px;">
                            </div>

                            <div class="row mt-4">

                                @foreach($statistikPekerjaan as $item)

                                    <div class="col-md-3 mb-3">

                                        <div class="summary-card">

                                            <h6>
                                                {{ $item->pekerjaan }}
                                            </h6>

                                            <h4>
                                                {{ $item->total }}
                                            </h4>

                                        </div>

                                    </div>

                                @endforeach

                            </div>

                        </div>

                    </div>

                </div>

                <div class="col-lg-4">

                    <div class="card shadow-sm border-0 h-100">

                        <div class="card-body">

                            <h5 class="fw-bold mb-4">
                                Filter Wilayah
                            </h5>

                            <form method="GET">

                                <div class="mb-4">

                                    <label class="form-label">
                                        RW
                                    </label>

                                    <select name="rw" class="form-select">

                                        <option value="">
                                            -- Pilih RW --
                                        </option>

                                        @foreach($rwList as $item)
                                            <option value="{{ $item->id }}" {{ request('rw') == $item->id ? 'selected' : '' }}>
                                                RW {{ $item->nomor_rw }}
                                            </option>
                                        @endforeach

                                    </select>

                                </div>

                                <div class="mb-4">

                                    <label class="form-label">
                                        RT
                                    </label>

                                    <select name="rt" class="form-select">

                                        <option value="">
                                            -- Semua RT --
                                        </option>

                                        @foreach($rtList as $item)
                                            <option value="{{ $item->id }}" {{ request('rt') == $item->id ? 'selected' : '' }}>
                                                RT {{ $item->nomor_rt }}
                                            </option>
                                        @endforeach

                                    </select>
                                </div>

                                <button class="btn btn-success w-100">
                                    Terapkan Filter
                                </button>

                            </form>

                            <div class="alert alert-success mt-4 mb-0">
                                Pilih RW dan RT untuk melihat data pekerjaan berdasarkan wilayah.
                            </div>

                        </div>

                    </div>

                </div>

            </div>


        </div>

    </section>
    
@endsection