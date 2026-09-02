<x-app-layout>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
        <x-app.navbar />
        <div class="container-fluid py-4 px-5">

            <!-- PAGE HEADER -->
            <div class="admin-page-header">
                <div>
                    <h2 class="admin-page-title">
                        <i class="fas fa-images"></i>
                        <span>Galeri & Dokumentasi Kegiatan</span>
                    </h2>
                    <p class="admin-page-subtitle">Kelola album dan foto dokumentasi kegiatan masyarakat desa</p>
                </div>
                <div>
                    <a href="{{ route('batchgaleri.create') }}" class="btn-admin-primary">
                        <i class="fas fa-plus"></i>
                        <span>Tambah Album Galeri</span>
                    </a>
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
                        <i class="fas fa-folder-open text-muted"></i>
                        <span>Daftar Album Dokumentasi</span>
                    </h5>
                    <div class="admin-search-wrapper">
                        <i class="fas fa-search"></i>
                        <input type="text" id="searchInput" class="admin-search-input" placeholder="Cari nama album...">
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table table-admin">
                        <thead>
                            <tr>
                                <th class="text-center" style="width: 70px;">No</th>
                                <th>Nama Album / Kumpulan Foto</th>
                                <th class="text-center col-aksi" style="width: 260px;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="tableBody">
                            @forelse ($batches as $y)
                                <tr>
                                    <td class="text-center fw-semibold text-muted">{{ $loop->iteration }}</td>
                                    <td class="fw-bold text-dark">
                                        <div class="d-flex align-items-center gap-2">
                                            <div class="bg-light p-2 rounded text-primary">
                                                <i class="fas fa-folder"></i>
                                            </div>
                                            <span>{{ $y->nama }}</span>
                                        </div>
                                    </td>
                                    <td class="text-center col-aksi">
                                        <div class="action-buttons-group">
                                            <a href="{{ route('batchgaleri.show', $y->id) }}" class="btn-action-pill btn-action-view" title="Kelola Foto">
                                                <i class="fas fa-images"></i> <span>Kelola Foto</span>
                                            </a>
                                            <a href="{{ route('batchgaleri.edit', $y->id) }}" class="btn-action-pill btn-action-edit" title="Edit Nama Album">
                                                <i class="fas fa-edit"></i> <span>Edit</span>
                                            </a>
                                            <form action="{{ route('batchgaleri.destroy', $y->id) }}" method="POST" class="d-inline"
                                                onsubmit="return confirm('Apakah Anda yakin ingin menghapus album ini beserta semua foto di dalamnya?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn-action-pill btn-action-delete" title="Hapus Album">
                                                    <i class="fas fa-trash-alt"></i> <span>Hapus</span>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3">
                                        <div class="admin-table-empty">
                                            <i class="fas fa-images"></i>
                                            <h6>Belum Ada Album Galeri</h6>
                                            <p>Silakan klik tombol "Tambah Album Galeri" untuk membuat album baru.</p>
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