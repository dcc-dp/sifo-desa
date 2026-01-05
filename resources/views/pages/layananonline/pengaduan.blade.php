@extends('layouts.user')

@section('title', 'Layanan Pengaduan | Sistem Informasi Desa')

@section('content')

    <section>
        <div class="container">
            <h2><i class="fas fa-comment-dots"></i> Sistem Pengaduan Masyarakat</h2>
            <form action="{{ url('/login') }}" method="GET" style="display:inline;">
                @csrf
                <button type="submit" class="btn btn-danger">
                    <i class="fas fa-sign-out-alt"></i> Logout
                </button>
            </form>

            <form action="{{ route('pengaduan-store') }}" method="POST" enctype="multipart/form-data">
                @csrf


                <input type="hidden" name="user_id" value="{{ auth()->id() }}">

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


            <h3 style="margin-top: 40px;">Your Previous Complaints</h3>
            <div class="complaint-history">
                <div class="card" onclick="showComplaintDetail(1)">
                    <div>
                        <h4>Lampu Jalan Mati di Depan Balai Desa</h4>
                        <span style="font-size: 0.9rem; color: var(--color-text-light);">Submitted: 15 Oct 2025</span>
                    </div>
                    <span class="status-badge status-completed">Completed</span>
                </div>
                <div class="card" onclick="showComplaintDetail(2)">
                    <div>
                        <h4>Respon Lambat Permintaan Surat Pengantar</h4>
                        <span style="font-size: 0.9rem; color: var(--color-text-light);">Submitted: 20 Oct 2025</span>
                    </div>
                    <span class="status-badge status-in-process">In Process</span>
                </div>
                <div class="card" onclick="showComplaintDetail(3)">
                    <div>
                        <h4>Usulan Penolakan Pembangunan Posyandu</h4>
                        <span style="font-size: 0.9rem; color: var(--color-text-light);">Submitted: 28 Oct 2025</span>
                    </div>
                    <span class="status-badge status-rejected">Rejected</span>
                </div>
            </div>
        </div>
    </section>

@endsection