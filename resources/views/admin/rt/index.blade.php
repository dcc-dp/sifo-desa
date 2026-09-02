<x-app-layout>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
        <x-app.navbar />
        <div class="container-fluid py-4 px-5">

            <!-- PAGE HEADER -->
            <div class="admin-page-header">
                <div>
                    <h2 class="admin-page-title">
                        <i class="fas fa-map-marker-alt"></i>
                        <span>Data Rukun Tetangga (RT)</span>
                    </h2>
                    <p class="admin-page-subtitle">Kelola pembagian wilayah administrasi Rukun Tetangga di Desa</p>
                </div>
                <div>
                    <a href="{{ route('rt-create') }}" class="btn-admin-primary">
                        <i class="fas fa-plus"></i>
                        <span>Tambah RT</span>
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
                        <i class="fas fa-list text-muted"></i>
                        <span>Daftar Wilayah RT</span>
                    </h5>
                    <div class="admin-search-wrapper">
                        <i class="fas fa-search"></i>
                        <input type="text" id="searchInput" class="admin-search-input" placeholder="Cari nomor RT...">
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table table-admin">
                        <thead>
                            <tr>
                                <th class="text-center" style="width: 70px;">No</th>
                                <th>Nomor RT</th>
                                <th class="text-center col-aksi" style="width: 170px;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="tableBody">
                            @forelse ($data as $index => $rt)
                                <tr>
                                    <td class="text-center fw-semibold text-muted">{{ $index + 1 }}</td>
                                    <td class="fw-bold text-dark">
                                        <span class="badge bg-light text-dark border px-3 py-2 fs-6">
                                            RT {{ $rt->nomor_rt }}
                                        </span>
                                    </td>
                                    <td class="text-center col-aksi">
                                        <div class="action-buttons-group">
                                            <a href="{{ route('rt-edit', $rt->id) }}" class="btn-action-pill btn-action-edit" title="Edit RT">
                                                <i class="fas fa-edit"></i> <span>Edit</span>
                                            </a>
                                            <form action="{{ route('rt-destroy', $rt->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn-action-pill btn-action-delete" title="Hapus RT"
                                                    onclick="return confirm('Apakah Anda yakin ingin menghapus data RT ini?')">
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
                                            <i class="fas fa-map-marked-alt"></i>
                                            <h6>Belum Ada Data RT</h6>
                                            <p>Silakan klik tombol "Tambah RT" untuk memasukkan data RT baru.</p>
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
