<x-app-layout>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
        <x-app.navbar />

        <div class="container-fluid py-4 px-5">

            <!-- PAGE HEADER -->
            <div class="admin-page-header">
                <div>
                    <div class="d-flex align-items-center gap-2 mb-1">
                        <a href="{{ route('pemerintah-index') }}" class="btn-admin-secondary py-1 px-2 fs-7">
                            <i class="fas fa-arrow-left"></i> Kembali
                        </a>
                        <span class="text-muted">/</span>
                        <span class="badge bg-light text-dark border px-2 py-1 fs-7">Pemerintah Desa</span>
                    </div>
                    <h2 class="admin-page-title">
                        <i class="fas fa-user-edit"></i>
                        <span>Edit Aparatur Desa</span>
                    </h2>
                    <p class="admin-page-subtitle">Perbarui data nama, jabatan, foto, atau tugas pokok aparatur</p>
                </div>
            </div>

            <!-- ALERT -->
            @if ($errors->any())
                <div class="alert alert-danger mb-4 text-white border-0" style="background: #dc2626;" role="alert">
                    <h6 class="text-white fw-bold mb-1"><i class="fas fa-exclamation-triangle me-1"></i> Gagal Memperbarui Data:</h6>
                    <ul class="mb-0 ps-3">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            @if (session('error'))
                <div class="alert alert-danger mb-4" role="alert" id="alert">{{ session('error') }}</div>
            @endif
            @if (session('success'))
                <div class="alert alert-success mb-4 text-white border-0" style="background: #15803d;" role="alert" id="alert">{{ session('success') }}</div>
            @endif

            <!-- FORM CARD -->
            <div class="admin-card">
                <div class="admin-card-header">
                    <h5 class="admin-card-title">
                        <i class="fas fa-id-badge text-muted"></i>
                        <span>Formulir Perubahan Aparatur</span>
                    </h5>
                </div>
                <div class="card-body p-4">
                    <form action="{{ route('pemerintah-update', $pemerintahs->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="row g-3 mb-3">
                            <div class="col-md-6">
                                <label for="nama" class="admin-form-label">Nama Lengkap & Gelar <span class="required">*</span></label>
                                <input type="text" name="nama" id="nama" value="{{ old('nama', $pemerintahs->nama) }}"
                                    class="form-control @error('nama') is-invalid @enderror" required>
                                @error('nama') <span class="text-danger text-xs mt-1 d-block">{{ $message }}</span> @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="jabatan" class="admin-form-label">Jabatan Struktural <span class="required">*</span></label>
                                <input type="text" name="jabatan" id="jabatan" value="{{ old('jabatan', $pemerintahs->jabatan) }}"
                                    class="form-control @error('jabatan') is-invalid @enderror" required>
                                @error('jabatan') <span class="text-danger text-xs mt-1 d-block">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="foto" class="admin-form-label">Pas Foto Resmi Aparatur</label>
                            <input type="file" name="foto" id="foto" class="form-control" accept="image/*">
                            <small class="text-muted fs-8 mt-1 d-block">Kosongkan jika tidak ingin mengubah foto.</small>

                            <div class="mt-2">
                                <span class="text-xs text-muted d-block mb-1">Foto saat ini:</span>
                                @if($pemerintahs->foto && file_exists(public_path($pemerintahs->foto)))
                                    <img src="{{ asset($pemerintahs->foto) }}" alt="{{ $pemerintahs->nama }}" class="table-avatar" style="width: 54px; height: 54px;">
                                @else
                                    <span class="badge bg-light text-muted border px-2 py-1 fs-8">Belum ada foto</span>
                                @endif
                            </div>
                        </div>

                        <div class="mb-4">
                            <label for="tupoksi" class="admin-form-label">Tugas Pokok & Fungsi (Tupoksi) <span class="required">*</span></label>
                            <textarea name="tupoksi" id="tupoksi" rows="5" class="form-control @error('tupoksi') is-invalid @enderror" required>{{ old('tupoksi', $pemerintahs->tupoksi) }}</textarea>
                            @error('tupoksi') <span class="text-danger text-xs mt-1 d-block">{{ $message }}</span> @enderror
                        </div>

                        <div class="d-flex align-items-center justify-content-end gap-2 pt-3 border-top">
                            <a href="{{ route('pemerintah-index') }}" class="btn-admin-secondary">
                                <i class="fas fa-times"></i> Batal
                            </a>
                            <button type="submit" class="btn-admin-primary">
                                <i class="fas fa-save"></i> Perbarui Data Aparatur
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <x-app.footer />
        </div>
    </main>
</x-app-layout>