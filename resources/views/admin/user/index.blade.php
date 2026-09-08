<x-app-layout>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
        <x-app.navbar />
        <div class="container-fluid py-4 px-5">

            <!-- PAGE HEADER -->
            <div class="admin-page-header">
                <div>
                    <h2 class="admin-page-title">
                        <i class="fas fa-users-cog"></i>
                        <span>Manajemen Pengguna Admin</span>
                    </h2>
                    <p class="admin-page-subtitle">Kelola akun dan hak akses administrator portal desa</p>
                </div>
                <div>
                    @can('create_users')
                    <a href="{{ route('admin.user-create') }}" class="btn-admin-primary">
                        <i class="fas fa-plus"></i>
                        <span>Tambah User</span>
                    </a>
                    @endcan
                </div>
            </div>

            <!-- ALERT -->
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show mb-4 text-white border-0" style="background: #15803d;" role="alert">
                    <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <!-- TABLE CARD -->
            <div class="admin-card">
                <div class="admin-card-header">
                    <h5 class="admin-card-title">
                        <i class="fas fa-list text-muted"></i>
                        <span>Daftar Akun Administrator</span>
                    </h5>
                    <div class="admin-search-wrapper">
                        <i class="fas fa-search"></i>
                        <input type="text" id="searchInput" class="admin-search-input" placeholder="Cari nama atau email...">
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table table-admin">
                        <thead>
                            <tr>
                                <th class="text-center" style="width: 70px;">No</th>
                                <th style="width: 170px;">NIK Terhubung</th>
                                <th>Nama Lengkap</th>
                                <th>Alamat Email</th>
                                <th class="text-center col-aksi" style="width: 170px;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="tableBody">
                            @forelse($users as $user)
                                <tr>
                                    <td class="text-center fw-semibold text-muted">{{ $loop->iteration }}</td>
                                    <td class="font-monospace fw-semibold text-muted">{{ $user->nik_id ?? '-' }}</td>
                                    <td class="fw-bold text-dark">
                                        <div class="d-flex align-items-center gap-2">
                                            <div class="table-avatar d-flex align-items-center justify-content-center bg-primary text-white fs-7 fw-bold" style="width: 34px; height: 34px;">
                                                {{ strtoupper(substr($user->name, 0, 1)) }}
                                            </div>
                                            <span>{{ $user->name }}</span>
                                        </div>
                                    </td>
                                    <td class="text-muted">{{ $user->email }}</td>
                                    <td class="text-center col-aksi">
                                        <div class="action-buttons-group">
                                            @can('edit_users')
                                            <a href="{{ route('admin.user-edit', $user->id) }}" class="btn-action-pill btn-action-edit" title="Edit User">
                                                <i class="fas fa-edit"></i> <span>Edit</span>
                                            </a>
                                            @endcan
                                            @can('delete_users')
                                            <a href="{{ route('admin.user-destroy', $user->id) }}" class="btn-action-pill btn-action-delete"
                                                title="Hapus User"
                                                onclick="return confirm('Apakah Anda yakin ingin menghapus user administrator ini?')">
                                                <i class="fas fa-trash-alt"></i> <span>Hapus</span>
                                            </a>
                                            @endcan
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5">
                                        <div class="admin-table-empty">
                                            <i class="fas fa-user-slash"></i>
                                            <h6>Belum Ada Data User</h6>
                                            <p>Silakan klik tombol "Tambah User" untuk membuat akun baru.</p>
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