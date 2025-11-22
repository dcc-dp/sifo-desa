@extends('layouts.user')

@section('title', 'Data Statistik Pendidikan | Sistem Informasi Desa')

@section('content')

<section>

    <div class="dashboard-container">


        <div class="stats-grid">

            <div class="stat-card">
                <p class="stat-title">Tidak Sekolah</p>
                <p class="stat-value">40</p>
            </div>

            <div class="stat-card">
                <p class="stat-title">SD / Sederajat</p>
                <p class="stat-value">180</p>
            </div>

            <div class="stat-card">
                <p class="stat-title">SMP / Sederajat</p>
                <p class="stat-value">150</p>
            </div>

            <div class="stat-card">
                <p class="stat-title">SMA / Sederajat</p>
                <p class="stat-value">210</p>
            </div>

            <div class="stat-card">
                <p class="stat-title">Diploma / Sarjana</p>
                <p class="stat-value">95</p>
            </div>

        </div>

    
        <div class="chart-layout">

            <!-- bar chart -->
            <div class="chart-card">
                <h6 style="margin-bottom: 15px;">Grafik Tingkat Pendidikan</h6>
                <div id="pendidikanChart" style="height: 360px;"></div>
            </div>

            <div class="filter-card">
                <h6 style="margin-bottom: 15px;">Filter Dusun</h6>

                <label class="form-label">Pilih Dusun:</label>
                <select class="form-select mb-3">
                    <option>Semua Dusun</option>
                    <option>Dusun A</option>
                    <option>Dusun B</option>
                    <option>Dusun C</option>
                </select>

                <button class="btn btn-success w-100">Terapkan</button>
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
