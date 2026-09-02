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
                        <i class="fas fa-edit"></i>
                        <span>Edit Data Sejarah</span>
                    </h2>
                    <p class="admin-page-subtitle">Perbarui judul, foto, atau narasi babak sejarah desa</p>
                </div>
            </div>

            <!-- ALERT -->
            @if (session('error'))
                <div class="alert alert-danger mb-4" role="alert">{{ session('error') }}</div>
            @endif
            @if (session('success'))
                <div class="alert alert-success mb-4 text-white border-0" style="background: #15803d;" role="alert">{{ session('success') }}</div>
            @endif

            <!-- FORM CARD -->
            <div class="admin-card">
                <div class="admin-card-header">
                    <h5 class="admin-card-title">
                        <i class="fas fa-book-open text-muted"></i>
                        <span>Formulir Perubahan Sejarah</span>
                    </h5>
                </div>
                <div class="card-body p-4">
                    <form action="{{ route('sejarah-update', $data->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="judul" class="admin-form-label">Judul Periode / Babak Sejarah <span class="required">*</span></label>
                            <input type="text" name="judul" id="judul"
                                value="{{ old('judul', $data->judul) }}"
                                class="form-control @error('judul') is-invalid @enderror" required>
                            @error('judul')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="gambar" class="admin-form-label">Foto / Dokumen Sejarah</label>
                            <input type="file" name="gambar" id="gambar" class="form-control" accept="image/*">
                            <small class="text-muted fs-8 mt-1 d-block">Kosongkan jika tidak ingin mengubah gambar.</small>

                            <div class="mt-2">
                                <span class="text-xs text-muted d-block mb-1">Foto saat ini:</span>
                                @if($data->gambar && file_exists(public_path($data->gambar)))
                                    <img src="{{ asset($data->gambar) }}" alt="{{ $data->judul }}" class="table-thumb" style="width: 80px; height: 80px;">
                                @else
                                    <span class="badge bg-light text-muted border px-2 py-1 fs-8">Belum ada gambar</span>
                                @endif
                            </div>
                        </div>

                        <div class="mb-4">
                            <label for="deskripsi" class="admin-form-label">Uraian / Narasi Lengkap <span class="required">*</span></label>
                            <textarea name="deskripsi" id="deskripsi" rows="6"
                                class="form-control @error('deskripsi') is-invalid @enderror" required>{{ old('deskripsi', $data->deskripsi) }}</textarea>
                            @error('deskripsi')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex align-items-center justify-content-end gap-2 pt-3 border-top">
                            <a href="{{ route('sejarah-index') }}" class="btn-admin-secondary">
                                <i class="fas fa-times"></i> Batal
                            </a>
                            <button type="submit" class="btn-admin-primary">
                                <i class="fas fa-save"></i> Perbarui Data Sejarah
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <x-app.footer />
        </div>
    </main>
</x-app-layout>
