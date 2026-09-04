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
                        <i class="fas fa-user-plus"></i>
                        <span>Tambah Aparatur Desa</span>
                    </h2>
                    <p class="admin-page-subtitle">Daftarkan pejabat atau aparatur baru dalam jajaran pemerintah desa</p>
                </div>
            </div>

            <!-- ALERT -->
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
                        <span>Biodata Aparatur</span>
                    </h5>
                </div>
                <div class="card-body p-4">
                    <form action="{{ route('pemerintah-store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="row g-3 mb-3">
                            <div class="col-md-6">
                                <label for="nama" class="admin-form-label">Nama Lengkap & Gelar <span class="required">*</span></label>
                                <input type="text" name="nama" id="nama" value="{{ old('nama') }}"
                                    class="form-control @error('nama') is-invalid @enderror" placeholder="Contoh: Drs. Ahmad Syafi'i, M.Si" required>
                                @error('nama') <span class="text-danger text-xs mt-1 d-block">{{ $message }}</span> @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="jabatan" class="admin-form-label">Jabatan Struktural <span class="required">*</span></label>
                                @php
                                    $standardJabatans = [
                                        'Kepala Desa',
                                        'Sekretaris Desa',
                                        'Kaur Keuangan',
                                        'Kaur Umum & Perencanaan',
                                        'Kaur Tata Usaha & Umum',
                                        'Kasi Pemerintahan',
                                        'Kasi Kesejahteraan',
                                        'Kasi Pelayanan',
                                        'Kepala Dusun',
                                    ];
                                    $oldJabatan = old('jabatan');
                                @endphp
                                <select name="jabatan" id="jabatan" class="form-select @error('jabatan') is-invalid @enderror" required>
                                    <option value="" disabled {{ empty($oldJabatan) ? 'selected' : '' }}>-- Pilih Jabatan Struktural --</option>
                                    @foreach ($standardJabatans as $item)
                                        <option value="{{ $item }}" {{ $oldJabatan === $item ? 'selected' : '' }}>{{ $item }}</option>
                                    @endforeach
                                </select>
                                <small class="text-muted fs-8 mt-1 d-block">
                                    <i class="fas fa-info-circle text-primary me-1"></i>
                                    Pilih <strong>Kepala Desa</strong> agar foto dan nama aparatur otomatis menjadi pimpinan di Beranda & penandatangan surat PDF.
                                </small>
                                @error('jabatan') <span class="text-danger text-xs mt-1 d-block">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="foto" class="admin-form-label">Pas Foto Resmi Aparatur</label>
                            <input type="file" class="form-control @error('foto') is-invalid @enderror" id="foto" name="foto" accept="image/*">
                            <small class="text-muted fs-8 mt-1 d-block">Disarankan foto formal berlatar belakang polos, rasio 3:4 atau 1:1.</small>
                            @error('foto')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="tupoksi" class="admin-form-label">Tugas Pokok & Fungsi (Tupoksi) <span class="required">*</span></label>
                            <textarea name="tupoksi" id="tupoksi" rows="5" class="form-control @error('tupoksi') is-invalid @enderror"
                                placeholder="Uraikan tugas pokok dan wewenang jabatan..." required>{{ old('tupoksi', auth()->user()->tupoksi ?? '') }}</textarea>
                            @error('tupoksi')
                                <span class="text-danger text-xs mt-1 d-block">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="d-flex align-items-center justify-content-end gap-2 pt-3 border-top">
                            <a href="{{ route('pemerintah-index') }}" class="btn-admin-secondary">
                                <i class="fas fa-times"></i> Batal
                            </a>
                            <button type="submit" class="btn-admin-primary">
                                <i class="fas fa-save"></i> Simpan Data Aparatur
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <x-app.footer />
        </div>
    </main>
</x-app-layout>