@extends('layouts.user')

@section('title', 'Layanan Pengaduan | Sistem Informasi Desa')

@section('content')

    <section>
        <div class="container">
            <h2><i class="fas fa-comment-dots"></i> Sistem Pengaduan Masyarakat</h2>
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
                <div>
                    <p style="margin: 0; color: #666;">
                        <strong>Nama:</strong> {{ session('pengaduan_penduduk_name') }}
                    </p>
                    <p style="margin: 5px 0 0 0; color: #666;">
                        <strong>NIK:</strong> {{ session('pengaduan_nik') }}
                    </p>
                </div>
                <form action="{{ route('pengaduan.logout') }}" method="GET" style="display:inline;">
                    @csrf
                    <button type="submit" class="btn btn-danger">
                        <i class="fas fa-sign-out-alt"></i> Logout
                    </button>
                </form>
            </div>

            <form action="{{ route('pengaduan-store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="form-group">
                    <label for="judul">Judul</label>
                    <input type="text" class="form-control" id="judul" name="judul" value="{{ old('judul') }}" required>
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

                <button type="submit" class="btn btn-primary" style="width: 100%; margin-top: 15px;">
                    Submit Complaint
                </button>

            </form>



            <h3 style="margin-top: 40px;">Keluhan Anda Sebelumnya</h3>

            <div class="complaint-history">

                @forelse ($pengaduans as $pengaduan)

                        <div class="card">

                            <div>
                                <h4>{{ $pengaduan->judul }}</h4>
                                <p style="color: #666; margin: 5px 0;"></p>
                            </div>

                            @if ($pengaduan->status == 1)

                                <span class="status-badge status-in-process">
                                    PROSES
                                </span>

                            @elseif ($pengaduan->status == 2)

                                <span class="status-badge status-rejected">
                                    TOLAK
                                </span>

                            @elseif ($pengaduan->status == 3)

                                <span class="status-badge status-completed">
                                    SELESAI
                                </span>

                            @endif

                        </div>

                    </a>

                @empty

                    <div class="card">
                        <h4>Belum ada pengaduan</h4>
                    </div>

                @endforelse

            </div>
        </div>
    </section>

@endsection