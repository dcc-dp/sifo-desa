<x-app-layout>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
        <x-app.navbar />
        <div class="container-fluid py-4 px-5">

            <!-- PAGE HEADER -->
            <div class="admin-page-header">
                <div>
                    <h2 class="admin-page-title">
                        <i class="fas fa-tags"></i>
                        <span>Kategori Berita</span>
                    </h2>
                    <p class="admin-page-subtitle">Kelola klasifikasi dan kategori untuk publikasi berita desa</p>
                </div>
                <div>
                    <a href="{{ route('kategori-create') }}" class="btn-admin-primary">
                        <i class="fas fa-plus"></i>
                        <span>Tambah Kategori</span>
                    </a>
                </div>
            </div>

            <!-- TABLE CARD -->
            <div class="admin-card">
                <div class="admin-card-header">
                    <h5 class="admin-card-title">
                        <i class="fas fa-list text-muted"></i>
                        <span>Daftar Kategori Berita</span>
                    </h5>
                    <div class="admin-search-wrapper">
                        <i class="fas fa-search"></i>
                        <input type="text" id="searchInput" class="admin-search-input" placeholder="Cari kategori...">
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table table-admin">
                        <thead>
                            <tr>
                                <th class="text-center" style="width: 70px;">No</th>
                                <th>Nama Kategori</th>
                                <th class="text-center col-aksi" style="width: 170px;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="tableBody">
                            @forelse ($kategoris as $kategori)
                                <tr>
                                    <td class="text-center fw-semibold text-muted">{{ $loop->iteration }}</td>
                                    <td class="fw-bold text-dark">{{ $kategori->nama_kategori }}</td>
                                    <td class="text-center col-aksi">
                                        <div class="action-buttons-group">
                                            <a href="{{ route('kategori-edit', $kategori->id) }}" class="btn-action-pill btn-action-edit" title="Edit Kategori">
                                                <i class="fas fa-edit"></i> <span>Edit</span>
                                            </a>
                                            <a href="{{ route('kategori-destroy', $kategori->id) }}" class="btn-action-pill btn-action-delete"
                                                title="Hapus Kategori"
                                                onclick="return confirm('Apakah Anda yakin ingin menghapus kategori ini?')">
                                                <i class="fas fa-trash-alt"></i> <span>Hapus</span>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3">
                                        <div class="admin-table-empty">
                                            <i class="fas fa-tags"></i>
                                            <h6>Belum Ada Kategori</h6>
                                            <p>Silakan klik tombol "Tambah Kategori" untuk membuat kategori baru.</p>
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