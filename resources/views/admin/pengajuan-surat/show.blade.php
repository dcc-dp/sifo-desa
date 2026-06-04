<x-app-layout>

    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">

        <x-app.navbar />

        <div class="container-fluid py-4 px-5">

            <div class="row">

                <div class="col-12">

                    <div class="card border shadow-xs mb-4">

                        <div class="card-header d-flex justify-content-between align-items-center">

                            <h4 class="mb-0">
                                Detail Pengajuan Surat
                            </h4>

                            @if ($surat->status == 'menunggu')
                                <span class="badge bg-warning">
                                    Menunggu
                                </span>
                            @elseif($surat->status == 'diterima')
                                <span class="badge bg-success">
                                    Diterima
                                </span>
                            @elseif($surat->status == 'ditolak')
                                <span class="badge bg-danger">
                                    Ditolak
                                </span>
                            @endif

                        </div>

                        <div class="card-body">

                            <h5 class="mb-3">
                                Data Pemohon
                            </h5>

                            <table class="table table-bordered">

                                <tr>
                                    <th width="250">Nomor Surat</th>
                                    <td>{{ $surat->nomor_surat }}</td>
                                </tr>

                                <tr>
                                    <th>NIK</th>
                                    <td>{{ $surat->penduduk->nik }}</td>
                                </tr>

                                <tr>
                                    <th>Nama</th>
                                    <td>{{ $surat->penduduk->nama }}</td>
                                </tr>

                                <tr>
                                    <th>Tempat / Tanggal Lahir</th>
                                    <td>
                                        {{ $surat->penduduk->tempat_lahir }},
                                        {{ $surat->penduduk->tanggal_lahir }}
                                    </td>
                                </tr>

                                <tr>
                                    <th>Jenis Kelamin</th>
                                    <td>
                                        {{ $surat->penduduk->jenis_kelamin == 'L' ? 'Laki-Laki' : 'Perempuan' }}
                                    </td>
                                </tr>

                                <tr>
                                    <th>Pekerjaan</th>
                                    <td>{{ $surat->penduduk->pekerjaan }}</td>
                                </tr>

                                <tr>
                                    <th>Alamat</th>
                                    <td>
                                        {{ $surat->penduduk->alamat }}
                                        RT {{ $surat->penduduk->rt->nomor_rt ?? '-' }}
                                        /
                                        RW {{ $surat->penduduk->rw->nomor_rw ?? '-' }}
                                    </td>
                                </tr>

                            </table>

                            <br>

                            <h5 class="mb-3">
                                Data Surat
                            </h5>

                            <table class="table table-bordered">

                                <tr>
                                    <th width="250">Jenis Surat</th>
                                    <td>{{ $surat->keterangan }}</td>
                                </tr>

                                <tr>
                                    <th>Tanggal Pengajuan</th>
                                    <td>{{ $surat->tanggal_dibuat }}</td>
                                </tr>

                                <tr>
                                    <th>Status</th>
                                    <td>{{ ucfirst($surat->status) }}</td>
                                </tr>

                                {{-- SKU --}}
                                @if ($surat->usaha)
                                    <tr>
                                        <th>Nama Usaha</th>
                                        <td>{{ $surat->usaha->nama_usaha }}</td>
                                    </tr>

                                    <tr>
                                        <th>Alamat Usaha</th>
                                        <td>{{ $surat->usaha->alamat_usaha }}</td>
                                    </tr>
                                @endif

                                {{-- Domisili --}}
                                @if ($surat->domisili)
                                    <tr>
                                        <th>Keperluan</th>
                                        <td>{{ $surat->domisili->keperluan }}</td>
                                    </tr>
                                @endif

                                {{-- Pengantar --}}
                                @if ($surat->pengantar)
                                    <tr>
                                        <th>Keperluan</th>
                                        <td>{{ $surat->pengantar->keperluan }}</td>
                                    </tr>
                                @endif

                                {{-- SKTM --}}
                                @if ($surat->sktm)
                                    <tr>
                                        <th>Pekerjaan Orang Tua/Wali</th>
                                        <td>{{ $surat->sktm->pekerjaan }}</td>
                                    </tr>

                                    <tr>
                                        <th>Penghasilan</th>
                                        <td>
                                            Rp {{ number_format($surat->sktm->penghasilan, 0, ',', '.') }}
                                        </td>
                                    </tr>
                                @endif

                                {{-- Izin --}}
                                @if ($surat->izin)
                                    <tr>
                                        <th>Hari</th>
                                        <td>{{ $surat->izin->hari }}</td>
                                    </tr>

                                    <tr>
                                        <th>Tanggal</th>
                                        <td>{{ $surat->izin->tanggal }}</td>
                                    </tr>

                                    <tr>
                                        <th>Tempat</th>
                                        <td>{{ $surat->izin->tempat }}</td>
                                    </tr>

                                    <tr>
                                        <th>Jenis Acara</th>
                                        <td>{{ $surat->izin->jenis_acara }}</td>
                                    </tr>

                                    <tr>
                                        <th>Jumlah Peserta</th>
                                        <td>{{ $surat->izin->jumlah_peserta }} Orang</td>
                                    </tr>
                                @endif

                            </table>

                            <div class="mt-4">

                                @if ($surat->status == 'menunggu')
                                    <form action="{{ route('admin.pengajuan-surat.terima', $surat->id) }}"
                                        method="POST" style="display:inline">

                                        @csrf
                                        @method('PATCH')

                                        <button type="submit" class="btn btn-success"
                                            onclick="return confirm('Yakin menerima surat ini?')">

                                            <i class="fas fa-check"></i>
                                            Terima

                                        </button>

                                    </form>
                                    <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                        data-bs-target="#modalTolak">

                                        Tolak

                                    </button>
                                @endif

                                {{-- @if ($surat->status == 'diterima')
                                    <a href="{{ route('surat.download', $surat->id) }}" class="btn btn-primary">

                                        <i class="fas fa-download"></i>
                                        Download PDF

                                    </a>
                                @endif --}}

                                <a href="{{ route('admin.pengajuan-surat.index') }}" class="btn btn-secondary">

                                    Kembali

                                </a>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

            <x-app.footer />

        </div>

    </main>
    <div class="modal fade" id="modalTolak" tabindex="-1">

        <div class="modal-dialog">
    
            <div class="modal-content">
    
                <div class="modal-header">
    
                    <h5 class="modal-title">
                        Alasan Penolakan
                    </h5>
    
                    <button
                        type="button"
                        class="btn-close"
                        data-bs-dismiss="modal">
                    </button>
    
                </div>
    
                <form action="{{ route('admin.pengajuan-surat.tolak', $surat->id) }}"
                    method="POST">
    
                    @csrf
                    @method('PATCH')
    
                    <div class="modal-body">
    
                        <textarea
                            name="alasan_tolak"
                            class="form-control"
                            rows="4"
                            placeholder="Masukkan alasan penolakan..."
                            required></textarea>
    
                    </div>
    
                    <div class="modal-footer">
    
                        <button
                            type="button"
                            class="btn btn-secondary"
                            data-bs-dismiss="modal">
    
                            Batal
    
                        </button>
    
                        <button
                            type="submit"
                            class="btn btn-danger">
    
                            Tolak Surat
    
                        </button>
    
                    </div>
    
                </form>
    
            </div>
    
        </div>
    
    </div>

</x-app-layout>
