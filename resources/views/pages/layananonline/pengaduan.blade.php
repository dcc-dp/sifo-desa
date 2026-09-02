@extends('layouts.user')

@section('title', 'Layanan Pengaduan | Sistem Informasi Desa')

@section('content')

    <section class="py-4 py-lg-5" style="background-color: #f8fafc; min-height: 80vh;">
        <div class="container">

            <!-- HEADER -->
            <div class="dashboard-header">
                <h2>
                    <i class="fas fa-file-signature"></i>
                    <span>Layanan Pengaduan Warga</span>
                </h2>
                <div class="header-right">
                    <a href="{{ route('home') }}"><i class="fas fa-home me-1"></i> Beranda</a>
                    <span>/</span>
                    <span>Layanan Pengaduan</span>
                </div>
            </div>

            <!-- USER CARD -->
            <div class="user-card">
                <div class="user-avatar">
                    <i class="fas fa-user"></i>
                </div>
                <div class="user-info">
                    <h4>{{ session('pengaduan_penduduk_name') }}</h4>
                    <p>
                        <i class="fas fa-id-card text-muted"></i>
                        <span>NIK : <strong>{{ session('pengaduan_nik') }}</strong></span>
                    </p>
                </div>
                <div class="ms-auto">
                    <form action="{{ route('pengaduan.logout') }}" method="GET">
                        <button type="submit" class="btn-logout-modern">
                            <i class="fas fa-sign-out-alt"></i>
                            <span>Keluar</span>
                        </button>
                    </form>
                </div>
            </div>

            <!-- ALERT -->
            <div class="info-alert">
                <i class="fas fa-info-circle"></i>
                <span>Silakan isi formulir pengaduan dengan lengkap dan jelas untuk mempermudah tindak lanjut dan respon oleh pemerintah desa.</span>
            </div>

            <!-- FORM PENGADUAN -->
            <h3 class="section-title">
                <i class="fas fa-comment-alt"></i>
                <span>Formulir Pengaduan</span>
            </h3>

            <div class="card border-0 shadow-sm rounded-4 mb-5 overflow-hidden" style="border: 1px solid #e2e8f0 !important;">
                <div class="card-body p-4">
                    <form action="{{ route('pengaduan-store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="mb-3">
                            <label for="judul" class="form-label fw-bold">Judul Pengaduan <span class="text-danger">*</span></label>
                            <input type="text" class="form-control rounded-3 py-2" id="judul" name="judul" value="{{ old('judul') }}" placeholder="Tuliskan pokok pengaduan secara singkat" required>
                        </div>

                        <div class="mb-3">
                            <label for="kategori_id" class="form-label fw-bold">Kategori Pengaduan <span class="text-danger">*</span></label>
                            <select id="kategori_id" name="kategori_id" class="form-select rounded-3 py-2" required>
                                <option value="">-- Pilih Kategori Pengaduan --</option>
                                @foreach ($kategoris as $kategori)
                                    <option value="{{ $kategori->id }}">{{ $kategori->nama_kategori }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="deskripsi" class="form-label fw-bold">Deskripsi Pengaduan <span class="text-danger">*</span></label>
                            <textarea class="form-control rounded-3" id="deskripsi" name="deskripsi" rows="5" placeholder="Tuliskan rincian pengaduan, kronologi, atau aspirasi Anda secara lengkap..." required>{{ old('deskripsi') }}</textarea>
                        </div>

                        <div class="row g-3 mb-3">
                            <div class="col-md-6">
                                <label for="gambar" class="form-label fw-bold">Unggah Foto / Bukti Gambar (Opsional)</label>
                                <input type="file" class="form-control rounded-3" id="gambar" name="gambar" accept="image/*">
                                <div class="form-text">Format yang didukung: JPG, PNG, JPEG</div>
                            </div>

                            <div class="col-md-6">
                                <label for="file" class="form-label fw-bold">Unggah Dokumen PDF (Opsional)</label>
                                <input type="file" class="form-control rounded-3" id="file" name="file" accept="application/pdf">
                                <div class="form-text">Format yang didukung: PDF</div>
                            </div>
                        </div>

                        <div class="form-check mb-4">
                            <input class="form-check-input" type="checkbox" id="anonymous" name="anonymous" value="1">
                            <label class="form-check-label fw-semibold text-muted" for="anonymous">
                                Kirim sebagai Anonim (Identitas nama Anda tidak akan ditampilkan ke publik)
                            </label>
                        </div>

                        <button type="submit" class="btn btn-success rounded-3 px-4 py-2 fw-bold">
                            <i class="fas fa-paper-plane me-1"></i>
                            Kirim Pengaduan
                        </button>
                    </form>
                </div>
            </div>

            <!-- RIWAYAT -->
            <h3 class="section-title">
                <i class="fas fa-history"></i>
                <span>Riwayat Pengaduan Anda</span>
            </h3>

            <div class="history-wrapper">
                @forelse ($pengaduans as $pengaduan)
                    <div class="history-card-item">
                        <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
                            <div>
                                <h5 class="fw-bold mb-1 text-dark">{{ $pengaduan->judul }}</h5>
                                <div class="d-flex align-items-center gap-3 text-muted fs-7 flex-wrap">
                                    <span>
                                        <i class="fas fa-tag text-success me-1"></i>
                                        Kategori: <strong>{{ $pengaduan->kategori->nama_kategori ?? '-' }}</strong>
                                    </span>
                                    <span>•</span>
                                    <span>
                                        <i class="fas fa-calendar-alt text-success me-1"></i>
                                        {{ $pengaduan->created_at ? \Carbon\Carbon::parse($pengaduan->created_at)->translatedFormat('d F Y') : '-' }}
                                    </span>
                                </div>
                            </div>

                            <div class="text-end d-flex align-items-center gap-2 flex-wrap">
                                @if ($pengaduan->status == 1)
                                    <span class="status-badge status-menunggu">
                                        <i class="fas fa-clock"></i> Menunggu
                                    </span>
                                @elseif ($pengaduan->status == 2)
                                    <span class="status-badge status-tolak">
                                        <i class="fas fa-times-circle"></i> Ditolak
                                    </span>
                                @elseif ($pengaduan->status == 3)
                                    <span class="status-badge status-diterima">
                                        <i class="fas fa-check-circle"></i> Selesai
                                    </span>
                                @endif

                                <button class="btn btn-sm btn-outline-success rounded-pill px-3" data-bs-toggle="modal"
                                    data-bs-target="#detailPengaduan{{ $pengaduan->id }}">
                                    <i class="fas fa-eye me-1"></i> Detail
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Modal Detail -->
                    <div class="modal fade" id="detailPengaduan{{ $pengaduan->id }}" tabindex="-1" aria-labelledby="modalLabel{{ $pengaduan->id }}" aria-hidden="true">
                        <div class="modal-dialog modal-lg modal-dialog-centered">
                            <div class="modal-content rounded-4 border-0 shadow">
                                <div class="modal-header border-bottom py-3 px-4">
                                    <h5 class="modal-title fw-bold" id="modalLabel{{ $pengaduan->id }}">
                                        <i class="fas fa-file-alt text-success me-2"></i>Detail Pengaduan
                                    </h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>

                                <div class="modal-body p-4">
                                    <div class="mb-3">
                                        <span class="text-muted fs-7 text-uppercase fw-bold">Judul Pengaduan</span>
                                        <h5 class="fw-bold text-dark mt-1">{{ $pengaduan->judul }}</h5>
                                    </div>
                                    <hr class="my-3 text-muted opacity-25">

                                    <div class="mb-3">
                                        <span class="text-muted fs-7 text-uppercase fw-bold">Kategori</span>
                                        <div class="mt-1 fw-semibold text-dark">
                                            <span class="badge bg-light text-success border border-success-subtle px-3 py-2">
                                                {{ $pengaduan->kategori->nama_kategori ?? '-' }}
                                            </span>
                                        </div>
                                    </div>
                                    <hr class="my-3 text-muted opacity-25">

                                    <div class="mb-3">
                                        <span class="text-muted fs-7 text-uppercase fw-bold">Deskripsi Pengaduan</span>
                                        <p class="mt-2 text-dark" style="white-space: pre-line; line-height: 1.6;">{{ $pengaduan->deskripsi }}</p>
                                    </div>

                                    @if($pengaduan->gambar || $pengaduan->file)
                                        <hr class="my-3 text-muted opacity-25">

                                        @if($pengaduan->gambar)
                                            <div class="mb-4">
                                                <h6 class="fw-bold mb-3">
                                                    <i class="fas fa-image text-success me-1"></i> Bukti Gambar
                                                </h6>
                                                <div class="p-2 bg-light rounded-3 text-center">
                                                    <img src="{{ asset($pengaduan->gambar) }}" class="img-fluid rounded shadow-sm border"
                                                        style="max-height:400px; object-fit:contain; display:block; margin:auto;">
                                                </div>
                                            </div>
                                        @endif

                                        @if($pengaduan->file)
                                            <div class="text-center mt-3">
                                                <a href="{{ asset($pengaduan->file) }}" target="_blank" class="btn btn-outline-danger rounded-pill px-4">
                                                    <i class="fas fa-file-pdf me-1"></i> Lihat Dokumen PDF Lampiran
                                                </a>
                                            </div>
                                        @endif
                                    @endif
                                </div>
                                <div class="modal-footer border-top py-2 px-4">
                                    <button type="button" class="btn btn-light rounded-pill px-4" data-bs-dismiss="modal">Tutup</button>
                                </div>
                            </div>
                        </div>
                    </div>

                @empty
                    <div class="empty-history">
                        <i class="fas fa-folder-open"></i>
                        <h5>Belum Ada Pengaduan</h5>
                        <p>Riwayat pengaduan yang Anda kirimkan akan ditampilkan di sini.</p>
                    </div>
                @endforelse
            </div>

        </div>
    </section>

@endsection