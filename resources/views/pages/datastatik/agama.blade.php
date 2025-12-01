@extends('layouts.user')

@section('title', 'Data Statistik Agama | Sistem Informasi Desa')

@section('content')

<section>

    <div class="dashboard-container">

        <div class="stats-grid">

            <div class="stat-card">
                <p class="stat-title">Islam</p>
                <p class="stat-value">680</p>
            </div>

            <div class="stat-card">
                <p class="stat-title">Kristen</p>
                <p class="stat-value">120</p>
            </div>

            <div class="stat-card">
                <p class="stat-title">Hindu</p>
                <p class="stat-value">45</p>
            </div>

            <div class="stat-card">
                <p class="stat-title">Budha</p>
                <p class="stat-value">28</p>
            </div>

        </div>


       
        <div class="chart-layout">

            <!-- pie chart -->
            <div class="chart-card">
                <h6 style="margin-bottom: 15px;">Grafik Statistik Agama</h6>
                <div id="agamaChart" style="height: 360px;"></div>
            </div>

            <div class="filter-card">
                <h6 style="margin-bottom: 15px;">Filter Dusun</h6>

                <label class="form-label">Pilih Dusun:</label>
                <select class="form-select mb-3">
                    <option>Dusun A</option>
                    <option>Dusun B</option>
                    <option>Dusun C</option>
                </select>

                <button class="btn btn-success w-100">Terapkan</button>
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
