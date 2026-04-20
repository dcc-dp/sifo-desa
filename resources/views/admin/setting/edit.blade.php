<x-app-layout>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
        <div class="top-0 bg-cover z-index-n1 min-height-100 max-height-200 h-25 position-absolute w-100 start-0 end-0"
            style="background-image: url('../../../assets/img/header-blue-purple.jpg'); background-position: bottom;">
        </div>
        <x-app.navbar />

        <div class="container-fluid py-4 px-5">
            <div class="row">
                <div class="col-12">
                    <div class="card mb-4">
                        <div class="card-header pb-0">
                            <h4 class="fw-bold">Basic Info</h4>
                            <p class="text-muted mb-0">Kelola informasi dan kontak desa yang tampil di website.</p>
                        </div>
                        <div class="card-body">

                            @if (session('success'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                </div>
                            @endif

                            <form action="{{ route('admin.setting.update') }}" method="POST">
                                @csrf
                                @method('PUT')

                                <div class="row g-4">
\
                                    <div class="col-md-6">
                                        <div class="card border-0 shadow-sm h-100">
                                            <div class="card-header bg-white fw-semibold py-3">
                                                <i class="fas fa-info-circle text-success me-2"></i>Informasi Desa
                                            </div>
                                            <div class="card-body">
                                                <div class="mb-3">
                                                    <label class="form-label fw-medium">Nama Desa</label>
                                                    <input type="text" name="nama_desa"
                                                        class="form-control @error('nama_desa') is-invalid @enderror"
                                                        value="{{ old('nama_desa', $setting->nama_desa) }}">
                                                    @error('nama_desa')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="mb-0">
                                                    <label class="form-label fw-medium">Deskripsi</label>
                                                    <textarea name="deskripsi" rows="6" class="form-control">{{ old('deskripsi', $setting->deskripsi) }}</textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    {{-- Kontak --}}
                                    <div class="col-md-6">
                                        <div class="card border-0 shadow-sm h-100">
                                            <div class="card-header bg-white fw-semibold py-3">
                                                <i class="fas fa-address-book text-success me-2"></i>Kontak
                                            </div>
                                            <div class="card-body">
                                                <div class="mb-3">
                                                    <label class="form-label fw-medium">Alamat</label>
                                                    <textarea name="alamat" rows="2"
                                                        class="form-control @error('alamat') is-invalid @enderror">{{ old('alamat', $setting->alamat) }}</textarea>
                                                    @error('alamat')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label fw-medium">Email</label>
                                                    <input type="email" name="email"
                                                        class="form-control @error('email') is-invalid @enderror"
                                                        value="{{ old('email', $setting->email) }}">
                                                    @error('email')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="mb-0">
                                                    <label class="form-label fw-medium">Telepon</label>
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

                                
                                    <div class="col-md-6">
                                        <div class="card border-0 shadow-sm h-100">
                                            <div class="card-header bg-white fw-semibold py-3">
                                                <i class="fas fa-share-alt text-success me-2"></i>Media Sosial
                                            </div>
                                            <div class="card-body">
                                                <div class="mb-3">
                                                    <label class="form-label fw-medium">
                                                        <i class="fab fa-facebook text-primary me-1"></i>Facebook
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
                                                    <label class="form-label fw-medium">
                                                        <i class="fab fa-instagram text-danger me-1"></i>Instagram
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
                                                    <label class="form-label fw-medium">
                                                        <i class="fab fa-twitter text-info me-1"></i>Twitter
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

                                    <div class="col-md-6">
                                        <div class="card border-0 shadow-sm h-100">
                                            <div class="card-header bg-white fw-semibold py-3">
                                                <i class="fas fa-map-marked-alt text-success me-2"></i>Google Maps Embed
                                            </div>
                                            <div class="card-body">
                                                <div class="mb-3">
                                                    <label class="form-label fw-medium">URL Embed Maps</label>
                                                    <textarea name="maps_embed" rows="3" class="form-control"
                                                        placeholder="Paste URL dari Google Maps > Share > Embed a map > src=...">{{ old('maps_embed', $setting->maps_embed) }}</textarea>
                                                    <div class="form-text">Ambil dari Google Maps → Share → Embed a map
                                                        → copy hanya bagian URL di dalam <code>src="..."</code></div>
                                                </div>
                                                @if ($setting->maps_embed)
                                                    <div style="border-radius:10px; overflow:hidden; height:200px;">
                                                        <iframe src="{{ $setting->maps_embed }}" width="100%"
                                                            height="200" style="border:0;"
                                                            loading="lazy"></iframe>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                </div>

                                <div class="mt-4 mb-3">
                                    <button type="submit" class="btn btn-success px-4 fw-semibold">
                                        <i class="fas fa-save me-2"></i>Simpan Pengaturan
                                    </button>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <x-app.footer />
    </main>
</x-app-layout>