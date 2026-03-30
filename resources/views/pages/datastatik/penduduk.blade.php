@extends('layouts.user')

@section('title', 'Data Statistik Penduduk | Sistem Informasi Desa')

@section('content')

    <section>

        <div class="dashboard-container">

            <div class="stats-grid">

                <div class="stat-card">
                    <p class="stat-title">Kepala Keluarga</p>
                    <p class="stat-value">{{ $totalPenduduk }}</p>
                </div>

                <div class="stat-card">
                    <p class="stat-title">Laki-Laki</p>
                    <p class="stat-value">{{ $laki }}</p>
                </div>

                <div class="stat-card">
                    <p class="stat-title">Perempuan</p>
                    <p class="stat-value">{{ $perempuan }}</p>
                </div>
                {{-- 
            <div class="stat-card">
                <p class="stat-title">Disabilitas</p>
                <p class="stat-value"></p>
            </div> --}}

            </div>


            <div class="chart-layout">

                <!-- donuts chart -->
                <div class="chart-card">
                    <h6 class="mb-3 text-center">
                        Grafik Jumlah Penduduk
                        @if($rw) RW {{ $rw }} @endif
                        @if($rt) RT {{ $rt }} @endif
                    </h6>
                
                    <div 
                        id="pendudukChart"
                        data-laki="{{ $laki }}"
                        data-perempuan="{{ $perempuan }}"
                        data-kepala="{{ $totalPenduduk }}"
                        {{-- data-kepala="{{ $kepalaKeluarga }}" --}}
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
                                    <select name="rw" class="form-select form-select-sm" onchange="this.form.submit()">
                                        <option value="">-- Pilih RW --</option>
                                        @foreach($rwList as $item)
                                            <option value="{{ $item->id }}" {{ request('rw') == $item->id ? 'selected' : '' }}>
                                                RW {{ $item->nomor_rw }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            
                                <div class="mb-4">
                                    <label class="form-label fw-medium mb-1">RT</label>
                                    <select name="rt" class="form-select form-select-sm">
                                        <option value="">-- Semua RT --</option>
                                        @foreach($rtList as $item)
                                            <option value="{{ $item->id }}" {{ request('rt') == $item->id ? 'selected' : '' }}>
                                                RT {{ $item->nomor_rt }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            
                                <div class="d-grid mt-3">
                                    <button class="btn btn-success btn-sm fw-semibold">Terapkan Filter</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                 
                

            </div>

            <div class="table-card">
                <h5 class="table-title">Tabel Data Penduduk</h5>

                <div class="table-responsive">
                    <table class="table-penduduk">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Kategori</th>
                                <th>Jumlah</th>
                                <th>Dusun</th>
                            </tr>
                        </thead>

                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>Kepala Keluarga</td>
                                <td>0</td>
                                <td>Dusun A</td>
                            </tr>

                            <tr>
                                <td>2</td>
                                <td>Laki-laki</td>
                                <td>0</td>
                                <td>Dusun B</td>
                            </tr>

                            <tr>
                                <td>3</td>
                                <td>Perempuan</td>
                                <td>0</td>
                                <td>Dusun C</td>
                            </tr>

                            <tr>
                                <td>4</td>
                                <td>Disabilitas</td>
                                <td>0</td>
                                <td>Dusun A</td>
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
