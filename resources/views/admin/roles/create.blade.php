<x-app-layout>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
        <x-app.navbar />
        <div class="container-fluid py-4 px-5">

            <div class="admin-page-header">
                <div>
                    <h2 class="admin-page-title">
                        <i class="fas fa-plus-circle"></i>
                        <span>Tambah Role</span>
                    </h2>
                    <p class="admin-page-subtitle">Menambahkan role baru beserta permissionsnya</p>
                </div>
                <div>
                    <a href="{{ route('admin.roles.index') }}" class="btn-admin-secondary">
                        <i class="fas fa-arrow-left"></i>
                        <span>Kembali</span>
                    </a>
                </div>
            </div>

            <div class="admin-card">
                <div class="admin-card-body p-4">
                    <form action="{{ route('admin.roles.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Nama Role</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-bold mb-3">Pilih Hak Akses (Permissions)</label>
                            
                            @php
                                $groupedPermissions = collect($permissions)->groupBy(function($perm) {
                                    $parts = explode('_', $perm->name);
                                    return count($parts) > 1 ? ucfirst($parts[1]) : 'Lainnya';
                                });
                            @endphp

                            <div class="row">
                                @foreach($groupedPermissions as $module => $perms)
                                    <div class="col-md-4 mb-4">
                                        <div class="card shadow-sm border-0 h-100">
                                            <div class="card-header bg-light border-bottom-0 pt-3 pb-2">
                                                <h6 class="mb-0 text-primary fw-bold"><i class="fas fa-layer-group me-2"></i>{{ $module }}</h6>
                                            </div>
                                            <div class="card-body py-3">
                                                <div class="row">
                                                    @foreach($perms as $permission)
                                                        <div class="col-6 mb-2">
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="checkbox" name="permissions[]" value="{{ $permission->name }}" id="perm_{{ $permission->id }}">
                                                                <label class="form-check-label text-muted" style="font-size: 0.85rem;" for="perm_{{ $permission->id }}">
                                                                    {{ ucfirst(explode('_', $permission->name)[0]) }}
                                                                </label>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <div class="text-end mt-4">
                            <button type="submit" class="btn-admin-primary">
                                <i class="fas fa-save me-1"></i> Simpan Role
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <x-app.footer />
        </div>
    </main>
</x-app-layout>
