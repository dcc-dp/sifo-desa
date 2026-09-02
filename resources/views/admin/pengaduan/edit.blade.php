<x-app-layout>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
        <x-app.navbar />
        <div class="container-fluid py-4 px-5">

            <!-- PAGE HEADER -->
            <div class="admin-page-header">
                <div>
                    <div class="d-flex align-items-center gap-2 mb-1">
                        <a href="{{ route('admin.pengaduan-index') }}" class="btn-admin-secondary py-1 px-2 fs-7">
                            <i class="fas fa-arrow-left"></i> Kembali
                        </a>
                        <span class="text-muted">/</span>
                        <span class="badge bg-light text-dark border px-2 py-1 fs-7">Pengaduan Warga</span>
                        <span class="text-muted">/</span>
                        <span class="text-muted fs-7">Detail & Tindak Lanjut</span>
                    </div>
                    <h2 class="admin-page-title">
                        <i class="fas fa-tasks"></i>
                        <span>Detail & Tindak Lanjut Pengaduan</span>
                    </h2>
                    <p class="admin-page-subtitle">Verifikasi laporan, bukti aduan masyarakat, dan perbarui tahapan penanganan</p>
                </div>
            </div>

            <!-- ALERT -->
            @if (session('error'))
                <div class="alert alert-danger alert-dismissible fade show mb-4 text-white border-0 bg-danger" role="alert">
                    <i class="fas fa-exclamation-circle me-2"></i>{{ session('error') }}
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert"></button>
                </div>
            @endif
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show mb-4 text-white border-0" style="background: #15803d;" role="alert">
                    <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <!-- STATUS BANNER -->
            <div class="mb-4">
                @if ($pengaduan->status == 1)
                    <div class="p-3 bg-light border-start border-4 border-warning rounded-3 d-flex align-items-center justify-content-between flex-wrap gap-2">
                        <div class="d-flex align-items-center gap-3">
                            <span class="badge-status badge-status-pending fs-6 px-3 py-2">
                                <i class="fas fa-clock"></i> Status: Sedang Diproses
                            </span>
                            <span class="text-muted fs-7">Laporan ini sedang ditindaklanjuti oleh aparat pemerintah desa.</span>
                        </div>
                        <span class="text-muted fs-8">
                            Diterima pada: {{ $pengaduan->created_at ? $pengaduan->created_at->translatedFormat('d F Y - H:i') : '-' }} WITA
                        </span>
                    </div>
                @elseif($pengaduan->status == 2)
                    <div class="p-3 bg-light border-start border-4 border-danger rounded-3 d-flex align-items-center justify-content-between flex-wrap gap-2">
                        <div class="d-flex align-items-center gap-3">
                            <span class="badge-status badge-status-danger fs-6 px-3 py-2">
                                <i class="fas fa-times-circle"></i> Status: Ditolak / Tidak Valid
                            </span>
                            <span class="text-muted fs-7">Laporan ini ditolak karena tidak memenuhi kriteria verifikasi atau data tidak valid.</span>
                        </div>
                    </div>
                @elseif($pengaduan->status == 3)
                    <div class="p-3 bg-light border-start border-4 border-success rounded-3 d-flex align-items-center justify-content-between flex-wrap gap-2">
                        <div class="d-flex align-items-center gap-3">
                            <span class="badge-status badge-status-success fs-6 px-3 py-2">
                                <i class="fas fa-check-circle"></i> Status: Selesai Ditangani
                            </span>
                            <span class="text-muted fs-7">Permasalahan yang dilaporkan telah selesai ditindaklanjuti dengan tuntas.</span>
                        </div>
                    </div>
                @else
                    <div class="p-3 bg-light border-start border-4 border-info rounded-3 d-flex align-items-center justify-content-between flex-wrap gap-2">
                        <div class="d-flex align-items-center gap-3">
                            <span class="badge-status badge-status-info fs-6 px-3 py-2">
                                <i class="fas fa-inbox"></i> Status: Laporan Masuk
                            </span>
                            <span class="text-muted fs-7">Laporan baru masuk, silakan periksa kelengkapan bukti dan ubah status penanganan.</span>
                        </div>
                    </div>
                @endif
            </div>

            <div class="row g-4">
                <!-- DETAIL PENGADUAN SUMMARY -->
                <div class="col-lg-7">
                    <div class="profile-detail-card h-100 mb-0">
                        <div class="profile-detail-header">
                            <div class="d-flex align-items-center gap-2">
                                <i class="fas fa-bullhorn text-success"></i>
                                <span>Informasi & Uraian Pengaduan</span>
                            </div>
                            <span class="badge-kategori">
                                {{ $pengaduan->kategori->nama_kategori ?? 'Umum' }}
                            </span>
                        </div>
                        <div class="profile-detail-body">
                            <div class="mb-4">
                                <span class="detail-label"><i class="fas fa-heading"></i> Judul Pengaduan</span>
                                <h4 class="fw-bold text-dark mb-0">{{ $pengaduan->judul }}</h4>
                            </div>

                            <div class="row g-3 mb-4">
                                <div class="col-sm-6">
                                    <div class="detail-item">
                                        <span class="detail-label"><i class="fas fa-user"></i> Identitas Pelapor</span>
                                        <div class="detail-value">
                                            @if($pengaduan->anonymous)
                                                <span class="badge bg-warning text-dark border px-2 py-1 fs-8">
                                                    <i class="fas fa-user-secret me-1"></i> Anonim (Dirahasiakan)
                                                </span>
                                            @else
                                                <span class="fw-bold text-dark">{{ $pengaduan->penduduk->nama ?? '-' }}</span>
                                                <div class="text-muted font-monospace fs-8">NIK: {{ $pengaduan->penduduk->nik ?? '-' }}</div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="detail-item">
                                        <span class="detail-label"><i class="fas fa-calendar-alt"></i> Waktu Pengaduan</span>
                                        <div class="detail-value">
                                            {{ $pengaduan->created_at ? $pengaduan->created_at->translatedFormat('d F Y, H:i') : '-' }} WITA
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="mb-4">
                                <span class="detail-label"><i class="fas fa-align-left"></i> Uraian / Isi Keluhan</span>
                                <div class="p-3 bg-light rounded-3 text-dark border" style="line-height: 1.7; font-size: 0.95rem; white-space: pre-line;">
                                    {{ $pengaduan->deskripsi }}
                                </div>
                            </div>

                            @if ($pengaduan->gambar && file_exists(public_path($pengaduan->gambar)))
                                <div class="mb-4">
                                    <span class="detail-label"><i class="fas fa-image"></i> Foto Bukti / Dokumentasi Lokasi</span>
                                    <div class="p-2 border rounded-3 bg-light d-inline-block">
                                        <a href="{{ asset($pengaduan->gambar) }}" target="_blank" title="Klik untuk memperbesar">
                                            <img src="{{ asset($pengaduan->gambar) }}" alt="Foto Bukti" class="rounded shadow-xs" style="max-height: 220px; max-width: 100%; object-fit: cover;">
                                        </a>
                                        <div class="text-muted fs-8 text-center mt-1">
                                            <i class="fas fa-search-plus me-1"></i> Klik gambar untuk ukuran penuh
                                        </div>
                                    </div>
                                </div>
                            @endif

                            @if ($pengaduan->file && file_exists(public_path($pengaduan->file)))
                                <div>
                                    <span class="detail-label"><i class="fas fa-paperclip"></i> Dokumen / Berkas Lampiran Pendukung</span>
                                    <a href="{{ asset($pengaduan->file) }}" target="_blank" class="btn-action-pill btn-action-pdf py-2 px-3 fs-7">
                                        <i class="fas fa-file-download"></i> <span>Unduh Berkas Lampiran</span>
                                    </a>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- UPDATE STATUS ACTION FORM -->
                <div class="col-lg-5">
                    <div class="profile-detail-card h-100 mb-0">
                        <div class="profile-detail-header">
                            <div class="d-flex align-items-center gap-2">
                                <i class="fas fa-sliders-h text-primary"></i>
                                <span>Tindak Lanjut & Keputusan Petugas</span>
                            </div>
                            <span class="badge bg-light text-dark border px-2 py-1 fs-8">Admin Desa</span>
                        </div>
                        <div class="card-body p-4">
                            <form action="{{ route('admin.pengaduan-update', $pengaduan->id) }}" method="POST">
                                @csrf
                                @method('PUT')

                                <div class="mb-4">
                                    <label for="status" class="admin-form-label fs-6 fw-bold text-dark mb-1">
                                        Status Penanganan Pengaduan <span class="required">*</span>
                                    </label>
                                    <p class="text-muted fs-8 mb-3">
                                        Tentukan tahapan penanganan saat ini. Perubahan status akan langsung terupdate pada akun pelapor.
                                    </p>
                                    <select name="status" id="status" class="form-select form-select-lg fw-semibold" required>
                                        <option value="1" {{ $pengaduan->status == '1' ? 'selected' : '' }}>
                                            ⏳ Sedang Diproses
                                        </option>
                                        <option value="2" {{ $pengaduan->status == '2' ? 'selected' : '' }}>
                                            ❌ Ditolak / Tidak Valid
                                        </option>
                                        <option value="3" {{ $pengaduan->status == '3' ? 'selected' : '' }}>
                                            ✅ Selesai Ditangani
                                        </option>
                                    </select>
                                </div>

                                <div class="p-3 bg-light rounded-3 border mb-4">
                                    <div class="fw-bold text-dark fs-7 mb-1">
                                        <i class="fas fa-info-circle text-primary me-1"></i> Informasi Alur Penanganan:
                                    </div>
                                    <ul class="text-muted fs-8 ps-3 mb-0" style="line-height: 1.6;">
                                        <li><strong>Sedang Diproses:</strong> Laporan telah diterima dan petugas desa sedang melakukan pengecekan ke lapangan.</li>
                                        <li><strong>Ditolak:</strong> Laporan palsu, tidak relevan, atau tidak menyertakan bukti yang sah.</li>
                                        <li><strong>Selesai Ditangani:</strong> Masalah telah terselesaikan oleh pihak yang berwenang.</li>
                                    </ul>
                                </div>

                                <div class="d-flex align-items-center justify-content-end gap-2 pt-3 border-top">
                                    <a href="{{ route('admin.pengaduan-index') }}" class="btn-admin-secondary">
                                        <i class="fas fa-times"></i> Batal
                                    </a>
                                    <button type="submit" class="btn-admin-primary px-3 py-2">
                                        <i class="fas fa-save me-1"></i> Simpan Perubahan Status
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <x-app.footer />
        </div>
    </main>
</x-app-layout>