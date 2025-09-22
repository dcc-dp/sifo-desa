<x-app-layout>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <x-app.navbar />

        <div class="container-fluid py-4 px-5">
            <div class="row">
                <div class="col-12">
                    <div class="card border shadow-xs mb-4">
                        <div class="card-header">
                            <h4 class="mb-0">Detail Data Penduduk</h4>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered">
                                <tr>
                                    <th>NIK</th>
                                    <td>{{ $data->nik }}</td>
                                </tr>
                                <tr>
                                    <th>Nama</th>
                                    <td>{{ $data->nama }}</td>
                                </tr>
                                <tr>
                                    <th>Tempat Lahir</th>
                                    <td>{{ $data->tempat_lahir }}</td>
                                </tr>
                                <tr>
                                    <th>Tanggal Lahir</th>
                                    <td>{{ $data->tanggal_lahir }}</td>
                                </tr>
                                <tr>
                                    <th>Alamat</th>
                                    <td>{{ $data->alamat }}</td>
                                </tr>
                                <tr>
                                    <th>RT / RW</th>
                                    <td>{{ $data->rt }} / {{ $data->rw }}</td>
                                </tr>
                                <tr>
                                    <th>Kel/Desa</th>
                                    <td>{{ $data->keldesa }}</td>
                                </tr>
                                <tr>
                                    <th>Kecamatan</th>
                                    <td>{{ $data->kecamatan }}</td>
                                </tr>
                                <tr>
                                    <th>Agama</th>
                                    <td>{{ $data->agama }}</td>
                                </tr>
                                <tr>
                                    <th>Status Perkawinan</th>
                                    <td>{{ $data->status_perkawinan }}</td>
                                </tr>
                                <tr>
                                    <th>Pekerjaan</th>
                                    <td>{{ $data->pekerjaan }}</td>
                                </tr>
                                <tr>
                                    <th>Kewarganegaraan</th>
                                    <td>{{ $data->kewarganegaraan }}</td>
                                </tr>
                            </table>

                            <a href="{{ url()->previous() }}" class="btn btn-secondary mt-3">Kembali</a>
                        </div>
                    </div>
                </div>
            </div>
            <x-app.footer />
        </div>
    </main>
</x-app-layout>
