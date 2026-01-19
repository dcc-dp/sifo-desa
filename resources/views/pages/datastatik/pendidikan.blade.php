@extends('layouts.user')

@section('title', 'Data Statistik Pendidikan | Sistem Informasi Desa')

@section('content')

<section>

    <div class="dashboard-container">


        <div class="stats-grid">

            <div class="stat-card">
                <p class="stat-title">Tidak Sekolah</p>
                <p class="stat-value">{{ $tidakSekolah }}</p>
            </div>
            
            <div class="stat-card">
                <p class="stat-title">SD / Sederajat</p>
                <p class="stat-value">{{ $sd }}</p>
            </div>
            
            <div class="stat-card">
                <p class="stat-title">SMP / Sederajat</p>
                <p class="stat-value">{{ $smp }}</p>
            </div>
            
            <div class="stat-card">
                <p class="stat-title">SMA / Sederajat</p>
                <p class="stat-value">{{ $sma }}</p>
            </div>
            
            <div class="stat-card">
                <p class="stat-title">Diploma / Sarjana</p>
                <p class="stat-value">{{ $diploma }}</p>
            </div>
            

        </div>

    
        <div class="chart-layout">

            <!-- bar chart -->
            <div class="chart-card">
                <h6 class="mb-3 text-center">
                    Grafik Jumlah Pekerjaan
                    @if($rw) RW {{ $rw }} @endif
                    @if($rt) RT {{ $rt }} @endif
                </h6>
            
                <div 
                    id="pendidikanChart"
                    data-tidak="{{ $tidakSekolah }}"
                    data-sd="{{ $sd }}"
                    data-smp="{{ $smp }}"
                    data-sma="{{ $sma }}"
                    data-diploma="{{ $diploma }}"
                    style="height: 360px;">
                </div>
            </div>
            

            <div class="col-md-4 col-lg-3">
                <div class="card shadow-sm border-0 h-100">
                    <div class="card-body px-4 py-4">
                        <h6 class="fw-semibold mb-4 text-center">Filter Wilayah</h6>
            
                        <form method="GET">
                            <div class="mb-4">
                                <label class="form-label fw-medium mb-1">RW</label>
                                <select name="rw" class="form-select form-select-sm">
                                    <option value="">-- Pilih RW --</option>
                                    <option value="1" {{ request('rw')=='1' ? 'selected' : '' }}>RW 01</option>
                                    <option value="2" {{ request('rw')=='2' ? 'selected' : '' }}>RW 02</option>
                                </select>
                            </div>
            
                            <div class="mb-4">
                                <label class="form-label fw-medium mb-1">RT</label>
                                <select name="rt" class="form-select form-select-sm">
                                    <option value="">-- Semua RT --</option>
                                    <option value="1" {{ request('rt')=='1' ? 'selected' : '' }}>RT 01</option>
                                    <option value="2" {{ request('rt')=='2' ? 'selected' : '' }}>RT 02</option>
                                </select>
                            </div>
            
                            <div class="d-grid mt-3">
                                <button class="btn btn-success btn-sm fw-semibold">
                                    Terapkan Filter
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>


        <div class="table-card">
            <h5 class="table-title">Tabel Data Pendidikan</h5>

            <div class="table-responsive">
                <table class="table-penduduk">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Kategori Pendidikan</th>
                            <th>Jumlah</th>
                            <th>Dusun</th>
                        </tr>
                    </thead>

                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>Tidak Sekolah</td>
                            <td>40</td>
                            <td>Dusun A</td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>SD / Sederajat</td>
                            <td>180</td>
                            <td>Dusun B</td>
                        </tr>
                        <tr>
                            <td>3</td>
                            <td>SMP / Sederajat</td>
                            <td>150</td>
                            <td>Dusun C</td>
                        </tr>
                        <tr>
                            <td>4</td>
                            <td>SMA / Sederajat</td>
                            <td>210</td>
                            <td>Dusun A</td>
                        </tr>
                        <tr>
                            <td>5</td>
                            <td>Diploma / Sarjana</td>
                            <td>95</td>
                            <td>Dusun B</td>
                        </tr>
                            <tr class="fw-bold table-light">
                            <td colspan="2" style="text-align: center;">Total :</td>
                            <td>0</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

    </div>

</section>

@endsection
