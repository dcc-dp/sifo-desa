@extends('layouts.user')

@section('title', 'Data Statistik Pekerjaan | Sistem Informasi Desa')

@section('content')

<section>

    <div class="dashboard-container">

        <div class="stats-grid">

            <div class="stat-card">
                <p class="stat-title">Petani</p>
                <p class="stat-value">210</p>
            </div>

            <div class="stat-card">
                <p class="stat-title">Buruh</p>
                <p class="stat-value">140</p>
            </div>

            <div class="stat-card">
                <p class="stat-title">Wiraswasta</p>
                <p class="stat-value">175</p>
            </div>

            <div class="stat-card">
                <p class="stat-title">PNS</p>
                <p class="stat-value">38</p>
            </div>

        </div>

        <div class="chart-layout">

            <!-- bar chart -->
            <div class="chart-card">
                <h6 style="margin-bottom: 15px;">Grafik Statistik Pekerjaan</h6>
                <div id="pekerjaanChart" style="height: 360px;"></div>
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
            <h5 class="table-title">Tabel Data Pekerjaan</h5>

            <div class="table-responsive">
                <table class="table-penduduk">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Jenis Pekerjaan</th>
                            <th>Jumlah</th>
                            <th>Dusun</th>
                        </tr>
                    </thead>

                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>Petani</td>
                            <td>210</td>
                            <td>Dusun A</td>
                        </tr>

                        <tr>
                            <td>2</td>
                            <td>Buruh</td>
                            <td>140</td>
                            <td>Dusun B</td>
                        </tr>

                        <tr>
                            <td>3</td>
                            <td>Wiraswasta</td>
                            <td>175</td>
                            <td>Dusun C</td>
                        </tr>

                        <tr>
                            <td>4</td>
                            <td>PNS</td>
                            <td>38</td>
                            <td>Dusun A</td>
                        </tr>
                        </tr>
                            <tr class="fw-bold table-light">
                            <td colspan="2" style="text-align:center;">Total :</td>
                            <td>0</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

    </div>

</section>

@endsection
