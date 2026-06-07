@extends('layouts.user')

@section('title', 'Layanan Pengaduan | Sistem Informasi Desa')

@section('content')

    <section class="py-4">
        <div class="container">
            <div class="dashboard-header">

                <h2>Layanan Pengaduan</h2>

                <div class="header-right">
                    <a href="{{ route('home') }}">Dashboard</a>
                    <span>/</span>
                    <span>Layanan Pengaduan</span>
                </div>

            </div>
            <div class="user-card">

                <div class="user-avatar">
                    <i class="fas fa-user"></i>
                </div>

                <div class="user-info">
                    <h4>{{ session('pengaduan_penduduk_name') }}</h4>
                    <p>NIK : {{ session('pengaduan_nik') }}</p>
                </div>

                <div class="ms-auto">
                    <form action="{{ route('pengaduan.logout') }}" method="GET">
                        <button type="submit" class="btn btn-danger">
                            <i class="fas fa-sign-out-alt"></i>
                            Logout
                        </button>
                    </form>
                </div>

            </div>
            <div class="info-alert">

                <i class="fas fa-info-circle"></i>

                Silakan isi formulir pengaduan dengan lengkap dan benar.

            </div>

            <h3 class="section-title">

                <i class="fas fa-comment-alt"></i>

                Form Pengaduan

            </h3>

            <div class="card shadow-sm border-0 mb-5">

                <div class="card-body">

                    <form action="{{ route('pengaduan-store') }}" method="POST" enctype="multipart/form-data">

                        @csrf

                        <div class="form-group">
                            <label for="judul">Judul</label>
                            <input type="text" class="form-control" id="judul" name="judul" value="{{ old('judul') }}"
                                required>
                        </div>

                        <div class="form-group">
                            <label for="kategori_id">Kategori</label>
                            <select id="kategori_id" name="kategori_id" class="form-control" required>
                                <option value="">Select Kategori</option>
                                @foreach ($kategoris as $kategori)
                                    <option value="{{ $kategori->id }}">{{ $kategori->nama_kategori }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="deskripsi">Deskripsi</label>
                            <textarea class="form-control" id="deskripsi" name="deskripsi" rows="5"
                                required>{{ old('deskripsi') }}</textarea>
                        </div>

                        <div class="form-group">
                            <label for="gambar">Upload Image (Optional)</label>
                            <input type="file" class="form-control" name="gambar" accept="image/*">
                        </div>

                        <div class="form-group mt-3">
                            <label for="file">Upload PDF (Optional)</label>
                            <input type="file" class="form-control" name="file" accept="application/pdf">
                        </div>

                        <div class="form-group checkbox-group">
                            <input type="checkbox" id="anonymous" name="anonymous" value="1">
                            <label for="anonymous">Submit as Anonymous</label>
                        </div>

                        <button type="submit" class="btn btn-success mt-3">

                            <i class="fas fa-paper-plane"></i>

                            Kirim Pengaduan

                        </button>
                    </form>

                </div>

            </div>


            <h3 class="section-title">

                <i class="fas fa-history"></i>

                Riwayat Pengaduan

            </h3>

            <div class="history-wrapper">

                @forelse ($pengaduans as $pengaduan)

                    <div class="card mb-3 p-3">

                        <div class="d-flex justify-content-between">

                            <div>

                                <h5>{{ $pengaduan->judul }}</h5>

                                <small>
                                    Kategori:
                                    {{ $pengaduan->kategori->nama_kategori ?? '-' }}
                                </small>

                                <br>

                                <small>
                                    Tanggal:
                                    {{ $pengaduan->created_at
                                        ? \Carbon\Carbon::parse($pengaduan->created_at)->translatedFormat('d F Y')
                                        : '-' }}
                                </small>

                            </div>

                            <div class="text-end">

                                @if ($pengaduan->status == 1)
                                    <span class="status-badge status-proses">
                                        Menunggu
                                    </span>
                                @elseif ($pengaduan->status == 2)
                                    <span class="status-badge status-tolak">
                                        Ditolak
                                    </span>
                                @elseif ($pengaduan->status == 3)
                                    <span class="status-badge status-diterima">
                                        Selesai
                                    </span>
                                @endif

                                <br>

                                <button class="btn btn-success btn-sm mt-2" data-bs-toggle="modal"
                                    data-bs-target="#detailPengaduan{{ $pengaduan->id }}">
                                    <i class="fas fa-eye"></i>
                                    Detail
                                </button>

                            </div>

                        </div>

                    </div>

                    <div class="modal fade" id="detailPengaduan{{ $pengaduan->id }}" tabindex="-1">


                        <div class="modal-dialog modal-lg">

                            <div class="modal-content">

                                <div class="modal-header">

                                    <h5 class="modal-title">
                                        Detail Pengaduan
                                    </h5>

                                    <button type="button" class="btn-close" data-bs-dismiss="modal">
                                    </button>

                                </div>

                                <div class="modal-body">

                                    <p>
                                        <strong>Judul :</strong>
                                     
                                    </p>
                                    <p>
                                           {{ $pengaduan->judul }}
                                    </p>
                                    <hr>


                                    <p>
                                        <strong>Kategori :</strong>
                                       
                                    </p>

                                    <p>
                                         {{ $pengaduan->kategori->nama_kategori ?? '-' }}
                                    </p>
                                    <hr>


                                    <p>
                                        <strong>Deskripsi :</strong>
                                    </p>
                               

                                    <p>
                                        {{ $pengaduan->deskripsi }}
                                    </p>

                                    @if($pengaduan->gambar || $pengaduan->file)

                                        <hr>

                                        @if($pengaduan->gambar)

                                            <div class="mb-4">

                                                <h6 class="fw-bold mb-3">
                                                    Bukti Gambar
                                                </h6>

                                                <img src="{{ asset($pengaduan->gambar) }}" class="img-fluid rounded shadow-sm border"
                                                    style="max-height:400px; object-fit:contain; display:block; margin:auto;">

                                            </div>

                                        @endif

                                        @if($pengaduan->file)

                                            <div class="text-center">

                                                <a href="{{ asset($pengaduan->file) }}" target="_blank" class="btn btn-danger">

                                                    <i class="fas fa-file-pdf"></i>
                                                    Lihat Lampiran PDF

                                                </a>

                                            </div>

                                        @endif

                                    @endif

                                    <!-- <p>Path Gambar: {{ $pengaduan->gambar }}</p>
                                            <p>Path File: {{ $pengaduan->file }}</p> -->

                                </div>

                            </div>

                        </div>

                    </div>

                @empty

                    <div class="empty-history">

                        <i class="fas fa-folder-open"></i>

                        <h5>Belum Ada Pengaduan</h5>

                        <p>Riwayat pengaduan akan muncul di sini.</p>

                    </div>


                @endforelse

            </div>
        </div>
    </section>

@endsection