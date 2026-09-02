<x-app-layout>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
        <x-app.navbar />
        <div class="container-fluid py-4 px-5">

            <!-- PAGE HEADER -->
            <div class="admin-page-header">
                <div>
                    <div class="d-flex align-items-center gap-2 mb-1">
                        <a href="{{ route('berita-index') }}" class="btn-admin-secondary py-1 px-2 fs-7">
                            <i class="fas fa-arrow-left"></i> Kembali
                        </a>
                        <span class="text-muted">/</span>
                        <span class="badge bg-light text-dark border px-2 py-1 fs-7">Berita Desa</span>
                    </div>
                    <h2 class="admin-page-title">
                        <i class="fas fa-newspaper"></i>
                        <span>Tambah Berita Baru</span>
                    </h2>
                    <p class="admin-page-subtitle">Tulis dan publikasikan informasi berita atau pengumuman desa</p>
                </div>
            </div>

            <!-- ALERT -->
            @if (session('error'))
                <div class="alert alert-danger mb-4" role="alert" id="alert">
                    {{ session('error') }}
                </div>
            @endif
            @if (session('success'))
                <div class="alert alert-success mb-4 text-white border-0" style="background: #15803d;" role="alert" id="alert">
                    {{ session('success') }}
                </div>
            @endif

            <!-- FORM CARD -->
            <div class="admin-card">
                <div class="admin-card-header">
                    <h5 class="admin-card-title">
                        <i class="fas fa-edit text-muted"></i>
                        <span>Formulir Berita</span>
                    </h5>
                </div>
                <div class="card-body p-4">
                    <form action="{{ route('berita-store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        
                        <div class="row g-3 mb-3">
                            <div class="col-md-6">
                                <label for="id_kategori" class="admin-form-label">Kategori Berita <span class="required">*</span></label>
                                <select name="id_kategori" id="id_kategori" class="form-select @error('id_kategori') is-invalid @enderror" required>
                                    <option value="">-- Pilih Kategori --</option>
                                    @foreach($kategoris as $kategori)
                                        <option value="{{ $kategori->id }}" {{ old('id_kategori') == $kategori->id ? 'selected' : '' }}>
                                            {{ $kategori->nama_kategori }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('id_kategori')
                                    <span class="text-danger text-xs mt-1 d-block">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="judul" class="admin-form-label">Judul Berita <span class="required">*</span></label>
                                <input type="text" name="judul" id="judul" value="{{ old('judul') }}"
                                    class="form-control @error('judul') is-invalid @enderror" placeholder="Masukkan judul berita..." required>
                                @error('judul')
                                    <span class="text-danger text-xs mt-1 d-block">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="gambar" class="admin-form-label">Gambar Utama / Sampul Berita</label>
                            <input type="file" class="form-control @error('gambar') is-invalid @enderror"
                                id="gambar" name="gambar" accept="image/*">
                            <small class="text-muted fs-8 mt-1 d-block">Format: JPG, JPEG, PNG, WEBP (Maksimal 2MB)</small>
                            @error('gambar')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="deskripsi" class="admin-form-label">Isi / Uraian Berita <span class="required">*</span></label>
                            <textarea name="deskripsi" id="deskripsi" rows="6"
                                class="form-control @error('deskripsi') is-invalid @enderror"
                                placeholder="Tulis isi berita secara lengkap..." required>{{ old('deskripsi', auth()->user()->deskripsi ?? '') }}</textarea>
                            @error('deskripsi')
                                <span class="text-danger text-xs mt-1 d-block">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="d-flex align-items-center justify-content-end gap-2 pt-3 border-top">
                            <a href="{{ route('berita-index') }}" class="btn-admin-secondary">
                                <i class="fas fa-times"></i> Batal
                            </a>
                            <button type="submit" class="btn-admin-primary">
                                <i class="fas fa-save"></i> Simpan Berita
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <x-app.footer />
        </div>
    </main>
</x-app-layout>