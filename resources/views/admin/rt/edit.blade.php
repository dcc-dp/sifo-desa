<x-app-layout>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
        <x-app.navbar />
        <div class="container-fluid py-4 px-5">

            <!-- PAGE HEADER -->
            <div class="admin-page-header">
                <div>
                    <div class="d-flex align-items-center gap-2 mb-1">
                        <a href="{{ route('rt-index') }}" class="btn-admin-secondary py-1 px-2 fs-7">
                            <i class="fas fa-arrow-left"></i> Kembali
                        </a>
                        <span class="text-muted">/</span>
                        <span class="badge bg-light text-dark border px-2 py-1 fs-7">Rukun Tetangga</span>
                    </div>
                    <h2 class="admin-page-title">
                        <i class="fas fa-edit"></i>
                        <span>Edit Data RT</span>
                    </h2>
                    <p class="admin-page-subtitle">Perbarui nomor RT atau wilayah RW induk</p>
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
                        <i class="fas fa-edit text-muted"></i>
                        <span>Formulir Perubahan RT</span>
                    </h5>
                </div>
                <div class="card-body p-4">
                    <form action="{{ route('rt-update', $rt->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="rw_id" class="admin-form-label">Pilih Wilayah RW Induk <span class="required">*</span></label>
                                <select name="rw_id" id="rw_id" class="form-select @error('rw_id') is-invalid @enderror" required>
                                    <option value="">-- Pilih RW --</option>
                                    @foreach ($rw_list as $rw)
                                        <option value="{{ $rw->id }}" 
                                            {{ old('rw_id', $rt->rw_id) == $rw->id ? 'selected' : '' }}>
                                            RW {{ $rw->nomor_rw }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('rw_id') 
                                    <span class="text-danger text-xs mt-1 d-block">{{ $message }}</span> 
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-4">
                            <div class="col-md-6">
                                <label for="nomor_rt" class="admin-form-label">Nomor RT <span class="required">*</span></label>
                                <input type="text" name="nomor_rt" id="nomor_rt" 
                                       value="{{ old('nomor_rt', $rt->nomor_rt) }}" 
                                       class="form-control @error('nomor_rt') is-invalid @enderror" 
                                       placeholder="Contoh: 001" required>
                                @error('nomor_rt') 
                                    <span class="text-danger text-xs mt-1 d-block">{{ $message }}</span> 
                                @enderror
                            </div>
                        </div>

                        <div class="d-flex align-items-center justify-content-end gap-2 pt-3 border-top">
                            <a href="{{ route('rt-index') }}" class="btn-admin-secondary">
                                <i class="fas fa-times"></i> Batal
                            </a>
                            <button type="submit" class="btn-admin-primary">
                                <i class="fas fa-save"></i> Perbarui Data RT
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <x-app.footer />
        </div>
    </main>
</x-app-layout>