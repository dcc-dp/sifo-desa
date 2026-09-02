<x-app-layout>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
        <x-app.navbar />
        <div class="container-fluid py-4 px-5">

            <!-- PAGE HEADER -->
            <div class="admin-page-header">
                <div>
                    <h2 class="admin-page-title">
                        <i class="fas fa-chart-line"></i>
                        <span>Dashboard Administrator</span>
                    </h2>
                    <p class="admin-page-subtitle">Selamat datang kembali, <strong>{{ auth()->user()->name ?? 'Administrator' }}</strong>. Berikut ringkasan operasional sistem desa.</p>
                </div>
                <div>
                    <span class="badge bg-light text-dark border px-3 py-2 fs-7 font-monospace">
                        <i class="fas fa-calendar-alt text-primary me-1"></i> {{ \Carbon\Carbon::now()->translatedFormat('l, d F Y') }}
                    </span>
                </div>
            </div>

            <!-- METRIC CARDS -->
            <div class="row g-4 mb-4">
                <!-- TOTAL PENDUDUK -->
                <div class="col-xl-3 col-sm-6">
                    <div class="admin-card mb-0 h-100 p-4 transition-all">
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <span class="text-xs text-uppercase fw-bold text-muted">Data Kependudukan</span>
                            <div class="d-flex align-items-center justify-content-center rounded-3 text-white"
                                style="width: 42px; height: 42px; background: linear-gradient(135deg, #2563eb, #1d4ed8);">
                                <i class="fas fa-users fs-6"></i>
                            </div>
                        </div>
                        <h2 class="fw-bolder text-dark mb-1">{{ number_format($pendudukCount, 0, ',', '.') }}</h2>
                        <div class="d-flex align-items-center justify-content-between mt-2 pt-2 border-top">
                            <span class="text-xs text-muted">Total Jiwa Terdaftar</span>
                            <a href="{{ route('data.penduduk-index') }}" class="text-xs fw-bold text-primary text-decoration-none">
                                Kelola <i class="fas fa-arrow-right ms-1"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- TOTAL BERITA -->
                <div class="col-xl-3 col-sm-6">
                    <div class="admin-card mb-0 h-100 p-4 transition-all">
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <span class="text-xs text-uppercase fw-bold text-muted">Publikasi Berita</span>
                            <div class="d-flex align-items-center justify-content-center rounded-3 text-white"
                                style="width: 42px; height: 42px; background: linear-gradient(135deg, #059669, #047857);">
                                <i class="fas fa-newspaper fs-6"></i>
                            </div>
                        </div>
                        <h2 class="fw-bolder text-dark mb-1">{{ number_format($beritaCount, 0, ',', '.') }}</h2>
                        <div class="d-flex align-items-center justify-content-between mt-2 pt-2 border-top">
                            <span class="text-xs text-muted">Artikel & Pengumuman</span>
                            <a href="{{ route('berita-index') }}" class="text-xs fw-bold text-success text-decoration-none">
                                Kelola <i class="fas fa-arrow-right ms-1"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- TOTAL PENGADUAN -->
                <div class="col-xl-3 col-sm-6">
                    <div class="admin-card mb-0 h-100 p-4 transition-all">
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <span class="text-xs text-uppercase fw-bold text-muted">Layanan Pengaduan</span>
                            <div class="d-flex align-items-center justify-content-center rounded-3 text-white"
                                style="width: 42px; height: 42px; background: linear-gradient(135deg, #d97706, #b45309);">
                                <i class="fas fa-comments fs-6"></i>
                            </div>
                        </div>
                        <h2 class="fw-bolder text-dark mb-1">{{ number_format($pengaduanCount, 0, ',', '.') }}</h2>
                        <div class="d-flex align-items-center justify-content-between mt-2 pt-2 border-top">
                            <span class="text-xs text-muted">Aspirasi & Masukan Warga</span>
                            <a href="{{ route('admin.pengaduan-index') }}" class="text-xs fw-bold text-warning text-decoration-none">
                                Tindak Lanjut <i class="fas fa-arrow-right ms-1"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- TOTAL PEMERINTAH -->
                <div class="col-xl-3 col-sm-6">
                    <div class="admin-card mb-0 h-100 p-4 transition-all">
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <span class="text-xs text-uppercase fw-bold text-muted">Aparatur Desa</span>
                            <div class="d-flex align-items-center justify-content-center rounded-3 text-white"
                                style="width: 42px; height: 42px; background: linear-gradient(135deg, #7c3aed, #6d28d9);">
                                <i class="fas fa-user-tie fs-6"></i>
                            </div>
                        </div>
                        <h2 class="fw-bolder text-dark mb-1">{{ number_format($pemerintahanCount, 0, ',', '.') }}</h2>
                        <div class="d-flex align-items-center justify-content-between mt-2 pt-2 border-top">
                            <span class="text-xs text-muted">Struktur Perangkat Desa</span>
                            <a href="{{ route('pemerintah-index') }}" class="text-xs fw-bold text-purple text-decoration-none" style="color: #7c3aed;">
                                Kelola <i class="fas fa-arrow-right ms-1"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- SHORTCUTS & SYSTEM INFO -->
            <div class="row g-4 mb-4">
                <div class="col-lg-8">
                    <div class="admin-card mb-0 h-100">
                        <div class="admin-card-header">
                            <h5 class="admin-card-title">
                                <i class="fas fa-th-large text-muted"></i>
                                <span>Pintasan Cepat Modul Utama</span>
                            </h5>
                        </div>
                        <div class="card-body p-4">
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <a href="{{ route('data.penduduk-create') }}" class="text-decoration-none">
                                        <div class="p-3 rounded-3 border bg-light d-flex align-items-center gap-3 transition-all hover-shadow">
                                            <div class="d-flex align-items-center justify-content-center bg-white rounded-3 shadow-xs" style="width: 44px; height: 44px;">
                                                <i class="fas fa-user-plus text-primary fs-5"></i>
                                            </div>
                                            <div>
                                                <h6 class="fw-bold text-dark mb-1 fs-7">Tambah Data Penduduk</h6>
                                                <p class="text-xs text-muted mb-0">Input warga atau biodata penduduk baru</p>
                                            </div>
                                        </div>
                                    </a>
                                </div>

                                <div class="col-md-6">
                                    <a href="{{ route('berita-create') }}" class="text-decoration-none">
                                        <div class="p-3 rounded-3 border bg-light d-flex align-items-center gap-3 transition-all hover-shadow">
                                            <div class="d-flex align-items-center justify-content-center bg-white rounded-3 shadow-xs" style="width: 44px; height: 44px;">
                                                <i class="fas fa-feather-alt text-success fs-5"></i>
                                            </div>
                                            <div>
                                                <h6 class="fw-bold text-dark mb-1 fs-7">Tulis Berita Baru</h6>
                                                <p class="text-xs text-muted mb-0">Publikasikan pengumuman atau artikel desa</p>
                                            </div>
                                        </div>
                                    </a>
                                </div>

                                <div class="col-md-6">
                                    <a href="{{ route('admin.pengajuan-surat.index') }}" class="text-decoration-none">
                                        <div class="p-3 rounded-3 border bg-light d-flex align-items-center gap-3 transition-all hover-shadow">
                                            <div class="d-flex align-items-center justify-content-center bg-white rounded-3 shadow-xs" style="width: 44px; height: 44px;">
                                                <i class="fas fa-file-invoice text-warning fs-5"></i>
                                            </div>
                                            <div>
                                                <h6 class="fw-bold text-dark mb-1 fs-7">Verifikasi Surat Permohonan</h6>
                                                <p class="text-xs text-muted mb-0">Tinjau permohonan surat masuk warga</p>
                                            </div>
                                        </div>
                                    </a>
                                </div>

                                <div class="col-md-6">
                                    <a href="{{ route('agenda-index') }}" class="text-decoration-none">
                                        <div class="p-3 rounded-3 border bg-light d-flex align-items-center gap-3 transition-all hover-shadow">
                                            <div class="d-flex align-items-center justify-content-center bg-white rounded-3 shadow-xs" style="width: 44px; height: 44px;">
                                                <i class="fas fa-calendar-alt text-danger fs-5"></i>
                                            </div>
                                            <div>
                                                <h6 class="fw-bold text-dark mb-1 fs-7">Jadwal Agenda Desa</h6>
                                                <p class="text-xs text-muted mb-0">Atur kalender kegiatan dan musyawarah</p>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="admin-card mb-0 h-100">
                        <div class="admin-card-header">
                            <h5 class="admin-card-title">
                                <i class="fas fa-shield-alt text-muted"></i>
                                <span>Informasi Portal</span>
                            </h5>
                        </div>
                        <div class="card-body p-4">
                            <div class="mb-3 pb-3 border-bottom">
                                <span class="text-xs text-muted text-uppercase fw-bold d-block">Sistem Informasi</span>
                                <span class="fw-bold text-dark">SIFO-DESA Rante Gola</span>
                            </div>
                            <div class="mb-3 pb-3 border-bottom">
                                <span class="text-xs text-muted text-uppercase fw-bold d-block">Status Server</span>
                                <span class="badge-status badge-status-success mt-1">
                                    <i class="fas fa-circle text-xs"></i> Sistem Beroperasi Normal
                                </span>
                            </div>
                            <div class="mb-0">
                                <span class="text-xs text-muted text-uppercase fw-bold d-block mb-1">Pengaturan Website</span>
                                <a href="{{ route('admin.setting.edit') }}" class="btn-admin-secondary w-100 text-center py-2">
                                    <i class="fas fa-sliders-h me-1"></i> Buka Konfigurasi Web
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <x-app.footer />
        </div>
    </main>
</x-app-layout>