@extends('layouts.user')

@section('title', 'Data Statistik Agama | Sistem Informasi Desa')

@section('content')

<section>

    <div class="dashboard-container">

        <div class="dashboard-header mb-4">

            
            <h2>Statistik Agama</h2>
          
        
            <div class="header-right">
                <a href="{{ route('home') }}">Dashboard</a>
                <span>/</span>
                <span>Statistik Agama</span>
            </div>
       
        
        </div>

        <div class="stats-grid">

            <div class="stat-card islam-card">
        
                <div class="stat-icon">
                    ☪️
                </div>
        
                <div class="stat-content">
                    <p class="stat-title">Islam</p>
                    <p class="stat-value">{{ $islam ?? 0 }}</p>
                </div>
        
            </div>
        
            <div class="stat-card kristen-card">
        
                <div class="stat-icon">
                    ✝️
                </div>
        
                <div class="stat-content">
                    <p class="stat-title">Kristen</p>
                    <p class="stat-value">{{ $kristen ?? 0 }}</p>
                </div>
        
            </div>
        
            <div class="stat-card hindu-card">
        
                <div class="stat-icon">
                    🕉️
                </div>
        
                <div class="stat-content">
                    <p class="stat-title">Hindu</p>
                    <p class="stat-value">{{ $hindu ?? 0 }}</p>
                </div>
        
            </div>
        
            <div class="stat-card budha-card">
        
                <div class="stat-icon">
                    ☸️
                </div>
        
                <div class="stat-content">
                    <p class="stat-title">Budha</p>
                    <p class="stat-value">{{ $budha ?? 0 }}</p>
                </div>
        
            </div>
        
            <div class="stat-card katolik-card">
        
                <div class="stat-icon">
                    ⛪
                </div>
        
                <div class="stat-content">
                    <p class="stat-title">Katolik</p>
                    <p class="stat-value">{{ $katolik ?? 0 }}</p>
                </div>
        
            </div>
        
            <div class="stat-card konghucu-card">
        
                <div class="stat-icon">
                    ☯️
                </div>
        
                <div class="stat-content">
                    <p class="stat-title">Konghucu</p>
                    <p class="stat-value">{{ $konghucu ?? 0 }}</p>
                </div>
        
            </div>
        
        </div>

        <div class="row g-4 align-items-stretch">

            <!-- Chart -->
            <div class="col-lg-8">
        
                <div class="card shadow-sm border-0 h-100">
        
                    <div class="card-body">
        
                        <div class="d-flex justify-content-between align-items-center mb-4">
        
                            <h5 class="fw-bold mb-0">
                                Grafik Jumlah Agama
                            </h5>
        
                            <span class="total-badge">
                                📊 Statistik Agama
                            </span>
        
                        </div>
        
                        <div
                            id="agamaChart"
                            data-islam="{{ $islam ?? 0 }}"
                            data-kristen="{{ $kristen ?? 0 }}"
                            data-hindu="{{ $hindu ?? 0 }}"
                            data-budha="{{ $budha ?? 0 }}"
                            data-katolik="{{ $katolik ?? 0 }}"
                            data-konghucu="{{ $konghucu ?? 0 }}"
                            style="height:420px;">
                        </div>
        
                        <!-- Ringkasan Statistik -->
                        <div class="row mt-4">
        
                            <div class="col-md-4">
                                <div class="summary-card">
                                    <h6 class="mb-2 text-success">
                                        Islam
                                    </h6>
        
                                    <h4>{{ $islam ?? 0 }}</h4>
                                </div>
                            </div>
        
                            <div class="col-md-4">
                                <div class="summary-card">
                                    <h6 class="mb-2 text-primary">
                                        Kristen
                                    </h6>
        
                                    <h4>{{ $kristen ?? 0 }}</h4>
                                </div>
                            </div>
        
                            <div class="col-md-4">
                                <div class="summary-card">
                                    <h6 class="mb-2 text-warning">
                                        Hindu
                                    </h6>
        
                                    <h4>{{ $hindu ?? 0 }}</h4>
                                </div>
                            </div>
        
                        </div>
        
                    </div>
        
                </div>
        
            </div>
        
            <!-- Filter -->
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
        
                                    <option value="1" {{ request('rw')=='1' ? 'selected' : '' }}>
                                        RW 01
                                    </option>
        
                                    <option value="2" {{ request('rw')=='2' ? 'selected' : '' }}>
                                        RW 02
                                    </option>
        
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
        
                                    <option value="1" {{ request('rt')=='1' ? 'selected' : '' }}>
                                        RT 01
                                    </option>
        
                                    <option value="2" {{ request('rt')=='2' ? 'selected' : '' }}>
                                        RT 02
                                    </option>
        
                                </select>
        
                            </div>
        
                            <button class="btn btn-success w-100">
                                Terapkan Filter
                            </button>
        
                        </form>
        
                        <div class="alert alert-success mt-4 mb-0">
                            Pilih RW dan RT untuk melihat data sesuai wilayah.
                        </div>
        
                    </div>
        
                </div>
        
            </div>
        
        </div>
    </div>

</section>

@endsection
