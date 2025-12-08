@extends('layouts.user')

@section('title', 'Data Statistik Penduduk | Sistem Informasi Desa')

@section('content')

<section>

    <div class="dashboard-container">

        <div class="stats-grid">

            <div class="stat-card">
                <p class="stat-title">Kepala Keluarga</p>
                <p class="stat-value">120</p>
            </div>

            <div class="stat-card">
                <p class="stat-title">Laki-Laki</p>
                <p class="stat-value">340</p>
            </div>

            <div class="stat-card">
                <p class="stat-title">Perempuan</p>
                <p class="stat-value">360</p>
            </div>

            <div class="stat-card">
                <p class="stat-title">Disabilitas</p>
                <p class="stat-value">28</p>
            </div>

        </div>

   
        <div class="chart-layout">

            <!-- donuts chart -->
            <div class="chart-card">
                <h6 style="margin-bottom: 15px;">Grafik Jumlah Penduduk</h6>
                <div id="pendudukChart" style="height: 360px;"></div>
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
