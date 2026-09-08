<x-app-layout>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
        <x-app.navbar />

        <div class="container-fluid py-4 px-5">

            <!-- PAGE HEADER -->
            <div class="admin-page-header">
                <div>
                    <h2 class="admin-page-title">
                        <i class="fas fa-landmark text-primary me-2"></i>
                        <span>Profil & Kontak Desa</span>
                    </h2>
                    <p class="admin-page-subtitle">Kelola alamat kantor, nomor kontak resmi, media sosial, dan lokasi peta Google Maps desa</p>
                </div>
            </div>

            <!-- ALERT -->
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show mb-4 text-white border-0" style="background: #15803d;" role="alert">
                    <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <form action="{{ route('admin.setting-desa.update') }}" method="POST">
                @csrf
                @method('PUT')

                <div class="row g-4">
                    <!-- KONTAK RESMI -->
                    <div class="col-md-6">
                        <div class="admin-card mb-0 h-100">
                            <div class="admin-card-header">
                                <h5 class="admin-card-title">
                                    <i class="fas fa-address-book text-primary"></i>
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
                                    <i class="fas fa-share-alt text-primary"></i>
                                    <span>Tautan Media Sosial</span>
                                </h5>
                            </div>
                            <div class="card-body p-4">
                                <div class="mb-3">
                                    <label class="admin-form-label"><i class="fab fa-facebook text-primary me-1"></i> URL Facebook Page</label>
                                    <input type="url" name="facebook" class="form-control"
                                        value="{{ old('facebook', $setting->facebook) }}" placeholder="https://facebook.com/namadesa">
                                </div>
                                <div class="mb-3">
                                    <label class="admin-form-label"><i class="fab fa-instagram text-danger me-1"></i> URL Instagram</label>
                                    <input type="url" name="instagram" class="form-control"
                                        value="{{ old('instagram', $setting->instagram) }}" placeholder="https://instagram.com/namadesa">
                                </div>
                                <div class="mb-0">
                                    <label class="admin-form-label"><i class="fab fa-twitter text-info me-1"></i> URL X / Twitter</label>
                                    <input type="url" name="twitter" class="form-control"
                                        value="{{ old('twitter', $setting->twitter) }}" placeholder="https://x.com/namadesa">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- PETA LOKASI DESA -->
                    <div class="col-12">
                        <div class="admin-card mb-0">
                            <div class="admin-card-header">
                                <h5 class="admin-card-title">
                                    <i class="fas fa-map-marked-alt text-primary"></i>
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
                                    <div class="rounded-3 overflow-hidden border shadow-xs" style="height: 200px;">
                                        <iframe src="{{ $setting->maps_embed }}" width="100%" height="200" style="border:0;" loading="lazy"></iframe>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <div class="d-flex align-items-center justify-content-end gap-2 pt-4 mt-2">
                    <button type="submit" class="btn-admin-primary px-4 py-2 fs-6">
                        <i class="fas fa-save me-1"></i> Simpan Profil Desa
                    </button>
                </div>
            </form>

            <x-app.footer />
        </div>
    </main>
</x-app-layout>
