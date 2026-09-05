<x-app-layout>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
        <x-app.navbar />
        <div class="container-fluid py-4 px-5">

            <!-- PAGE HEADER -->
            <div class="admin-page-header">
                <div>
                    <h2 class="admin-page-title">
                        <i class="fas fa-bars"></i>
                        <span>Manajemen Menu</span>
                    </h2>
                    <p class="admin-page-subtitle">Kelola menu aplikasi dan hak aksesnya</p>
                </div>
                <div>
                    @can('create_menus')
                    <a href="{{ route('admin.menus.create') }}" class="btn-admin-primary">
                        <i class="fas fa-plus"></i>
                        <span>Tambah Menu</span>
                    </a>
                    @endcan
                </div>
            </div>

            @if(session('success'))
                <div class="alert alert-success text-white">
                    {{ session('success') }}
                </div>
            @endif
            @if(session('error'))
                <div class="alert alert-danger text-white">
                    {{ session('error') }}
                </div>
            @endif

            <!-- TABLE CARD -->
            <div class="admin-card">
                <div class="admin-card-header">
                    <h5 class="admin-card-title">
                        <i class="fas fa-list text-muted"></i>
                        <span>Daftar Menu</span>
                    </h5>
                    <div class="admin-search-wrapper">
                        <i class="fas fa-search"></i>
                        <input type="text" id="searchInput" class="admin-search-input" placeholder="Cari menu...">
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table table-admin">
                        <thead>
                            <tr>
                                <th class="text-center" style="width: 50px;">No</th>
                                <th>Judul</th>
                                <th>Route / URL</th>
                                <th>Order</th>
                                <th>Parent</th>
                                <th>Akses (Role)</th>
                                <th>Status</th>
                                <th class="text-center col-aksi" style="width: 160px;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="tableBody">
                            @forelse ($menus as $menu)
                                <tr>
                                    <td class="text-center fw-semibold text-muted">{{ $loop->iteration }}</td>
                                    <td class="fw-bold text-dark">
                                        @if($menu->is_header)
                                            <span class="badge bg-primary me-1">Header</span>
                                        @endif
                                        {!! $menu->icon !!} {{ $menu->title }}
                                    </td>
                                    <td>{{ $menu->route_name ?: $menu->url ?: '-' }}</td>
                                    <td>{{ $menu->order_num }}</td>
                                    <td>{{ $menu->parent ? $menu->parent->title : '-' }}</td>
                                    <td>
                                        @foreach($menu->roles as $role)
                                            <span class="badge bg-info text-white px-2 py-1 fs-8 mb-1">{{ $role->name }}</span>
                                        @endforeach
                                    </td>
                                    <td>
                                        @if($menu->is_active)
                                            <span class="badge bg-success text-white">Aktif</span>
                                        @else
                                            <span class="badge bg-danger text-white">Tidak Aktif</span>
                                        @endif
                                    </td>
                                    <td class="text-center col-aksi">
                                        <div class="action-buttons-group">
                                            @can('edit_menus')
                                            <a href="{{ route('admin.menus.edit', $menu->id) }}" class="btn-action-pill btn-action-edit" title="Edit Menu">
                                                <i class="fas fa-edit"></i> <span>Edit</span>
                                            </a>
                                            @endcan
                                            @can('delete_menus')
                                            <form action="{{ route('admin.menus.destroy', $menu->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus menu ini?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn-action-pill btn-action-delete" title="Hapus Menu" style="border: none; background: transparent;">
                                                    <i class="fas fa-trash-alt"></i> <span>Hapus</span>
                                                </button>
                                            </form>
                                            @endcan
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8">
                                        <div class="admin-table-empty">
                                            <i class="fas fa-bars"></i>
                                            <h6>Belum Ada Data Menu</h6>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <x-app.footer />
        </div>
    </main>

    <script>
        document.getElementById('searchInput')?.addEventListener('keyup', function () {
            let keyword = this.value.toLowerCase();
            let rows = document.querySelectorAll('#tableBody tr');
            rows.forEach(row => {
                row.style.display = row.textContent.toLowerCase().includes(keyword) ? '' : 'none';
            });
        });
    </script>
</x-app-layout>
