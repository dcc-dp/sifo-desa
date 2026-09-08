<x-app-layout>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
        <x-app.navbar />

        <div class="container-fluid py-4 px-5">

            <!-- PAGE HEADER -->
            <div class="admin-page-header">
                <div>
                    <h2 class="admin-page-title">
                        <i class="fas fa-cogs text-primary me-2"></i>
                        <span>Pengaturan Identitas Desa</span>
                    </h2>
                    <p class="admin-page-subtitle">Kelola nama resmi dan selayang pandang/uraian singkat tentang desa</p>
                </div>
            </div>

            <!-- ALERT -->
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show mb-4 text-white border-0" style="background: #15803d;" role="alert">
                    <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <form action="{{ route('admin.setting.update') }}" method="POST">
                @csrf
                @method('PUT')

                <div class="row g-4">
                    <!-- INFORMASI DESA -->
                    <div class="col-12">
                        <div class="admin-card mb-0">
                            <div class="admin-card-header">
                                <h5 class="admin-card-title">
                                    <i class="fas fa-info-circle text-primary me-1"></i>
                                    <span>Identitas Umum Desa</span>
                                </h5>
                            </div>
                            <div class="card-body p-4">
                                <div class="mb-4">
                                    <label class="admin-form-label fs-6 fw-bold">Nama Resmi Desa <span class="required">*</span></label>
                                    <input type="text" name="nama_desa"
                                        class="form-control form-control-lg @error('nama_desa') is-invalid @enderror"
                                        value="{{ old('nama_desa', $setting->nama_desa) }}" required
                                        placeholder="Contoh: Desa Harapan Hijau">
                                    @error('nama_desa')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-0">
                                    <label class="admin-form-label fs-6 fw-bold">Uraian / Selayang Pandang Desa</label>
                                    <textarea name="deskripsi" rows="6" class="form-control"
                                        placeholder="Desa Harapan Hijau merupakan desa pelayanan publik berbasis teknologi informasi. Melalui Sistem Informasi Desa (SIFO Desa), masyarakat dapat mengakses informasi, layanan administrasi, pengaduan, dan berbagai kegiatan desa secara cepat, transparan, dan mudah.">{{ old('deskripsi', $setting->deskripsi) }}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="d-flex align-items-center justify-content-end gap-2 pt-4 mt-2">
                    <button type="submit" class="btn-admin-primary px-4 py-2 fs-6">
                        <i class="fas fa-save me-1"></i> Simpan Setting
                    </button>
                </div>
            </form>

            <x-app.footer />
        </div>
    </main>
</x-app-layout>