<x-app-layout>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
        <x-app.navbar />
        <div class="container-fluid py-4 px-5">

            <!-- PAGE HEADER -->
            <div class="admin-page-header">
                <div>
                    <h2 class="admin-page-title">
                        <i class="fas fa-landmark"></i>
                        <span>Sejarah Desa</span>
                    </h2>
                    <p class="admin-page-subtitle">Kelola dokumentasi sejarah, asal-usul, dan babak perjalanan desa</p>
                </div>
                <div>
                    <a href="{{ route('sejarah-create') }}" class="btn-admin-primary">
                        <i class="fas fa-plus"></i>
                        <span>Tambah Sejarah</span>
                    </a>
                </div>
            </div>

            <!-- TABLE CARD -->
            <div class="admin-card">
                <div class="admin-card-header">
                    <h5 class="admin-card-title">
                        <i class="fas fa-list text-muted"></i>
                        <span>Daftar Babak Sejarah</span>
                    </h5>
                    <div class="admin-search-wrapper">
                        <i class="fas fa-search"></i>
                        <input type="text" id="searchInput" class="admin-search-input" placeholder="Cari babak sejarah...">
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table table-admin">
                        <thead>
                            <tr>
                                <th class="text-center" style="width: 60px;">No</th>
                                <th style="width: 80px;">Foto</th>
                                <th>Judul Sejarah</th>
                                <th>Deskripsi Narasi</th>
                                <th class="text-center col-aksi" style="width: 160px;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="tableBody">
                            @forelse ($datas as $sejarah)
                                <tr>
                                    <td class="text-center fw-semibold text-muted">{{ $loop->iteration }}</td>
                                    <td>
                                        @if ($sejarah->gambar && file_exists(public_path($sejarah->gambar)))
                                            <img src="{{ asset($sejarah->gambar) }}" alt="Foto Sejarah" class="table-thumb">
                                        @else
                                            <div class="table-thumb d-flex align-items-center justify-content-center bg-light text-muted">
                                                <i class="fas fa-image"></i>
                                            </div>
                                        @endif
                                    </td>
                                    <td class="fw-bold text-dark">{{ $sejarah->judul }}</td>
                                    <td class="text-muted">
                                        {{ \Illuminate\Support\Str::limit(strip_tags($sejarah->deskripsi), 110, '...') }}
                                    </td>
                                    <td class="text-center col-aksi">
                                        <div class="action-buttons-group">
                                            <a href="{{ route('sejarah-edit', $sejarah->id) }}" class="btn-action-pill btn-action-edit" title="Edit Sejarah">
                                                <i class="fas fa-edit"></i> <span>Edit</span>
                                            </a>
                                            <a href="{{ route('sejarah-destroy', $sejarah->id) }}" class="btn-action-pill btn-action-delete"
                                                title="Hapus Sejarah"
                                                onclick="return confirm('Apakah Anda yakin ingin menghapus data sejarah ini?')">
                                                <i class="fas fa-trash-alt"></i> <span>Hapus</span>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5">
                                        <div class="admin-table-empty">
                                            <i class="fas fa-book-open"></i>
                                            <h6>Belum Ada Data Sejarah</h6>
                                            <p>Silakan klik tombol "Tambah Sejarah" untuk mendokumentasikan sejarah desa.</p>
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