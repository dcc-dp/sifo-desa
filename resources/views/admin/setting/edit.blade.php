<x-app-layout>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
        <x-app.navbar />

        <div class="container-fluid py-4 px-5">

            <!-- PAGE HEADER -->
            <div class="admin-page-header">
                <div>
                    <h2 class="admin-page-title">
                        <i class="fas fa-cogs"></i>
                        <span>Pengaturan Profil Desa</span>
                    </h2>
                    <p class="admin-page-subtitle">Kelola identitas desa, kontak resmi, tautan media sosial, dan peta wilayah</p>
                </div>
            </div>

            <!-- ALERT -->
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show mb-4 text-white border-0" style="background: #15803d;" role="alert">
                    <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <form action="{{ route('admin.setting.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="row g-4">
                    <!-- INFORMASI DESA -->
                    <div class="col-md-6">
                        <div class="admin-card mb-0 h-100">
                            <div class="admin-card-header">
                                <h5 class="admin-card-title">
                                    <i class="fas fa-info-circle text-muted"></i>
                                    <span>Identitas Umum Desa</span>
                                </h5>
                            </div>
                            <div class="card-body p-4">
                                <div class="mb-3">
                                    <label class="admin-form-label">Nama Resmi Desa <span class="required">*</span></label>
                                    <input type="text" name="nama_desa"
                                        class="form-control @error('nama_desa') is-invalid @enderror"
                                        value="{{ old('nama_desa', $setting->nama_desa) }}" required>
                                    @error('nama_desa')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-0">
                                    <label class="admin-form-label">Uraian / Selayang Pandang Desa</label>
                                    <textarea name="deskripsi" rows="6" class="form-control"
                                        placeholder="Ringkasan singkat profil desa yang tampil di footer atau beranda...">{{ old('deskripsi', $setting->deskripsi) }}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- KONTAK RESMI -->
                    <div class="col-md-6">
                        <div class="admin-card mb-0 h-100">
                            <div class="admin-card-header">
                                <h5 class="admin-card-title">
                                    <i class="fas fa-address-book text-muted"></i>
                                    <span>Kontak & Lokasi Kantor</span>
                                </h5>
                            </div>
                            <div class="card-body p-4">
                                <div class="mb-3">
                                    <label class="admin-form-label">Alamat Kantor Desa <span class="required">*</span></label>
                                    <textarea name="alamat" rows="2"
                                        class="form-control @error('alamat') is-invalid @enderror" required>{{ old('alamat', $setting->alamat) }}</textarea>
                                    @error('alamat')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label class="admin-form-label">Email Resmi Desa</label>
                                    <input type="email" name="email"
                                        class="form-control @error('email') is-invalid @enderror"
                                        value="{{ old('email', $setting->email) }}">
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-0">
                                    <label class="admin-form-label">Nomor Telepon / WhatsApp Kantor</label>
                                    <input type="text" name="telepon"
                                        class="form-control @error('telepon') is-invalid @enderror"
                                        value="{{ old('telepon', $setting->telepon) }}">
                                    @error('telepon')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- MEDIA SOSIAL -->
                    <div class="col-md-6">
                        <div class="admin-card mb-0 h-100">
                            <div class="admin-card-header">
                                <h5 class="admin-card-title">
                                    <i class="fas fa-share-alt text-muted"></i>
                                    <span>Tautan Media Sosial</span>
                                </h5>
                            </div>
                            <div class="card-body p-4">
                                <div class="mb-3">
                                    <label class="admin-form-label">
                                        <i class="fab fa-facebook text-primary me-1"></i> URL Facebook Page
                                    </label>
                                    <input type="url" name="facebook"
                                        class="form-control @error('facebook') is-invalid @enderror"
                                        placeholder="https://facebook.com/namadesa"
                                        value="{{ old('facebook', $setting->facebook) }}">
                                    @error('facebook')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label class="admin-form-label">
                                        <i class="fab fa-instagram text-danger me-1"></i> URL Instagram
                                    </label>
                                    <input type="url" name="instagram"
                                        class="form-control @error('instagram') is-invalid @enderror"
                                        placeholder="https://instagram.com/namadesa"
                                        value="{{ old('instagram', $setting->instagram) }}">
                                    @error('instagram')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-0">
                                    <label class="admin-form-label">
                                        <i class="fab fa-twitter text-info me-1"></i> URL X / Twitter
                                    </label>
                                    <input type="url" name="twitter"
                                        class="form-control @error('twitter') is-invalid @enderror"
                                        placeholder="https://twitter.com/namadesa"
                                        value="{{ old('twitter', $setting->twitter) }}">
                                    @error('twitter')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- GOOGLE MAPS EMBED -->
                    <div class="col-md-6">
                        <div class="admin-card mb-0 h-100">
                            <div class="admin-card-header">
                                <h5 class="admin-card-title">
                                    <i class="fas fa-map-marked-alt text-muted"></i>
                                    <span>Peta Wilayah Desa (Google Maps)</span>
                                </h5>
                            </div>
                            <div class="card-body p-4">
                                <div class="mb-3">
                                    <label class="admin-form-label">URL Embed Peta (Google Maps Embed Link)</label>
                                    <textarea name="maps_embed" rows="3" class="form-control"
                                        placeholder="Paste URL dari Google Maps > Bagikan > Sematkan peta > src=...">{{ old('maps_embed', $setting->maps_embed) }}</textarea>
                                    <small class="text-muted fs-8 mt-1 d-block">
                                        Ambil tautan dari Google Maps: Bagikan &rarr; Sematkan peta &rarr; salin isi atribut <code>src="..."</code>
                                    </small>
                                </div>
                                @if ($setting->maps_embed)
                                    <div class="rounded-3 overflow-hidden border shadow-xs" style="height: 160px;">
                                        <iframe src="{{ $setting->maps_embed }}" width="100%" height="160" style="border:0;" loading="lazy"></iframe>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- PENGATURAN PENOMORAN SURAT RESMI -->
                    <div class="col-12">
                        <div class="admin-card mb-0">
                            <div class="admin-card-header d-flex align-items-center justify-content-between">
                                <h5 class="admin-card-title">
                                    <i class="fas fa-file-signature text-success"></i>
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
                                                placeholder="Contoh: 6">
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
                                                <li>Ketika disetujui, surat pertama akan mendapat nomor <strong>{{ sprintf('%03d', $setting->nomor_surat_berikutnya ?? 1) }}</strong>.</li>
                                                <li>Surat berikutnya (meskipun beda jenis surat) akan berlanjut menjadi <strong>{{ sprintf('%03d', ($setting->nomor_surat_berikutnya ?? 1) + 1) }}</strong>, <strong>{{ sprintf('%03d', ($setting->nomor_surat_berikutnya ?? 1) + 2) }}</strong>, dst.</li>
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
                        <i class="fas fa-save"></i> Simpan Seluruh Pengaturan
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