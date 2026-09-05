<x-app-layout>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
        <x-app.navbar />
        <div class="container-fluid py-4 px-5">

            <!-- PAGE HEADER -->
            <div class="admin-page-header">
                <div>
                    <div class="d-flex align-items-center gap-2 mb-1">
                        <a href="{{ route('admin.user-index') }}" class="btn-admin-secondary py-1 px-2 fs-7">
                            <i class="fas fa-arrow-left"></i> Kembali
                        </a>
                        <span class="text-muted">/</span>
                        <span class="badge bg-light text-dark border px-2 py-1 fs-7">Administrator</span>
                    </div>
                    <h2 class="admin-page-title">
                        <i class="fas fa-user-edit"></i>
                        <span>Edit User Administrator</span>
                    </h2>
                    <p class="admin-page-subtitle">Perbarui data nama, email, NIK, atau setel ulang kata sandi</p>
                </div>
            </div>

            <!-- FORM CARD -->
            <div class="admin-card">
                <div class="admin-card-header">
                    <h5 class="admin-card-title">
                        <i class="fas fa-user-shield text-muted"></i>
                        <span>Formulir Perubahan Akun</span>
                    </h5>
                </div>
                <div class="card-body p-4">
                    <form action="{{ route('admin.user-update', $user->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="row g-3 mb-3">
                            <div class="col-md-6">
                                <label for="nik_id" class="admin-form-label">NIK (Nomor Induk Kependudukan)</label>
                                <input type="text" name="nik_id" id="nik_id" class="form-control font-monospace @error('nik_id') is-invalid @enderror"
                                    value="{{ old('nik_id', $user->nik_id) }}">
                                @error('nik_id')
                                    <span class="text-danger text-xs mt-1 d-block">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="name" class="admin-form-label">Nama Lengkap <span class="required">*</span></label>
                                <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror"
                                    value="{{ old('name', $user->name) }}" required>
                                @error('name')
                                    <span class="text-danger text-xs mt-1 d-block">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="row g-3 mb-4">
                            <div class="col-md-6">
                                <label for="email" class="admin-form-label">Alamat Email <span class="required">*</span></label>
                                <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror"
                                    value="{{ old('email', $user->email) }}" required>
                                @error('email')
                                    <span class="text-danger text-xs mt-1 d-block">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="password" class="admin-form-label">Kata Sandi Baru</label>
                                <input type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror"
                                    placeholder="Biarkan kosong jika tidak ingin mengubah">
                                <small class="text-muted fs-8 mt-1 d-block">Kosongkan jika tidak ingin mengganti password lama.</small>
                                @error('password')
                                    <span class="text-danger text-xs mt-1 d-block">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="row g-3 mb-4">
                            <div class="col-md-12">
                                <label for="role" class="admin-form-label">Peran (Role) <span class="required">*</span></label>
                                <select name="role" id="role" class="form-select @error('role') is-invalid @enderror" required>
                                    <option value="" disabled>Pilih Role Pengguna...</option>
                                    @foreach($roles as $role)
                                        <option value="{{ $role->name }}" {{ (old('role') ?? $userRole) == $role->name ? 'selected' : '' }}>{{ $role->name }}</option>
                                    @endforeach
                                </select>
                                @error('role')
                                    <span class="text-danger text-xs mt-1 d-block">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="d-flex align-items-center justify-content-end gap-2 pt-3 border-top">
                            <a href="{{ route('admin.user-index') }}" class="btn-admin-secondary">
                                <i class="fas fa-times"></i> Batal
                            </a>
                            <button type="submit" class="btn-admin-primary">
                                <i class="fas fa-save"></i> Perbarui Data Pengguna
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <x-app.footer />
        </div>
    </main>
</x-app-layout>