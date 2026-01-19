@extends('layouts.user')

@section('title', 'Data Statistik Agama | Sistem Informasi Desa')

@section('content')

<section>

    <div class="dashboard-container">

        <div class="stats-grid">
            <div class="stat-card">
                <p class="stat-title">Islam</p>
                <p class="stat-value">{{ $islam ?? 0 }}</p>
            </div>
        
            <div class="stat-card">
                <p class="stat-title">Kristen</p>
                <p class="stat-value">{{ $kristen ?? 0 }}</p>
            </div>
        
            <div class="stat-card">
                <p class="stat-title">Hindu</p>
                <p class="stat-value">{{ $hindu ?? 0 }}</p>
            </div>
        
            <div class="stat-card">
                <p class="stat-title">Budha</p>
                <p class="stat-value">{{ $budha ?? 0 }}</p>
            </div>
        
            {{-- @if(($katolik ?? 0) > 0) --}}
            <div class="stat-card">
                <p class="stat-title">Katolik</p>
                <p class="stat-value">{{ $katolik }}</p>
            </div>
            {{-- @endif --}}
        
            {{-- @if(($konghucu ?? 0) > 0) --}}
            <div class="stat-card">
                <p class="stat-title">Konghucu</p>
                <p class="stat-value">{{ $konghucu }}</p>
            </div>
            {{-- @endif --}}
        </div>

        <div class="chart-layout">

            <!-- donuts chart -->
            <div class="chart-card">
                <h6 class="mb-3 text-center">
                    Grafik Jumlah Agama
                    @if($rw) RW {{ $rw }} @endif
                    @if($rt) RT {{ $rt }} @endif
                </h6>
            
                <div 
                    id="agamaChart" 
                    data-islam="{{ $islam ?? 0 }}"
                    data-kristen="{{ $kristen ?? 0 }}"
                    data-hindu="{{ $hindu ?? 0 }}"
                    data-budha="{{ $budha ?? 0 }}"
                    data-katolik="{{ $katolik ?? 0 }}"
                    data-konghucu="{{ $konghucu ?? 0 }}"
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
            <h5 class="table-title">Tabel Data Agama Penduduk</h5>

            <div class="table-responsive">
                <table class="table-penduduk">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Agama</th>
                            <th>Jumlah</th>
                            <th>Dusun</th>
                        </tr>
                    </thead>

                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>Islam</td>
                            <td>680</td>
                            <td>Dusun A</td>
                        </tr>

                        <tr>
                            <td>2</td>
                            <td>Kristen</td>
                            <td>120</td>
                            <td>Dusun B</td>
                        </tr>

                        <tr>
                            <td>3</td>
                            <td>Hindu</td>
                            <td>45</td>
                            <td>Dusun C</td>
                        </tr>
                        <tr>
                            <td>4</td>
                            <td>Budha</td>
                            <td>28</td>
                            <td>Dusun A</td>
                        </tr>

                        </tr>
                            <tr class="fw-bold table-light">
                            <td colspan="2" style="text-align: center;">Total :</td>
                            <td>873</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

    </div>

</section>

@endsection
