@extends('layouts.user')

@section('title', 'Data Statistik Penduduk | Sistem Informasi Desa')

@section('content')

    <section>

        <div class="dashboard-container">

            <div class="dashboard-header mb-4">

            
                <h2>Statistik Penduduk</h2>
              
            
                <div class="header-right">
                    <a href="{{ route('home') }}">Dashboard</a>
                    <span>/</span>
                    <span>Statistik Agama</span>
                </div>
           
            
            </div>

            <div class="stats-grid">

                <div class="stat-card kk-card">
                    <div class="stat-icon">
                        👨‍👩‍👧‍👦
                    </div>
            
                    <div>
                        <p class="stat-title">
                            Total Penduduk
                        </p>
            
                        <p class="stat-value">
                            {{ $totalPenduduk }}
                        </p>
                    </div>
                </div>
            
                <div class="stat-card male-card">
                    <div class="stat-icon">
                        👨
                    </div>
            
                    <div>
                        <p class="stat-title">
                            Laki-Laki
                        </p>
            
                        <p class="stat-value">
                            {{ $laki }}
                        </p>
                    </div>
                </div>
            
                <div class="stat-card female-card">
                    <div class="stat-icon">
                        👩
                    </div>
            
                    <div>
                        <p class="stat-title">
                            Perempuan
                        </p>
            
                        <p class="stat-value">
                            {{ $perempuan }}
                        </p>
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
                                    Grafik Jumlah Penduduk
                                </h5>
            
                                <div class="total-penduduk-card">
                                    <i class="fas fa-users"></i>
                                    <span>{{ $totalPenduduk }} Orang</span>
                                </div>
                            </div>
            
                            <div
                                id="pendudukChart"
                                data-laki="{{ $laki }}"
                                data-perempuan="{{ $perempuan }}"
                                data-kepala="{{ $totalPenduduk }}"
                                style="height: 420px;">
                            </div>
            
                            <!-- Ringkasan Statistik -->
                            <div class="row mt-4">
            
                                <div class="col-md-4">
                                    <div class="border rounded-4 p-3">
                                        <h6 class="mb-2 text-danger">
                                            Kepala Keluarga
                                        </h6>
            
                                        <h4>{{ $totalPenduduk }}</h4>
                                    </div>
                                </div>
            
                                <div class="col-md-4">
                                    <div class="border rounded-4 p-3">
                                        <h6 class="mb-2 text-primary">
                                            Laki-Laki
                                        </h6>
            
                                        <h4>{{ $laki }}</h4>
                                    </div>
                                </div>
            
                                <div class="col-md-4">
                                    <div class="border rounded-4 p-3">
                                        <h6 class="mb-2 text-pink">
                                            Perempuan
                                        </h6>
            
                                        <h4>{{ $perempuan }}</h4>
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
            
                                    <select
                                        name="rw"
                                        class="form-select"
                                        onchange="this.form.submit()">
            
                                        <option value="">
                                            -- Pilih RW --
                                        </option>
            
                                        @foreach($rwList as $item)
                                            <option value="{{ $item->id }}"
                                                {{ request('rw') == $item->id ? 'selected' : '' }}>
                                                RW {{ $item->nomor_rw }}
                                            </option>
                                        @endforeach
            
                                    </select>
                                </div>
            
                                <div class="mb-4">
            
                                    <label class="form-label">
                                        RT
                                    </label>
            
                                    <select
                                        name="rt"
                                        class="form-select">
            
                                        <option value="">
                                            -- Semua RT --
                                        </option>
            
                                        @foreach($rtList as $item)
                                            <option value="{{ $item->id }}"
                                                {{ request('rt') == $item->id ? 'selected' : '' }}>
                                                RT {{ $item->nomor_rt }}
                                            </option>
                                        @endforeach
            
                                    </select>
            
                                </div>
            
                                <button
                                    class="btn btn-success w-100">
            
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
