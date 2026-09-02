<x-app-layout>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
        <x-app.navbar />
        <div class="container-fluid py-4 px-5">

            <!-- PAGE HEADER -->
            <div class="admin-page-header">
                <div>
                    <div class="d-flex align-items-center gap-2 mb-1">
                        <a href="{{ route('admin.pengajuan-surat.index') }}" class="btn-admin-secondary py-1 px-2 fs-7">
                            <i class="fas fa-arrow-left"></i> Kembali
                        </a>
                        <span class="text-muted">/</span>
                        <span class="badge bg-light text-dark border px-2 py-1 fs-7">Pengajuan Surat</span>
                        <span class="text-muted">/</span>
                        <span class="text-muted fs-7">Detail Permohonan</span>
                    </div>
                    <h2 class="admin-page-title">
                        <i class="fas fa-file-invoice"></i>
                        <span>Detail Pengajuan Surat</span>
                    </h2>
                    <p class="admin-page-subtitle">Pemeriksaan kelengkapan berkas kependudukan dan keputusan penerbitan surat resmi</p>
                </div>
                <div class="d-flex align-items-center gap-2 flex-wrap">
                    @if ($surat->status == 'menunggu')
                        <button type="button" class="btn-admin-primary" data-bs-toggle="modal" data-bs-target="#modalTerima">
                            <i class="fas fa-check-circle"></i> Setujui & Terbitkan
                        </button>
                        <button type="button" class="btn-action-delete px-3 py-2 text-danger fw-bold rounded-3 border-danger d-inline-flex align-items-center gap-1"
                            data-bs-toggle="modal" data-bs-target="#modalTolak">
                            <i class="fas fa-times-circle"></i> Tolak Surat
                        </button>
                    @elseif ($surat->status == 'diterima')
                        <a href="{{ route('surat.download', $surat->id) }}" class="btn-action-pill btn-action-pdf px-3 py-2 fw-bold fs-7">
                            <i class="fas fa-file-pdf"></i> Unduh Salinan PDF
                        </a>
                    @endif
                </div>
            </div>

            <!-- ALERT -->
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show mb-4 text-white border-0" style="background: #15803d;" role="alert">
                    <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert"></button>
                </div>
            @endif
            @if (session('error'))
                <div class="alert alert-danger alert-dismissible fade show mb-4 text-white border-0 bg-danger" role="alert">
                    <i class="fas fa-exclamation-circle me-2"></i>{{ session('error') }}
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <!-- STATUS BANNER -->
            <div class="mb-4">
                @if ($surat->status == 'menunggu')
                    <div class="p-3 bg-light border-start border-4 border-warning rounded-3 d-flex align-items-center justify-content-between flex-wrap gap-2">
                        <div class="d-flex align-items-center gap-3">
                            <span class="badge-status badge-status-pending fs-6 px-3 py-2">
                                <i class="fas fa-clock"></i> Status: Menunggu Verifikasi
                            </span>
                            <span class="text-muted fs-7">Surat ini diajukan pada {{ \Carbon\Carbon::parse($surat->tanggal_dibuat)->translatedFormat('d F Y') }}</span>
                        </div>
                        <span class="text-muted fs-8 fst-italic">
                            Nomor surat resmi akan ditetapkan saat Anda menyetujui permohonan ini.
                        </span>
                    </div>
                @elseif($surat->status == 'diterima')
                    <div class="p-3 bg-light border-start border-4 border-success rounded-3 d-flex align-items-center justify-content-between flex-wrap gap-2">
                        <div class="d-flex align-items-center gap-3">
                            <span class="badge-status badge-status-success fs-6 px-3 py-2">
                                <i class="fas fa-check-circle"></i> Status: Disetujui & Diterbitkan
                            </span>
                            <span class="text-muted fs-7">Dokumen resmi telah dicetak dan siap diserahkan kepada pemohon.</span>
                        </div>
                        <div class="d-inline-flex align-items-center gap-2 bg-white border px-3 py-1 rounded-pill">
                            <span class="text-muted fs-7">Nomor Surat Resmi:</span>
                            <span class="font-monospace fw-bold text-success fs-6">{{ $surat->nomor_surat }}</span>
                        </div>
                    </div>
                @elseif($surat->status == 'ditolak')
                    <div class="p-3 bg-light border-start border-4 border-danger rounded-3 d-flex align-items-center justify-content-between flex-wrap gap-2">
                        <div class="d-flex align-items-center gap-3">
                            <span class="badge-status badge-status-danger fs-6 px-3 py-2">
                                <i class="fas fa-times-circle"></i> Status: Ditolak
                            </span>
                            <span class="text-danger fs-7"><strong>Alasan:</strong> {{ $surat->alasan_tolak ?? 'Permohonan tidak memenuhi persyaratan.' }}</span>
                        </div>
                    </div>
                @endif
            </div>

            <!-- TWO-COLUMN DETAIL GRID -->
            <div class="row g-4">

                <!-- CARD 1: DATA IDENTITAS PEMOHON -->
                <div class="col-lg-6">
                    <div class="profile-detail-card h-100 mb-0">
                        <div class="profile-detail-header">
                            <div class="d-flex align-items-center gap-2">
                                <i class="fas fa-user-circle"></i>
                                <span>Data Identitas Pemohon</span>
                            </div>
                            <span class="badge bg-light text-muted border px-2 py-1 fs-8">Warga Desa</span>
                        </div>
                        <div class="profile-detail-body">
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <div class="detail-item">
                                        <span class="detail-label"><i class="fas fa-hashtag"></i> Nomor Surat</span>
                                        <div class="detail-value">
                                            @if ($surat->nomor_surat)
                                                <span class="font-monospace fw-bold text-success fs-6">{{ $surat->nomor_surat }}</span>
                                            @else
                                                <span class="badge bg-light text-muted border fs-8">Belum Terbit (Diisi saat disetujui)</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="detail-item">
                                        <span class="detail-label"><i class="fas fa-id-card"></i> NIK Pemohon</span>
                                        <div class="detail-value font-monospace text-dark fw-bold">{{ $surat->penduduk->nik ?? '-' }}</div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="detail-item">
                                        <span class="detail-label"><i class="fas fa-user"></i> Nama Lengkap</span>
                                        <div class="detail-value">{{ $surat->penduduk->nama ?? '-' }}</div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="detail-item">
                                        <span class="detail-label"><i class="fas fa-calendar-alt"></i> Tempat & Tanggal Lahir</span>
                                        <div class="detail-value">
                                            {{ $surat->penduduk->tempat_lahir ?? '-' }}, {{ $surat->penduduk->tanggal_lahir ?? '-' }}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="detail-item">
                                        <span class="detail-label"><i class="fas fa-venus-mars"></i> Jenis Kelamin</span>
                                        <div class="detail-value">
                                            {{ ($surat->penduduk->jenis_kelamin ?? '') == 'L' ? 'Laki-Laki' : 'Perempuan' }}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="detail-item">
                                        <span class="detail-label"><i class="fas fa-briefcase"></i> Pekerjaan</span>
                                        <div class="detail-value">
                                            <span class="badge-kategori">{{ $surat->penduduk->pekerjaan ?? '-' }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="detail-item">
                                        <span class="detail-label"><i class="fas fa-map-marker-alt"></i> Alamat Tempat Tinggal</span>
                                        <div class="detail-value">
                                            {{ $surat->penduduk->alamat ?? '-' }}
                                            <span class="badge bg-light text-dark border ms-1">RT {{ $surat->penduduk->rt->nomor_rt ?? '-' }} / RW {{ $surat->penduduk->rw->nomor_rw ?? '-' }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- CARD 2: DETAIL JENIS & KEPERLUAN SURAT -->
                <div class="col-lg-6">
                    <div class="profile-detail-card h-100 mb-0">
                        <div class="profile-detail-header">
                            <div class="d-flex align-items-center gap-2">
                                <i class="fas fa-file-contract"></i>
                                <span>Detail Jenis & Spesifikasi Surat</span>
                            </div>
                            <span class="badge bg-light text-success border border-success-subtle px-2 py-1 fs-8">
                                {{ $surat->keterangan }}
                            </span>
                        </div>
                        <div class="profile-detail-body">
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <div class="detail-item">
                                        <span class="detail-label"><i class="fas fa-tag"></i> Jenis Permohonan</span>
                                        <div class="detail-value text-success fw-bold">{{ $surat->keterangan }}</div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="detail-item">
                                        <span class="detail-label"><i class="fas fa-calendar-check"></i> Tanggal Pengajuan</span>
                                        <div class="detail-value">{{ \Carbon\Carbon::parse($surat->tanggal_dibuat)->translatedFormat('d F Y') }}</div>
                                    </div>
                                </div>

                                {{-- Data Khusus Surat Usaha --}}
                                @if ($surat->usaha)
                                    <div class="col-12">
                                        <div class="detail-item">
                                            <span class="detail-label"><i class="fas fa-store"></i> Nama Usaha / Toko</span>
                                            <div class="detail-value fw-bold fs-6 text-dark">{{ $surat->usaha->nama_usaha }}</div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="detail-item">
                                            <span class="detail-label"><i class="fas fa-map-pin"></i> Alamat Lokasi Usaha</span>
                                            <div class="detail-value">{{ $surat->usaha->alamat_usaha }}</div>
                                        </div>
                                    </div>
                                @endif

                                {{-- Data Khusus Domisili --}}
                                @if ($surat->domisili)
                                    <div class="col-12">
                                        <div class="detail-item">
                                            <span class="detail-label"><i class="fas fa-clipboard-list"></i> Keperluan Surat Domisili</span>
                                            <div class="detail-value">{{ $surat->domisili->keperluan }}</div>
                                        </div>
                                    </div>
                                @endif

                                {{-- Data Khusus Pengantar --}}
                                @if ($surat->pengantar)
                                    <div class="col-12">
                                        <div class="detail-item">
                                            <span class="detail-label"><i class="fas fa-clipboard-list"></i> Keperluan Surat Pengantar</span>
                                            <div class="detail-value">{{ $surat->pengantar->keperluan }}</div>
                                        </div>
                                    </div>
                                @endif

                                {{-- Data Khusus SKTM --}}
                                @if ($surat->sktm)
                                    <div class="col-md-6">
                                        <div class="detail-item">
                                            <span class="detail-label"><i class="fas fa-user-tie"></i> Pekerjaan Wali / Kepala Keluarga</span>
                                            <div class="detail-value">{{ $surat->sktm->pekerjaan }}</div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="detail-item">
                                            <span class="detail-label"><i class="fas fa-money-bill-wave"></i> Penghasilan Bulanan</span>
                                            <div class="detail-value font-monospace fw-bold text-success fs-6">
                                                Rp {{ number_format($surat->sktm->penghasilan, 0, ',', '.') }}
                                            </div>
                                        </div>
                                    </div>
                                @endif

                                {{-- Data Khusus Izin Keramaian --}}
                                @if ($surat->izin)
                                    <div class="col-md-6">
                                        <div class="detail-item">
                                            <span class="detail-label"><i class="fas fa-calendar-day"></i> Hari & Tanggal Pelaksanaan</span>
                                            <div class="detail-value">{{ $surat->izin->hari }}, {{ $surat->izin->tanggal }}</div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="detail-item">
                                            <span class="detail-label"><i class="fas fa-users"></i> Estimasi Peserta / Tamu</span>
                                            <div class="detail-value">
                                                <span class="badge bg-light text-dark border px-2 py-1">{{ $surat->izin->jumlah_peserta }} Orang</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="detail-item">
                                            <span class="detail-label"><i class="fas fa-glass-cheers"></i> Jenis Acara / Kegiatan</span>
                                            <div class="detail-value">{{ $surat->izin->jenis_acara }}</div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="detail-item">
                                            <span class="detail-label"><i class="fas fa-map-marker-alt"></i> Lokasi Tempat Acara</span>
                                            <div class="detail-value">{{ $surat->izin->tempat }}</div>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <x-app.footer />
        </div>
    </main>

    <!-- MODAL SETUJUI & TERBITKAN SURAT (DENGAN PENOMORAN RESMI) -->
    <div class="modal fade" id="modalTerima" tabindex="-1" aria-labelledby="modalTerimaLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow-lg" style="border-radius: 16px; overflow: hidden;">
                <div class="modal-header bg-success text-white border-0 py-3">
                    <h5 class="modal-title text-white fs-6 fw-bold" id="modalTerimaLabel">
                        <i class="fas fa-file-signature me-2"></i> Konfirmasi Penerbitan Surat Resmi
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('admin.pengajuan-surat.terima', $surat->id) }}" method="POST">
                    @csrf
                    @method('PATCH')
                    <div class="modal-body p-4">
                        <div class="p-3 bg-light rounded-3 border mb-3">
                            <div class="d-flex align-items-center gap-2 mb-1">
                                <i class="fas fa-file-alt text-success"></i>
                                <span class="fw-bold text-dark">{{ $surat->keterangan }}</span>
                            </div>
                            <div class="text-muted fs-7">
                                Pemohon: <strong>{{ $surat->penduduk->nama ?? '-' }}</strong> (NIK: {{ $surat->penduduk->nik ?? '-' }})
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="nomor_surat" class="admin-form-label fw-bold text-dark fs-6">
                                Nomor Urut Surat Resmi <span class="required">*</span>
                            </label>
                            <div class="input-group">
                                <span class="input-group-text bg-light text-dark fw-bold border">No.</span>
                                <input type="text" name="nomor_surat" id="nomor_surat"
                                    class="form-control font-monospace fw-bold fs-5 text-success @error('nomor_surat') is-invalid @enderror"
                                    value="{{ old('nomor_surat', $nextNomorSurat) }}" required
                                    placeholder="Contoh: 006">
                            </div>
                            <small class="text-muted fs-8 mt-2 d-block" style="line-height: 1.5;">
                                <i class="fas fa-info-circle text-primary me-1"></i>
                                <strong>Panduan:</strong> Masukkan nomor awal untuk pertama kali (misal: <code>006</code> untuk melanjutkan buku register fisik desa). Untuk surat-surat berikutnya, sistem akan <strong>otomatis melanjutkan nomor urut berikutnya</strong> secara berurutan tanpa perlu diinput lagi.
                            </small>
                        </div>
                    </div>
                    <div class="modal-footer bg-light border-0 py-3 px-4 d-flex justify-content-end gap-2">
                        <button type="button" class="btn-admin-secondary" data-bs-dismiss="modal">
                            Batal
                        </button>
                        <button type="submit" class="btn-admin-primary px-3 py-2">
                            <i class="fas fa-check-circle me-1"></i> Setujui & Terbitkan Dokumen
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- MODAL TOLAK SURAT -->
    <div class="modal fade" id="modalTolak" tabindex="-1" aria-labelledby="modalTolakLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow-lg" style="border-radius: 16px; overflow: hidden;">
                <div class="modal-header bg-danger text-white border-0 py-3">
                    <h5 class="modal-title text-white fs-6 fw-bold" id="modalTolakLabel">
                        <i class="fas fa-exclamation-triangle me-2"></i> Konfirmasi Penolakan Surat
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('admin.pengajuan-surat.tolak', $surat->id) }}" method="POST">
                    @csrf
                    @method('PATCH')
                    <div class="modal-body p-4">
                        <p class="text-sm text-secondary mb-3">
                            Harap masukkan alasan penolakan agar pemohon dapat memperbaiki data atau berkas yang kurang:
                        </p>
                        <div class="form-group mb-0">
                            <label for="alasan_tolak" class="admin-form-label">Alasan Penolakan <span class="required">*</span></label>
                            <textarea name="alasan_tolak" id="alasan_tolak" class="form-control" rows="4"
                                placeholder="Contoh: NIK tidak sesuai dengan data KTP, atau dokumen pendukung belum lengkap..." required></textarea>
                        </div>
                    </div>
                    <div class="modal-footer bg-light border-0 py-3 px-4 d-flex justify-content-end gap-2">
                        <button type="button" class="btn-admin-secondary" data-bs-dismiss="modal">
                            Batal
                        </button>
                        <button type="submit" class="btn btn-danger btn-sm px-3 py-2 fw-semibold" style="border-radius: 8px;">
                            <i class="fas fa-times-circle me-1"></i> Tolak Pengajuan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
