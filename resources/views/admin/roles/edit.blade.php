<x-app-layout>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
        <x-app.navbar />
        <div class="container-fluid py-4 px-5">

            <div class="admin-page-header mb-4">
                <div>
                    <h2 class="admin-page-title">
                        <i class="fas fa-user-shield text-primary me-2"></i>
                        <span>Edit Role: {{ $role->name }}</span>
                    </h2>
                    <p class="admin-page-subtitle">Atur nama role dan tentukan hak akses (permissions) secara detail</p>
                </div>
                <div>
                    <a href="{{ route('admin.roles.index') }}" class="btn-admin-secondary">
                        <i class="fas fa-arrow-left me-1"></i>
                        <span>Kembali</span>
                    </a>
                </div>
            </div>

            <style>
            /* Modern Permission Matrix Styling */
            .perm-card {
                border-radius: 12px !important;
                border: 1px solid #e2e8f0 !important;
                box-shadow: 0 4px 12px rgba(0, 0, 0, 0.03) !important;
                background-color: #ffffff;
                overflow: hidden;
                transition: all 0.2s ease;
            }
            .perm-card:hover {
                box-shadow: 0 6px 18px rgba(0, 0, 0, 0.06) !important;
            }
            .perm-card-header {
                background: #f8fafc !important;
                border-bottom: 1px solid #e2e8f0 !important;
                padding: 14px 20px !important;
            }
            .perm-table th {
                background: #f1f5f9 !important;
                color: #475569 !important;
                font-size: 0.72rem !important;
                letter-spacing: 0.05em !important;
                font-weight: 700 !important;
                text-transform: uppercase !important;
                padding: 12px 18px !important;
                border-bottom: 1px solid #e2e8f0 !important;
            }
            .perm-table td {
                padding: 14px 18px !important;
                vertical-align: middle !important;
                border-bottom: 1px solid #f1f5f9 !important;
            }
            .perm-table tr:last-child td {
                border-bottom: none !important;
            }
            .perm-table tr:hover td {
                background-color: #f8fafc !important;
            }
            /* Custom Styled Action Badges */
            .perm-badge-label {
                display: inline-block;
                margin-bottom: 0;
                cursor: pointer;
            }
            .perm-check-input {
                display: none;
            }
            .perm-label-badge {
                display: inline-flex;
                align-items: center;
                justify-content: center;
                gap: 6px;
                padding: 6px 14px;
                border-radius: 8px;
                font-size: 0.78rem;
                font-weight: 600;
                cursor: pointer;
                user-select: none;
                transition: all 0.2s ease-in-out;
                border: 1px solid #cbd5e1;
                background-color: #ffffff;
                color: #64748b;
            }
            /* Active States when Checked */
            .perm-check-input:checked + .perm-label-view {
                background-color: #eff6ff !important;
                border-color: #3b82f6 !important;
                color: #1d4ed8 !important;
                box-shadow: 0 2px 5px rgba(59, 130, 246, 0.2) !important;
            }
            .perm-check-input:checked + .perm-label-create {
                background-color: #f0fdf4 !important;
                border-color: #22c55e !important;
                color: #15803d !important;
                box-shadow: 0 2px 5px rgba(34, 197, 94, 0.2) !important;
            }
            .perm-check-input:checked + .perm-label-edit {
                background-color: #fffbeb !important;
                border-color: #f59e0b !important;
                color: #b45309 !important;
                box-shadow: 0 2px 5px rgba(245, 158, 11, 0.2) !important;
            }
            .perm-check-input:checked + .perm-label-delete {
                background-color: #fef2f2 !important;
                border-color: #ef4444 !important;
                color: #b91c1c !important;
                box-shadow: 0 2px 5px rgba(239, 68, 68, 0.2) !important;
            }
            .perm-label-badge:hover {
                transform: translateY(-1px);
                border-color: #94a3b8;
            }
            .btn-toggle-row {
                font-size: 0.72rem;
                font-weight: 600;
                border-radius: 6px;
                padding: 5px 12px;
                background: #ffffff;
                color: #475569;
                border: 1px solid #cbd5e1;
                cursor: pointer;
                transition: all 0.15s ease;
            }
            .btn-toggle-row:hover {
                background: #3b82f6;
                color: #ffffff;
                border-color: #3b82f6;
            }
            </style>

            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-body p-4">
                    <form action="{{ route('admin.roles.update', $role->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-4 bg-light p-3 rounded-3 border">
                            <label for="name" class="form-label font-weight-bold text-dark mb-1">Nama Role</label>
                            <input type="text" class="form-control bg-white @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $role->name) }}" required {{ $role->name === 'Super Admin' ? 'readonly' : '' }}>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <div class="d-flex flex-wrap justify-content-between align-items-center mb-3">
                                <div>
                                    <h5 class="font-weight-bold text-dark mb-0">Hak Akses Modul</h5>
                                    <small class="text-muted">Pilih izin tindakan untuk setiap menu aplikasi</small>
                                </div>
                            </div>

                            @php
                                $allActiveMenus = \App\Models\Menu::where('is_active', true)
                                    ->orderBy('order_num')
                                    ->get();

                                $permissionCategories = [];

                                // Menu Utama (Parentless non-header items)
                                $topLevelItems = $allActiveMenus->where('is_header', false)->whereNull('parent_id');
                                if ($topLevelItems->count() > 0) {
                                    $permissionCategories['Menu Utama'] = $topLevelItems;
                                }

                                // Categories with headers
                                $headers = $allActiveMenus->where('is_header', true);
                                foreach ($headers as $header) {
                                    $children = $allActiveMenus->where('parent_id', $header->id);
                                    if ($children->count() > 0) {
                                        $permissionCategories[$header->title] = $children;
                                    }
                                }

                                // Permissions grouped by module slug key
                                $permissionsByModule = collect($permissions)->groupBy(function($perm) {
                                    $parts = explode('_', $perm->name);
                                    return count($parts) > 1 ? implode('_', array_slice($parts, 1)) : 'lainnya';
                                });
                            @endphp

                            <!-- Control Bar: Search & Select All -->
                            <div class="d-flex flex-wrap justify-content-between align-items-center mb-4 p-3 bg-light rounded-3 border">
                                <div class="d-flex align-items-center gap-2 mb-2 mb-md-0">
                                    <button type="button" class="btn btn-sm btn-primary mb-0 shadow-none" id="btnCheckAll">
                                        <i class="fas fa-check-double me-1"></i> Pilih Semua Hak Akses
                                    </button>
                                    <button type="button" class="btn btn-sm btn-outline-danger mb-0 shadow-none" id="btnUncheckAll">
                                        <i class="fas fa-trash-alt me-1"></i> Hapus Semua Hak Akses
                                    </button>
                                </div>
                                <div style="min-width: 260px;">
                                    <div class="input-group input-group-sm">
                                        <span class="input-group-text bg-white border-end-0"><i class="fas fa-search text-muted"></i></span>
                                        <input type="text" id="searchPermission" class="form-control border-start-0 ps-0" placeholder="Cari nama menu...">
                                    </div>
                                </div>
                            </div>

                            <!-- Category Blocks -->
                            @foreach($permissionCategories as $categoryTitle => $menuItems)
                                @php
                                    $catSlug = \Illuminate\Support\Str::slug($categoryTitle);
                                @endphp
                                <div class="perm-card mb-4 category-block">
                                    <div class="perm-card-header d-flex justify-content-between align-items-center">
                                        <div class="d-flex align-items-center">
                                            <div class="icon icon-shape icon-xs bg-primary text-white rounded-2 me-2 d-flex align-items-center justify-content-center">
                                                <i class="fas fa-folder text-xs"></i>
                                            </div>
                                            <h6 class="mb-0 text-dark font-weight-bold" style="font-size: 0.92rem;">{{ $categoryTitle }}</h6>
                                        </div>
                                        <div class="form-check form-switch mb-0">
                                            <input class="form-check-input check-category cursor-pointer" type="checkbox" id="cat_{{ $catSlug }}" data-category="{{ $catSlug }}">
                                            <label class="form-check-label text-dark text-xs mb-0 cursor-pointer fw-semibold" for="cat_{{ $catSlug }}">Pilih Semua di {{ $categoryTitle }}</label>
                                        </div>
                                    </div>
                                    <div class="card-body p-0">
                                        <div class="table-responsive">
                                            <table class="table perm-table align-items-center mb-0">
                                                <thead>
                                                    <tr>
                                                        <th class="ps-4" style="width: 32%;">Nama Menu</th>
                                                        <th class="text-center" style="width: 14%;">Lihat (View)</th>
                                                        <th class="text-center" style="width: 14%;">Tambah (Create)</th>
                                                        <th class="text-center" style="width: 14%;">Ubah (Edit)</th>
                                                        <th class="text-center" style="width: 14%;">Hapus (Delete)</th>
                                                        <th class="text-center" style="width: 12%;">Baris</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($menuItems as $item)
                                                        @php
                                                            $moduleSlug = \Illuminate\Support\Str::slug($item->title, '_');
                                                            $mappedSlug = match($item->route_name) {
                                                                'admin.user-index' => 'users',
                                                                'admin.roles.index' => 'roles',
                                                                'admin.menus.index' => 'menus',
                                                                'admin.setting.edit' => 'setting',
                                                                'data.penduduk-index' => 'penduduk',
                                                                'rt-index' => 'rt',
                                                                'rw-index' => 'rw',
                                                                'batchgaleri.index' => 'galeri',
                                                                'sejarah-index' => 'sejarah',
                                                                'berita-index' => 'berita',
                                                                'kategori-index' => 'kategori',
                                                                'agenda-index' => 'agenda',
                                                                'admin.pengaduan-index' => 'pengaduan',
                                                                'admin.pengajuan-surat.index' => 'surat',
                                                                default => $moduleSlug
                                                            };

                                                            $itemPerms = $permissionsByModule->get($mappedSlug, $permissionsByModule->get($moduleSlug, collect()));
                                                            
                                                            $viewPerm = $itemPerms->firstWhere('name', 'view_' . $mappedSlug) ?? $itemPerms->firstWhere('name', 'view_' . $moduleSlug);
                                                            $createPerm = $itemPerms->firstWhere('name', 'create_' . $mappedSlug) ?? $itemPerms->firstWhere('name', 'create_' . $moduleSlug);
                                                            $editPerm = $itemPerms->firstWhere('name', 'edit_' . $mappedSlug) ?? $itemPerms->firstWhere('name', 'edit_' . $moduleSlug);
                                                            $deletePerm = $itemPerms->firstWhere('name', 'delete_' . $mappedSlug) ?? $itemPerms->firstWhere('name', 'delete_' . $moduleSlug);
                                                        @endphp
                                                        <tr class="menu-row" data-title="{{ strtolower($item->title) }}" data-cat="{{ $catSlug }}">
                                                            <td class="ps-4">
                                                                <div class="d-flex align-items-center">
                                                                    @if(!empty($item->icon))
                                                                        <span class="me-2 text-primary">{!! $item->icon !!}</span>
                                                                    @endif
                                                                    <span class="text-sm font-weight-semibold text-dark">{{ $item->title }}</span>
                                                                </div>
                                                            </td>
                                                            <td class="text-center">
                                                                @if($viewPerm)
                                                                    <label class="perm-badge-label">
                                                                        <input class="perm-check-input cat-perm-{{ $catSlug }}" type="checkbox" name="permissions[]" value="{{ $viewPerm->name }}" {{ in_array($viewPerm->name, $rolePermissions) ? 'checked' : '' }}>
                                                                        <span class="perm-label-badge perm-label-view"><i class="fas fa-eye"></i> View</span>
                                                                    </label>
                                                                @else
                                                                    <span class="text-xs text-muted">-</span>
                                                                @endif
                                                            </td>
                                                            <td class="text-center">
                                                                @if($createPerm)
                                                                    <label class="perm-badge-label">
                                                                        <input class="perm-check-input cat-perm-{{ $catSlug }}" type="checkbox" name="permissions[]" value="{{ $createPerm->name }}" {{ in_array($createPerm->name, $rolePermissions) ? 'checked' : '' }}>
                                                                        <span class="perm-label-badge perm-label-create"><i class="fas fa-plus"></i> Create</span>
                                                                    </label>
                                                                @else
                                                                    <span class="text-xs text-muted">-</span>
                                                                @endif
                                                            </td>
                                                            <td class="text-center">
                                                                @if($editPerm)
                                                                    <label class="perm-badge-label">
                                                                        <input class="perm-check-input cat-perm-{{ $catSlug }}" type="checkbox" name="permissions[]" value="{{ $editPerm->name }}" {{ in_array($editPerm->name, $rolePermissions) ? 'checked' : '' }}>
                                                                        <span class="perm-label-badge perm-label-edit"><i class="fas fa-edit"></i> Edit</span>
                                                                    </label>
                                                                @else
                                                                    <span class="text-xs text-muted">-</span>
                                                                @endif
                                                            </td>
                                                            <td class="text-center">
                                                                @if($deletePerm)
                                                                    <label class="perm-badge-label">
                                                                        <input class="perm-check-input cat-perm-{{ $catSlug }}" type="checkbox" name="permissions[]" value="{{ $deletePerm->name }}" {{ in_array($deletePerm->name, $rolePermissions) ? 'checked' : '' }}>
                                                                        <span class="perm-label-badge perm-label-delete"><i class="fas fa-trash-alt"></i> Delete</span>
                                                                    </label>
                                                                @else
                                                                    <span class="text-xs text-muted">-</span>
                                                                @endif
                                                            </td>
                                                            <td class="text-center">
                                                                <button type="button" class="btn-toggle-row check-row-btn" title="Pilih Semua di Baris Ini">
                                                                    <i class="fas fa-check-square me-1"></i> Baris
                                                                </button>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <div class="text-end mt-4 pt-3 border-top">
                            <button type="submit" class="btn-admin-primary px-4 py-2">
                                <i class="fas fa-save me-1"></i> Update Role
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <x-app.footer />
        </div>
    </main>

    <script>
    document.addEventListener('DOMContentLoaded', function () {
        // 1. Search Filter
        const searchInput = document.getElementById('searchPermission');
        if (searchInput) {
            searchInput.addEventListener('keyup', function () {
                const query = this.value.toLowerCase().trim();
                document.querySelectorAll('.menu-row').forEach(row => {
                    const title = row.getAttribute('data-title');
                    if (title.includes(query)) {
                        row.style.display = '';
                    } else {
                        row.style.display = 'none';
                    }
                });

                // Hide empty category blocks
                document.querySelectorAll('.category-block').forEach(catBlock => {
                    const visibleRows = catBlock.querySelectorAll('.menu-row:not([style*="display: none"])');
                    catBlock.style.display = visibleRows.length > 0 ? '' : 'none';
                });
            });
        }

        // 2. Global Check All / Uncheck All
        const btnCheckAll = document.getElementById('btnCheckAll');
        const btnUncheckAll = document.getElementById('btnUncheckAll');
        if (btnCheckAll) {
            btnCheckAll.addEventListener('click', function () {
                document.querySelectorAll('.perm-check-input').forEach(cb => cb.checked = true);
                document.querySelectorAll('.check-category').forEach(cb => cb.checked = true);
            });
        }
        if (btnUncheckAll) {
            btnUncheckAll.addEventListener('click', function () {
                document.querySelectorAll('.perm-check-input').forEach(cb => cb.checked = false);
                document.querySelectorAll('.check-category').forEach(cb => cb.checked = false);
            });
        }

        // 3. Category Select All Switch
        document.querySelectorAll('.check-category').forEach(catSwitch => {
            catSwitch.addEventListener('change', function () {
                const catSlug = this.getAttribute('data-category');
                document.querySelectorAll('.cat-perm-' + catSlug).forEach(cb => {
                    cb.checked = this.checked;
                });
            });
        });

        // 4. Row Select All Toggle Button
        document.querySelectorAll('.check-row-btn').forEach(btn => {
            btn.addEventListener('click', function () {
                const tr = this.closest('tr');
                const checkboxes = tr.querySelectorAll('.perm-check-input');
                const allChecked = Array.from(checkboxes).every(cb => cb.checked);
                checkboxes.forEach(cb => cb.checked = !allChecked);
            });
        });
    });
    </script>
</x-app-layout>
