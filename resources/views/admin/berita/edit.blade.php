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
                        <i class="fas fa-edit"></i>
                        <span>Edit Berita</span>
                    </h2>
                    <p class="admin-page-subtitle">Perbarui judul, kategori, gambar, atau isi naskah berita</p>
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
                        <i class="fas fa-file-alt text-muted"></i>
                        <span>Formulir Perubahan Berita</span>
                    </h5>
                </div>
                <div class="card-body p-4">
                    <form action="{{ route('berita-update', $beritas->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="row g-3 mb-3">
                            <div class="col-md-6">
                                <label for="id_kategori" class="admin-form-label">Kategori <span class="required">*</span></label>
                                <select class="form-select @error('id_kategori') is-invalid @enderror" id="id_kategori"
                                    name="id_kategori" required>
                                    <option value="">-- Pilih Kategori --</option>
                                    @foreach($kategoris as $kategori)
                                        <option value="{{ $kategori->id }}" {{ old('id_kategori', $beritas->id_kategori) == $kategori->id ? 'selected' : '' }}>
                                            {{ $kategori->nama_kategori }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('id_kategori')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="judul" class="admin-form-label">Judul Berita <span class="required">*</span></label>
                                <input type="text" name="judul" id="judul"
                                    value="{{ old('judul', $beritas->judul) }}"
                                    class="form-control @error('judul') is-invalid @enderror" required>
                                @error('judul')
                                    <span class="text-danger text-xs mt-1 d-block">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="gambar" class="admin-form-label">Gambar Berita</label>
                            <input type="file" name="gambar" id="gambar" class="form-control" accept="image/*">
                            <small class="text-muted fs-8 mt-1 d-block">Kosongkan jika tidak ingin mengubah gambar.</small>

                            <div class="mt-2">
                                <span class="text-xs text-muted d-block mb-1">Gambar saat ini:</span>
                                @if($beritas->gambar && file_exists(public_path($beritas->gambar)))
                                    <img src="{{ asset($beritas->gambar) }}" alt="{{ $beritas->judul }}" class="table-thumb" style="width: 80px; height: 80px;">
                                @else
                                    <span class="badge bg-light text-muted border px-2 py-1 fs-8">Belum ada gambar</span>
                                @endif
                            </div>
                        </div>

                        <div class="mb-4">
                            <label for="deskripsi" class="admin-form-label">Isi / Uraian Berita <span class="required">*</span></label>
                            <textarea name="deskripsi" id="deskripsi" rows="6"
                                class="form-control @error('deskripsi') is-invalid @enderror" required>{{ old('deskripsi', $beritas->deskripsi) }}</textarea>
                            @error('deskripsi')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex align-items-center justify-content-end gap-2 pt-3 border-top">
                            <a href="{{ route('berita-index') }}" class="btn-admin-secondary">
                                <i class="fas fa-times"></i> Batal
                            </a>
                            <button type="submit" class="btn-admin-primary">
                                <i class="fas fa-save"></i> Perbarui Berita
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <x-app.footer />
        </div>
    </main>
</x-app-layout>