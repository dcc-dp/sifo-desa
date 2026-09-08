<x-app-layout>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
        <x-app.navbar />
        <div class="container-fluid py-4 px-5">

            <div class="admin-page-header">
                <div>
                    <h2 class="admin-page-title">
                        <i class="fas fa-edit"></i>
                        <span>Edit Menu</span>
                    </h2>
                    <p class="admin-page-subtitle">Ubah informasi dan hak akses menu</p>
                </div>
                <div>
                    <a href="{{ route('admin.menus.index') }}" class="btn-admin-secondary">
                        <i class="fas fa-arrow-left"></i>
                        <span>Kembali</span>
                    </a>
                </div>
            </div>

            <div class="admin-card">
                <div class="admin-card-body p-4">
                    <form action="{{ route('admin.menus.update', $menu->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-12 mb-4">
                                <label for="title" class="form-label fw-bold">Judul Menu</label>
                                <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title', $menu->title) }}" placeholder="Contoh: Manajemen User" required>
                                @error('title') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <div class="col-md-12 mb-4">
                                <label for="icon" class="form-label fw-bold">Ikon (SVG Code atau Kosongkan)</label>
                                <input type="text" class="form-control @error('icon') is-invalid @enderror" id="icon" name="icon" value="{{ old('icon', $menu->icon) }}" placeholder='<svg xmlns="http://www.w3.org/2000/svg"...'>
                                @error('icon') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <div class="col-md-12 mb-4">
                                <label for="route_name" class="form-label fw-bold">Route Name (opsional)</label>
                                <input type="text" class="form-control @error('route_name') is-invalid @enderror" id="route_name" name="route_name" value="{{ old('route_name', $menu->route_name) }}" placeholder="admin.menus.index">
                                <small class="text-muted"><i class="fas fa-info-circle me-1"></i>Contoh: `admin.menus.index`</small>
                                @error('route_name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <div class="col-md-12 mb-4">
                                <label for="url" class="form-label fw-bold">URL Statis (opsional)</label>
                                <input type="text" class="form-control @error('url') is-invalid @enderror" id="url" name="url" value="{{ old('url', $menu->url) }}" placeholder="/admin/dashboard">
                                <small class="text-muted"><i class="fas fa-info-circle me-1"></i>Gunakan jika tidak pakai route name.</small>
                                @error('url') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <div class="col-md-12 mb-4">
                                <label for="parent_id" class="form-label fw-bold">Menu Induk (Parent)</label>
                                <select class="form-select @error('parent_id') is-invalid @enderror" id="parent_id" name="parent_id">
                                    <option value="">-- Tidak Ada (Top Level) --</option>
                                    @foreach($parentMenus as $parent)
                                        <option value="{{ $parent->id }}" {{ old('parent_id', $menu->parent_id) == $parent->id ? 'selected' : '' }}>
                                            {{ $parent->title }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('parent_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <div class="col-md-12 mb-4">
                                <label for="order_num" class="form-label fw-bold">Urutan Tampil (Order)</label>
                                <input type="number" class="form-control @error('order_num') is-invalid @enderror" id="order_num" name="order_num" value="{{ old('order_num', $menu->order_num) }}" required>
                                @error('order_num') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                        </div>

                        <div class="row bg-light rounded p-3 mb-4 mt-2 mx-1 border">
                            <div class="col-md-6">
                                <div class="form-check form-switch mt-2">
                                    <input class="form-check-input" type="checkbox" id="is_header" name="is_header" value="1" {{ old('is_header', $menu->is_header) ? 'checked' : '' }}>
                                    <label class="form-check-label fw-bold" for="is_header">
                                        Jadikan sebagai Header / Label
                                    </label>
                                </div>
                                <small class="text-muted d-block ms-5">Menu tidak akan bisa diklik, hanya tampil sebagai judul grup menu.</small>
                            </div>
                            <div class="col-md-6">
                                <div class="form-check form-switch mt-2">
                                    <input class="form-check-input" type="checkbox" id="is_active" name="is_active" value="1" {{ old('is_active', $menu->is_active) ? 'checked' : '' }}>
                                    <label class="form-check-label fw-bold" for="is_active">
                                        Status Aktif
                                    </label>
                                </div>
                                <small class="text-muted d-block ms-5">Tampilkan menu ini di sidebar.</small>
                            </div>
                        </div>

                        <div class="card shadow-none border mb-4">
                            <div class="card-header bg-light border-bottom pb-2 pt-3">
                                <h6 class="mb-0"><i class="fas fa-users-cog text-primary me-2"></i>Hak Akses (Role)</h6>
                                <p class="text-sm text-muted mb-0">Pilih role mana saja yang dapat melihat menu ini di sidebar.</p>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    @foreach($roles as $role)
                                        <div class="col-md-3 mb-2">
                                            <div class="form-check custom-checkbox">
                                                <input class="form-check-input" type="checkbox" name="roles[]" value="{{ $role->id }}" id="role_{{ $role->id }}" 
                                                {{ in_array($role->id, old('roles', $menuRoles)) ? 'checked' : '' }}>
                                                <label class="form-check-label" for="role_{{ $role->id }}">
                                                    {{ $role->name }}
                                                </label>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        <div class="mt-4 text-end">
                            <button type="submit" class="btn-admin-primary px-4 py-2">
                                <i class="fas fa-save me-1"></i> Simpan Perubahan
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <x-app.footer />
        </div>
    </main>
</x-app-layout>
