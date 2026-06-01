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

            <div class="stat-card petani-card">
        
                <div class="stat-icon">
                    🌾
                </div>
        
                <div class="stat-content">
                    <p class="stat-title">Petani</p>
                    <p class="stat-value">{{ $petani ?? 0 }}</p>
                </div>
        
            </div>
        
            <div class="stat-card buruh-card">
        
                <div class="stat-icon">
                    👷
                </div>
        
                <div class="stat-content">
                    <p class="stat-title">Buruh</p>
                    <p class="stat-value">{{ $buruh ?? 0 }}</p>
                </div>
        
            </div>
        
            <div class="stat-card wiraswasta-card">
        
                <div class="stat-icon">
                    🏪
                </div>
        
                <div class="stat-content">
                    <p class="stat-title">Wiraswasta</p>
                    <p class="stat-value">{{ $wiraswasta ?? 0 }}</p>
                </div>
        
            </div>
        
            <div class="stat-card pns-card">
        
                <div class="stat-icon">
                    👨‍💼
                </div>
        
                <div class="stat-content">
                    <p class="stat-title">PNS</p>
                    <p class="stat-value">{{ $pns ?? 0 }}</p>
                </div>
        
            </div>
        
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
            
                        <div
                            id="pekerjaanChart"
                            data-petani="{{ $petani ?? 0 }}"
                            data-buruh="{{ $buruh ?? 0 }}"
                            data-wiraswasta="{{ $wiraswasta ?? 0 }}"
                            data-pns="{{ $pns ?? 0 }}"
                            style="height:420px;">
                        </div>
            
                        <div class="row mt-4">
            
                            <div class="col-md-3">
                                <div class="summary-card">
                                    <h6 class="text-success">Petani</h6>
                                    <h4>{{ $petani }}</h4>
                                </div>
                            </div>
            
                            <div class="col-md-3">
                                <div class="summary-card">
                                    <h6 class="text-warning">Buruh</h6>
                                    <h4>{{ $buruh }}</h4>
                                </div>
                            </div>
            
                            <div class="col-md-3">
                                <div class="summary-card">
                                    <h6 class="text-primary">Wiraswasta</h6>
                                    <h4>{{ $wiraswasta }}</h4>
                                </div>
                            </div>
            
                            <div class="col-md-3">
                                <div class="summary-card">
                                    <h6 class="text-danger">PNS</h6>
                                    <h4>{{ $pns }}</h4>
                                </div>
                            </div>
            
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
                            Pilih RW dan RT untuk melihat data pekerjaan berdasarkan wilayah.
                        </div>
            
                    </div>
            
                </div>
            
            </div>

        </div>


    </div>

</section>

@endsection
