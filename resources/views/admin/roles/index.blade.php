<x-app-layout>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
        <x-app.navbar />
        <div class="container-fluid py-4 px-5">

            <!-- PAGE HEADER -->
            <div class="admin-page-header">
                <div>
                    <h2 class="admin-page-title">
                        <i class="fas fa-shield-alt"></i>
                        <span>Manajemen Role</span>
                    </h2>
                    <p class="admin-page-subtitle">Kelola peran dan hak akses pengguna</p>
                </div>
                <div>
                    @can('create_roles')
                    <a href="{{ route('admin.roles.create') }}" class="btn-admin-primary">
                        <i class="fas fa-plus"></i>
                        <span>Tambah Role</span>
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
                        <span>Daftar Role</span>
                    </h5>
                    <div class="admin-search-wrapper">
                        <i class="fas fa-search"></i>
                        <input type="text" id="searchInput" class="admin-search-input" placeholder="Cari role...">
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table table-admin">
                        <thead>
                            <tr>
                                <th class="text-center" style="width: 50px;">No</th>
                                <th>Nama Role</th>
                                <th>Permissions</th>
                                <th class="text-center col-aksi" style="width: 160px;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="tableBody">
                            @forelse ($roles as $role)
                                <tr>
                                    <td class="text-center fw-semibold text-muted">{{ $loop->iteration }}</td>
                                    <td class="fw-bold text-dark">{{ $role->name }}</td>
                                    <td>
                                        @foreach($role->permissions as $permission)
                                            <span class="badge bg-info text-white px-2 py-1 fs-8 mb-1">{{ $permission->name }}</span>
                                        @endforeach
                                    </td>
                                    <td class="text-center col-aksi">
                                        <div class="action-buttons-group">
                                            @can('edit_roles')
                                            <a href="{{ route('admin.roles.edit', $role->id) }}" class="btn-action-pill btn-action-edit" title="Edit Role">
                                                <i class="fas fa-edit"></i> <span>Edit</span>
                                            </a>
                                            @endcan
                                            @if($role->name !== 'Super Admin')
                                            @can('delete_roles')
                                            <form action="{{ route('admin.roles.destroy', $role->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus role ini?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn-action-pill btn-action-delete" title="Hapus Role" style="border: none; background: transparent;">
                                                    <i class="fas fa-trash-alt"></i> <span>Hapus</span>
                                                </button>
                                            </form>
                                            @endcan
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4">
                                        <div class="admin-table-empty">
                                            <i class="fas fa-shield-alt"></i>
                                            <h6>Belum Ada Data Role</h6>
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
