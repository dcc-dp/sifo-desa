<x-app-layout>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
        <x-app.navbar />

        <div class="container-fluid py-4 px-5">

            <!-- PAGE HEADER -->
            <div class="admin-page-header">
                <div>
                    <div class="d-flex align-items-center gap-2 mb-1">
                        <a href="{{ route('batchgaleri.show', $batch->id) }}" class="btn-admin-secondary py-1 px-2 fs-7">
                            <i class="fas fa-arrow-left"></i> Kembali ke Album
                        </a>
                        <span class="text-muted">/</span>
                        <span class="badge bg-light text-dark border px-2 py-1 fs-7">{{ $batch->nama }}</span>
                    </div>
                    <h2 class="admin-page-title">
                        <i class="fas fa-camera"></i>
                        <span>Upload Foto ke Album</span>
                    </h2>
                    <p class="admin-page-subtitle">Tambahkan gambar dokumentasi baru ke dalam album <strong>{{ $batch->nama }}</strong></p>
                </div>
            </div>

            <!-- ALERT -->
            @if (session('success'))
                <div class="alert alert-success mb-4 text-white border-0" style="background: #15803d;" role="alert">
                    {{ session('success') }}
                </div>
            @endif

            <!-- FORM CARD -->
            <div class="admin-card">
                <div class="admin-card-header">
                    <h5 class="admin-card-title">
                        <i class="fas fa-upload text-muted"></i>
                        <span>Formulir Unggah Foto</span>
                    </h5>
                </div>
                <div class="card-body p-4">
                    <form action="{{ route('galeri.store', $batch->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="mb-3">
                            <label for="judul" class="admin-form-label">Keterangan / Judul Foto <span class="required">*</span></label>
                            <input type="text" name="judul" id="judul" class="form-control @error('judul') is-invalid @enderror"
                                value="{{ old('judul') }}" placeholder="Contoh: Kerja bakti membersihkan balai desa..." required>
                            @error('judul')
                                <span class="text-danger text-xs mt-1 d-block">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="gambar" class="admin-form-label">Pilih File Foto <span class="required">*</span></label>
                            <input type="file" name="gambar" id="gambar" class="form-control @error('gambar') is-invalid @enderror"
                                accept="image/*" required>
                            <small class="text-muted fs-8 mt-1 d-block">Format gambar: JPG, JPEG, PNG, WEBP (Maksimal 3MB)</small>
                            @error('gambar')
                                <span class="text-danger text-xs mt-1 d-block">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="d-flex align-items-center justify-content-end gap-2 pt-3 border-top">
                            <a href="{{ route('batchgaleri.show', $batch->id) }}" class="btn-admin-secondary">
                                <i class="fas fa-times"></i> Batal
                            </a>
                            <button type="submit" class="btn-admin-primary">
                                <i class="fas fa-cloud-upload-alt"></i> Unggah Foto
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <x-app.footer />
        </div>
    </main>
</x-app-layout>
