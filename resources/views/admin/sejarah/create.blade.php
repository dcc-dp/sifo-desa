<x-app-layout>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
        <x-app.navbar />
        <div class="container-fluid py-4 px-5">

            <!-- PAGE HEADER -->
            <div class="admin-page-header">
                <div>
                    <div class="d-flex align-items-center gap-2 mb-1">
                        <a href="{{ route('sejarah-index') }}" class="btn-admin-secondary py-1 px-2 fs-7">
                            <i class="fas fa-arrow-left"></i> Kembali
                        </a>
                        <span class="text-muted">/</span>
                        <span class="badge bg-light text-dark border px-2 py-1 fs-7">Sejarah Desa</span>
                    </div>
                    <h2 class="admin-page-title">
                        <i class="fas fa-landmark"></i>
                        <span>Tambah Data Sejarah</span>
                    </h2>
                    <p class="admin-page-subtitle">Tuliskan narasi sejarah atau babak perjalanan perkembangan desa</p>
                </div>
            </div>

            <!-- FORM CARD -->
            <div class="admin-card">
                <div class="admin-card-header">
                    <h5 class="admin-card-title">
                        <i class="fas fa-book-open text-muted"></i>
                        <span>Formulir Sejarah</span>
                    </h5>
                </div>
                <div class="card-body p-4">
                    <form action="{{ route('sejarah-store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="mb-3">
                            <label for="judul" class="admin-form-label">Judul Periode / Babak Sejarah <span class="required">*</span></label>
                            <input type="text" name="judul" id="judul" value="{{ old('judul') }}"
                                class="form-control @error('judul') is-invalid @enderror"
                                placeholder="Contoh: Awal Mula Berdirinya Desa..." required>
                            @error('judul')
                                <span class="text-danger text-xs mt-1 d-block">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="gambar" class="admin-form-label">Foto / Dokumen Sejarah</label>
                            <input type="file" name="gambar" id="gambar" class="form-control @error('gambar') is-invalid @enderror" accept="image/*">
                            <small class="text-muted fs-8 mt-1 d-block">Format: JPG, JPEG, PNG, WEBP (Maksimal 2MB)</small>
                            @error('gambar')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="deskripsi" class="admin-form-label">Uraian / Narasi Lengkap <span class="required">*</span></label>
                            <textarea name="deskripsi" id="deskripsi" rows="6"
                                class="form-control @error('deskripsi') is-invalid @enderror"
                                placeholder="Tuliskan kisah sejarah secara runtut dan jelas..." required>{{ old('deskripsi') }}</textarea>
                            @error('deskripsi')
                                <span class="text-danger text-xs mt-1 d-block">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="d-flex align-items-center justify-content-end gap-2 pt-3 border-top">
                            <a href="{{ route('sejarah-index') }}" class="btn-admin-secondary">
                                <i class="fas fa-times"></i> Batal
                            </a>
                            <button type="submit" class="btn-admin-primary">
                                <i class="fas fa-save"></i> Simpan Sejarah
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <x-app.footer />
        </div>
    </main>
</x-app-layout>