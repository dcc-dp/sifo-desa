<x-app-layout>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
        <x-app.navbar />
        <div class="container-fluid py-4 px-5">
            
            <!-- PAGE HEADER -->
            <div class="admin-page-header">
                <div>
                    <h2 class="admin-page-title">
                        <i class="fas fa-newspaper"></i>
                        <span>Manajemen Berita</span>
                    </h2>
                    <p class="admin-page-subtitle">Kelola dan publikasikan informasi serta berita kegiatan Desa</p>
                </div>
                <div>
                    @can('create_berita')
                    <a href="{{ route('berita-create') }}" class="btn-admin-primary">
                        <i class="fas fa-plus"></i>
                        <span>Tambah Berita</span>
                    </a>
                    @endcan
                </div>
            </div>

            <!-- TABLE CARD -->
            <div class="admin-card">
                <div class="admin-card-header">
                    <h5 class="admin-card-title">
                        <i class="fas fa-list text-muted"></i>
                        <span>Daftar Berita Desa</span>
                    </h5>
                    <div class="admin-search-wrapper">
                        <i class="fas fa-search"></i>
                        <input type="text" id="searchInput" class="admin-search-input" placeholder="Cari judul berita...">
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table table-admin">
                        <thead>
                            <tr>
                                <th class="text-center" style="width: 60px;">No</th>
                                <th style="width: 80px;">Gambar</th>
                                <th>Judul Berita</th>
                                <th style="width: 130px;">Kategori</th>
                                <th>Deskripsi</th>
                                <th class="text-center col-aksi" style="width: 160px;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="tableBody">
                            @forelse ($beritas as $berita)
                                <tr>
                                    <td class="text-center fw-semibold text-muted">{{ $loop->iteration }}</td>
                                    <td>
                                        @if ($berita->gambar && file_exists(public_path($berita->gambar)))
                                            <img src="{{ asset($berita->gambar) }}" alt="Gambar Berita" class="table-thumb">
                                        @else
                                            <div class="table-thumb d-flex align-items-center justify-content-center bg-light text-muted">
                                                <i class="fas fa-image"></i>
                                            </div>
                                        @endif
                                    </td>
                                    <td class="fw-bold text-dark">{{ $berita->judul }}</td>
                                    <td>
                                        <span class="badge-kategori">
                                            {{ $berita->kategori->nama_kategori ?? '-' }}
                                        </span>
                                    </td>
                                    <td class="text-muted">
                                        {{ \Illuminate\Support\Str::limit(strip_tags($berita->deskripsi), 95, '...') }}
                                    </td>
                                    <td class="text-center col-aksi">
                                        <div class="action-buttons-group">
                                            @can('edit_berita')
                                            <a href="{{ route('berita-edit', $berita->id) }}" class="btn-action-pill btn-action-edit" title="Edit Berita">
                                                <i class="fas fa-edit"></i> <span>Edit</span>
                                            </a>
                                            @endcan
                                            
                                            @can('delete_berita')
                                            <a href="{{ route('berita-destroy', $berita->id) }}" class="btn-action-pill btn-action-delete"
                                                title="Hapus Berita"
                                                onclick="return confirm('Apakah Anda yakin ingin menghapus berita ini?')">
                                                <i class="fas fa-trash-alt"></i> <span>Hapus</span>
                                            </a>
                                            @endcan
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6">
                                        <div class="admin-table-empty">
                                            <i class="fas fa-newspaper"></i>
                                            <h6>Belum Ada Data Berita</h6>
                                            <p>Silakan klik tombol "Tambah Berita" untuk menambahkan informasi baru.</p>
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