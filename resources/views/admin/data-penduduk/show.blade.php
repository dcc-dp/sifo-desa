<x-app-layout>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
        <x-app.navbar />

        <div class="container-fluid py-4 px-5">

            <!-- PAGE HEADER -->
            <div class="admin-page-header">
                <div>
                    <div class="d-flex align-items-center gap-2 mb-1">
                        <a href="{{ route('data.penduduk-index') }}" class="btn-admin-secondary py-1 px-2 fs-7">
                            <i class="fas fa-arrow-left"></i> Kembali
                        </a>
                        <span class="text-muted">/</span>
                        <span class="badge bg-light text-dark border px-2 py-1 fs-7">Data Penduduk</span>
                        <span class="text-muted">/</span>
                        <span class="text-muted fs-7">Detail</span>
                    </div>
                    <h2 class="admin-page-title">
                        <i class="fas fa-id-card"></i>
                        <span>Detail Data Penduduk</span>
                    </h2>
                    <p class="admin-page-subtitle">Informasi lengkap biodata dan catatan administrasi kependudukan warga desa</p>
                </div>
                <div>
                    <a href="{{ route('data.penduduk-edit', $data->id) }}" class="btn-admin-primary">
                        <i class="fas fa-edit"></i>
                        <span>Edit Data Warga</span>
                    </a>
                </div>
            </div>

            <!-- MAIN GRID -->
            <div class="row g-4">

                <!-- LEFT COLUMN: CITIZEN PROFILE CARD -->
                <div class="col-lg-4 col-md-5">
                    <div class="admin-card text-center p-4">
                        <div class="d-flex justify-content-center mb-3">
                            <div class="citizen-avatar">
                                {{ strtoupper(substr($data->nama, 0, 2)) }}
                            </div>
                        </div>

                        <h4 class="fw-bold text-dark mb-1">{{ $data->nama }}</h4>

                        <div class="d-inline-flex align-items-center gap-2 bg-light border rounded-pill px-3 py-1 mb-3">
                            <i class="fas fa-id-card text-success fs-7"></i>
                            <span class="font-monospace fw-bold text-dark fs-7">{{ $data->nik }}</span>
                        </div>

                        <div class="d-flex flex-wrap gap-2 justify-content-center mb-4">
                            <span class="badge-status {{ $data->jenis_kelamin == 'L' ? 'badge-status-info' : 'badge-status-danger' }}">
                                <i class="fas {{ $data->jenis_kelamin == 'L' ? 'fa-mars' : 'fa-venus' }}"></i>
                                {{ $data->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}
                            </span>
                            <span class="badge-status badge-status-pending">
                                <i class="fas fa-heart"></i>
                                {{ $data->status_perkawinan }}
                            </span>
                        </div>

                        <div class="text-start pt-3 border-top">
                            <div class="d-flex justify-content-between align-items-center py-2 border-bottom">
                                <span class="text-muted fs-8"><i class="fas fa-map-marker-alt me-1 text-muted"></i> Wilayah</span>
                                <span class="fw-bold text-dark fs-8">RT {{ $data->rt->nomor_rt ?? '-' }} / RW {{ $data->rw->nomor_rw ?? '-' }}</span>
                            </div>
                            <div class="d-flex justify-content-between align-items-center py-2 border-bottom">
                                <span class="text-muted fs-8"><i class="fas fa-briefcase me-1 text-muted"></i> Pekerjaan</span>
                                <span class="badge-kategori">{{ $data->pekerjaan }}</span>
                            </div>
                            <div class="d-flex justify-content-between align-items-center py-2 border-bottom">
                                <span class="text-muted fs-8"><i class="fas fa-graduation-cap me-1 text-muted"></i> Pendidikan</span>
                                <span class="fw-bold text-dark fs-8">{{ $data->pendidikan ?? '-' }}</span>
                            </div>
                            <div class="d-flex justify-content-between align-items-center py-2 border-bottom">
                                <span class="text-muted fs-8"><i class="fas fa-file-signature me-1 text-muted"></i> Arsip Surat</span>
                                <span class="badge bg-light text-dark border px-2 py-1 fs-8">{{ $data->surats->count() }} Surat</span>
                            </div>
                            <div class="d-flex justify-content-between align-items-center py-2">
                                <span class="text-muted fs-8"><i class="fas fa-user-circle me-1 text-muted"></i> Akun Warga</span>
                                @if($data->user)
                                    <span class="badge-status badge-status-success fs-8">
                                        <i class="fas fa-check"></i> Terdaftar
                                    </span>
                                @else
                                    <span class="badge bg-light text-muted border px-2 py-1 fs-8">
                                        Belum Ada
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="mt-4 pt-2">
                            <a href="{{ route('data.penduduk-edit', $data->id) }}" class="btn-admin-primary w-100 justify-content-center">
                                <i class="fas fa-user-edit"></i> Ubah Biodata Warga
                            </a>
                        </div>
                    </div>
                </div>

                <!-- RIGHT COLUMN: DETAILED SPECIFICATIONS -->
                <div class="col-lg-8 col-md-7">

                    <!-- SECTION 1: DATA IDENTITAS PRIBADI -->
                    <div class="profile-detail-card mb-4">
                        <div class="profile-detail-header">
                            <div class="d-flex align-items-center gap-2">
                                <i class="fas fa-user-check"></i>
                                <span>Data Identitas Pribadi</span>
                            </div>
                            <span class="badge bg-light text-muted border px-2 py-1 fs-8">Wajib KTP</span>
                        </div>
                        <div class="profile-detail-body">
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <div class="detail-item">
                                        <span class="detail-label"><i class="fas fa-id-badge"></i> Nomor Induk Kependudukan (NIK)</span>
                                        <div class="detail-value font-monospace fs-6 text-success fw-bold">{{ $data->nik }}</div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="detail-item">
                                        <span class="detail-label"><i class="fas fa-user"></i> Nama Lengkap</span>
                                        <div class="detail-value">{{ $data->nama }}</div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="detail-item">
                                        <span class="detail-label"><i class="fas fa-calendar-alt"></i> Tempat & Tanggal Lahir</span>
                                        <div class="detail-value">
                                            {{ $data->tempat_lahir }}, {{ \Carbon\Carbon::parse($data->tanggal_lahir)->translatedFormat('d F Y') }}
                                            <small class="text-muted font-normal">({{ \Carbon\Carbon::parse($data->tanggal_lahir)->age }} tahun)</small>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="detail-item">
                                        <span class="detail-label"><i class="fas fa-venus-mars"></i> Jenis Kelamin</span>
                                        <div class="detail-value">
                                            {{ $data->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="detail-item">
                                        <span class="detail-label"><i class="fas fa-pray"></i> Agama</span>
                                        <div class="detail-value">{{ $data->agama }}</div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="detail-item">
                                        <span class="detail-label"><i class="fas fa-ring"></i> Status Perkawinan</span>
                                        <div class="detail-value">{{ $data->status_perkawinan }}</div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="detail-item">
                                        <span class="detail-label"><i class="fas fa-flag"></i> Kewarganegaraan</span>
                                        <div class="detail-value">
                                            <span class="badge bg-light text-dark border px-2 py-1">{{ $data->kewarganegaraan }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- SECTION 2: ALAMAT & WILAYAH ADMINISTRASI -->
                    <div class="profile-detail-card mb-4">
                        <div class="profile-detail-header">
                            <div class="d-flex align-items-center gap-2">
                                <i class="fas fa-map-marked-alt"></i>
                                <span>Alamat & Wilayah Domisili</span>
                            </div>
                            <span class="badge bg-light text-muted border px-2 py-1 fs-8">Wilayah Desa</span>
                        </div>
                        <div class="profile-detail-body">
                            <div class="row g-3">
                                <div class="col-12">
                                    <div class="detail-item">
                                        <span class="detail-label"><i class="fas fa-home"></i> Alamat Tempat Tinggal Lengkap</span>
                                        <div class="detail-value">{{ $data->alamat }}</div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="detail-item">
                                        <span class="detail-label"><i class="fas fa-map-pin"></i> Rukun Tetangga (RT)</span>
                                        <div class="detail-value">
                                            <span class="badge bg-light text-dark border px-3 py-1 fs-7">RT {{ $data->rt->nomor_rt ?? '-' }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="detail-item">
                                        <span class="detail-label"><i class="fas fa-map-signs"></i> Rukun Warga (RW)</span>
                                        <div class="detail-value">
                                            <span class="badge bg-light text-dark border px-3 py-1 fs-7">RW {{ $data->rw->nomor_rw ?? '-' }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="detail-item">
                                        <span class="detail-label"><i class="fas fa-building"></i> Desa / Kelurahan</span>
                                        <div class="detail-value">{{ $data->keldesa }}</div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="detail-item">
                                        <span class="detail-label"><i class="fas fa-landmark"></i> Kecamatan</span>
                                        <div class="detail-value">{{ $data->kecamatan }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- SECTION 3: PENDIDIKAN & PEKERJAAN -->
                    <div class="profile-detail-card">
                        <div class="profile-detail-header">
                            <div class="d-flex align-items-center gap-2">
                                <i class="fas fa-briefcase"></i>
                                <span>Pendidikan & Pekerjaan</span>
                            </div>
                            <span class="badge bg-light text-muted border px-2 py-1 fs-8">Sosial Ekonomi</span>
                        </div>
                        <div class="profile-detail-body">
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <div class="detail-item">
                                        <span class="detail-label"><i class="fas fa-user-tie"></i> Pekerjaan Saat Ini</span>
                                        <div class="detail-value">
                                            <span class="badge-kategori px-3 py-1 fs-7">{{ $data->pekerjaan }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="detail-item">
                                        <span class="detail-label"><i class="fas fa-graduation-cap"></i> Jenjang Pendidikan Terakhir</span>
                                        <div class="detail-value">{{ $data->pendidikan ?? '-' }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <x-app.footer />
        </div>
    </main>
</x-app-layout>
