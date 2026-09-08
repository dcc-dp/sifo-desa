<x-app-layout>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
        <x-app.navbar />

        <div class="container-fluid py-4 px-5">

            <!-- PAGE HEADER -->
            <div class="admin-page-header">
                <div>
                    <h2 class="admin-page-title">
                        <i class="fas fa-file-signature text-success me-2"></i>
                        <span>Pengaturan Surat & Legalitas Desa</span>
                    </h2>
                    <p class="admin-page-subtitle">Atur nomor urut surat resmi (global counter) serta kelola logo kop, stempel, dan tanda tangan kepala desa</p>
                </div>
            </div>

            <!-- ALERT -->
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show mb-4 text-white border-0" style="background: #15803d;" role="alert">
                    <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <form action="{{ route('admin.setting-surat.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="row g-4">
                    <!-- PENGATURAN PENOMORAN SURAT RESMI -->
                    <div class="col-12">
                        <div class="admin-card mb-0">
                            <div class="admin-card-header d-flex align-items-center justify-content-between">
                                <h5 class="admin-card-title">
                                    <i class="fas fa-hashtag text-success"></i>
                                    <span>Pengaturan Penomoran Surat Resmi Desa (Global Counter)</span>
                                </h5>
                                <span class="badge bg-light text-success border border-success-subtle px-3 py-1 fs-7">
                                    <i class="fas fa-shield-alt me-1"></i> Auto-Increment Global
                                </span>
                            </div>
                            <div class="card-body p-4">
                                <div class="row align-items-center g-4">
                                    <div class="col-lg-7 col-md-6">
                                        <label class="admin-form-label fs-6 fw-bold text-dark mb-1">
                                            Nomor Urut Surat Berikutnya <span class="required">*</span>
                                        </label>
                                        <p class="text-muted fs-7 mb-3">
                                            Nomor urut ini berlaku <strong>secara global untuk seluruh jenis surat</strong> (Domisili, Usaha, SKTM, Pengantar, Izin). Cukup atur satu kali saat pertama kali menggunakan sistem. Nomor akan bertambah secara otomatis dan berurutan setiap kali surat resmi disetujui/diterbitkan.
                                        </p>
                                        <div class="input-group" style="max-width: 320px;">
                                            <span class="input-group-text bg-light text-dark fw-bold border">
                                                <i class="fas fa-hashtag text-success"></i>
                                            </span>
                                            <input type="number" name="nomor_surat_berikutnya" min="1" step="1"
                                                class="form-control font-monospace fw-bold fs-5 @error('nomor_surat_berikutnya') is-invalid @enderror"
                                                value="{{ old('nomor_surat_berikutnya', $setting->nomor_surat_berikutnya ?? 1) }}"
                                                placeholder="Contoh: 1">
                                            <span class="input-group-text bg-light text-muted border fs-7">
                                                Format: {{ sprintf('%03d', old('nomor_surat_berikutnya', $setting->nomor_surat_berikutnya ?? 1)) }}
                                            </span>
                                        </div>
                                        @error('nomor_surat_berikutnya')
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-lg-5 col-md-6">
                                        <div class="p-3 bg-light rounded-3 border">
                                            <div class="fw-bold text-dark fs-7 mb-2 d-flex align-items-center gap-2">
                                                <i class="fas fa-info-circle text-primary"></i> Contoh Alur Penomoran Berurutan:
                                            </div>
                                            <ul class="text-muted fs-8 mb-0 ps-3" style="line-height: 1.6;">
                                                <li>Surat berstatus <em>Draft / Menunggu</em> <strong>tidak mengambil nomor</strong>.</li>
                                                <li>Format nomor surat resmi: <strong>(NOMOR URUT)/KODE/(ROMAWI)/TAHUN</strong> (contoh: <code>{{ sprintf('%03d', $setting->nomor_surat_berikutnya ?? 1) }}/SKU/{{ \App\Models\Surat::getRomawiBulan() }}/{{ date('Y') }}</code>).</li>
                                                <li>Ketika disetujui, surat pertama akan mendapat nomor urut <strong>{{ sprintf('%03d', $setting->nomor_surat_berikutnya ?? 1) }}</strong>.</li>
                                                <li>Surat berikutnya (meskipun beda jenis surat) akan otomatis berlanjut menjadi <strong>{{ sprintf('%03d', ($setting->nomor_surat_berikutnya ?? 1) + 1) }}</strong>, <strong>{{ sprintf('%03d', ($setting->nomor_surat_berikutnya ?? 1) + 2) }}</strong>, dst.</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- PENGATURAN ASET PERSURATAN -->
                    <div class="col-12">
                        <div class="admin-card mb-0">
                            <div class="admin-card-header d-flex align-items-center justify-content-between">
                                <h5 class="admin-card-title">
                                    <i class="fas fa-stamp text-success"></i>
                                    <span>Aset Persuratan Desa (Kop, Stempel & Tanda Tangan)</span>
                                </h5>
                                <span class="badge bg-light text-muted border px-2 py-1 fs-8">
                                    Berlaku Otomatis untuk Semua Jenis Surat
                                </span>
                            </div>
                            <div class="card-body p-4">
                                <p class="text-muted fs-7 mb-4">
                                    Kelola aset visual yang dicetak pada seluruh dokumen resmi persuratan desa (Surat Domisili, Usaha, SKTM, Pengantar, dan Izin). Gambar yang diunggah akan otomatis menggantikan aset lama pada setiap dokumen PDF yang diterbitkan.
                                </p>

                                <div class="row g-4">
                                    <!-- 1. LOGO KOP SURAT -->
                                    <div class="col-lg-4 col-md-6">
                                        <div class="p-3 border rounded-3 bg-light h-100 d-flex flex-column">
                                            <div class="d-flex align-items-center justify-content-between mb-2">
                                                <label class="admin-form-label fw-bold mb-0">
                                                    <i class="fas fa-landmark text-primary me-1"></i> Logo Kop Surat
                                                </label>
                                                <span class="badge bg-white border text-dark fs-8">Kop Kiri Atas</span>
                                            </div>
                                            <p class="text-muted fs-8 mb-3">Tampil di bagian kiri atas kop surat resmi desa.</p>
                                            
                                            <div class="d-flex align-items-center justify-content-center p-3 bg-white border rounded-3 mb-3" style="min-height: 130px;">
                                                @if (!empty($setting->logo_surat) && file_exists(public_path($setting->logo_surat)))
                                                    <img id="preview-logo" src="{{ asset($setting->logo_surat) }}" alt="Logo Surat" class="img-fluid" style="max-height: 100px; object-fit: contain;">
                                                @else
                                                    <img id="preview-logo" src="{{ asset('uploads/galeri/logo_sifo.png') }}" alt="Logo Surat Default" class="img-fluid" style="max-height: 100px; object-fit: contain;">
                                                @endif
                                            </div>

                                            <div class="mt-auto">
                                                <input type="file" name="logo_surat" id="logo_surat" class="form-control form-control-sm @error('logo_surat') is-invalid @enderror" accept="image/png, image/jpeg, image/jpg" onchange="previewImage(this, 'preview-logo')">
                                                @error('logo_surat')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                                <small class="text-muted fs-8 mt-1 d-block">Format: JPG, JPEG, PNG (Maks 2MB)</small>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- 2. STEMPEL RESMI SURAT -->
                                    <div class="col-lg-4 col-md-6">
                                        <div class="p-3 border rounded-3 bg-light h-100 d-flex flex-column">
                                            <div class="d-flex align-items-center justify-content-between mb-2">
                                                <label class="admin-form-label fw-bold mb-0">
                                                    <i class="fas fa-stamp text-danger me-1"></i> Stempel Resmi Desa
                                                </label>
                                                <span class="badge bg-white border text-dark fs-8">Kolom TTD</span>
                                            </div>
                                            <p class="text-muted fs-8 mb-3">Stempel cap resmi desa di samping tanda tangan.</p>
                                            
                                            <div class="d-flex align-items-center justify-content-center p-3 bg-white border rounded-3 mb-3" style="min-height: 130px;">
                                                @if (!empty($setting->stempel_surat) && file_exists(public_path($setting->stempel_surat)))
                                                    <img id="preview-stempel" src="{{ asset($setting->stempel_surat) }}" alt="Stempel Surat" class="img-fluid" style="max-height: 100px; object-fit: contain;">
                                                @else
                                                    <img id="preview-stempel" src="{{ asset('uploads/galeri/stempel.png') }}" alt="Stempel Default" class="img-fluid" style="max-height: 100px; object-fit: contain;">
                                                @endif
                                            </div>

                                            <div class="mt-auto">
                                                <input type="file" name="stempel_surat" id="stempel_surat" class="form-control form-control-sm @error('stempel_surat') is-invalid @enderror" accept="image/png, image/jpeg, image/jpg" onchange="previewImage(this, 'preview-stempel')">
                                                @error('stempel_surat')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                                <small class="text-muted fs-8 mt-1 d-block">Format: PNG transparan (Maks 2MB)</small>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- 3. TANDA TANGAN KEPALA DESA -->
                                    <div class="col-lg-4 col-md-6">
                                        <div class="p-3 border rounded-3 bg-light h-100 d-flex flex-column">
                                            <div class="d-flex align-items-center justify-content-between mb-2">
                                                <label class="admin-form-label fw-bold mb-0">
                                                    <i class="fas fa-signature text-success me-1"></i> TTD Kepala Desa
                                                </label>
                                                <span class="badge bg-white border text-dark fs-8">Pengesahan</span>
                                            </div>
                                            <p class="text-muted fs-8 mb-3">Tanda tangan resmi kepala desa pada bagian pengesahan.</p>
                                            
                                            <div class="d-flex align-items-center justify-content-center p-3 bg-white border rounded-3 mb-3" style="min-height: 130px;">
                                                @if (!empty($setting->ttd_kepala_desa) && file_exists(public_path($setting->ttd_kepala_desa)))
                                                    <img id="preview-ttd" src="{{ asset($setting->ttd_kepala_desa) }}" alt="TTD Kades" class="img-fluid" style="max-height: 100px; object-fit: contain;">
                                                @else
                                                    <img id="preview-ttd" src="{{ asset('uploads/galeri/ttd_kedes.png') }}" alt="TTD Default" class="img-fluid" style="max-height: 100px; object-fit: contain;">
                                                @endif
                                            </div>

                                            <div class="mt-auto">
                                                <input type="file" name="ttd_kepala_desa" id="ttd_kepala_desa" class="form-control form-control-sm @error('ttd_kepala_desa') is-invalid @enderror" accept="image/png, image/jpeg, image/jpg" onchange="previewImage(this, 'preview-ttd')">
                                                @error('ttd_kepala_desa')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                                <small class="text-muted fs-8 mt-1 d-block">Format: PNG transparan (Maks 2MB)</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="d-flex align-items-center justify-content-end gap-2 pt-4 mt-2">
                    <button type="submit" class="btn-admin-primary px-4 py-2 fs-6">
                        <i class="fas fa-save me-1"></i> Simpan Pengaturan Surat
                    </button>
                </div>
            </form>

            <x-app.footer />
        </div>
    </main>

    <script>
        function previewImage(input, previewId) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    var img = document.getElementById(previewId);
                    if (img) {
                        img.src = e.target.result;
                    }
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
</x-app-layout>
