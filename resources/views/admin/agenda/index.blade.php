<x-app-layout>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
        <x-app.navbar />
        <div class="container-fluid py-4 px-5">

            <!-- PAGE HEADER -->
            <div class="admin-page-header">
                <div>
                    <h2 class="admin-page-title">
                        <i class="fas fa-calendar-alt"></i>
                        <span>Agenda Kegiatan Desa</span>
                    </h2>
                    <p class="admin-page-subtitle">Jadwal kegiatan, musyawarah, dan acara penting masyarakat desa</p>
                </div>
                <div>
                    <a href="{{ route('agenda-create') }}" class="btn-admin-primary">
                        <i class="fas fa-plus"></i>
                        <span>Tambah Agenda</span>
                    </a>
                </div>
            </div>

            <!-- TABLE CARD -->
            <div class="admin-card">
                <div class="admin-card-header">
                    <h5 class="admin-card-title">
                        <i class="fas fa-list text-muted"></i>
                        <span>Daftar Agenda Kegiatan</span>
                    </h5>
                    <div class="admin-search-wrapper">
                        <i class="fas fa-search"></i>
                        <input type="text" id="searchInput" class="admin-search-input" placeholder="Cari nama kegiatan...">
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table table-admin">
                        <thead>
                            <tr>
                                <th class="text-center" style="width: 70px;">No</th>
                                <th>Nama Kegiatan</th>
                                <th>Waktu Pelaksanaan</th>
                                <th class="text-center col-aksi" style="width: 170px;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="tableBody">
                            @forelse ($agendas as $agenda)
                                <tr>
                                    <td class="text-center fw-semibold text-muted">{{ $loop->iteration }}</td>
                                    <td class="fw-bold text-dark">{{ $agenda->nama_kegiatan }}</td>
                                    <td>
                                        <span class="badge-kategori">
                                            <i class="fas fa-clock text-success me-1"></i>
                                            {{ \Carbon\Carbon::parse($agenda->waktu_pelaksanaan)->translatedFormat('d F Y - H:i') }} WITA
                                        </span>
                                    </td>
                                    <td class="text-center col-aksi">
                                        <div class="action-buttons-group">
                                            <a href="{{ route('agenda-edit', $agenda->id) }}" class="btn-action-pill btn-action-edit" title="Edit Agenda">
                                                <i class="fas fa-edit"></i> <span>Edit</span>
                                            </a>
                                            <a href="{{ route('agenda-destroy', $agenda->id) }}" class="btn-action-pill btn-action-delete"
                                                title="Hapus Agenda"
                                                onclick="return confirm('Apakah Anda yakin ingin menghapus agenda ini?')">
                                                <i class="fas fa-trash-alt"></i> <span>Hapus</span>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4">
                                        <div class="admin-table-empty">
                                            <i class="fas fa-calendar-times"></i>
                                            <h6>Belum Ada Agenda</h6>
                                            <p>Silakan klik tombol "Tambah Agenda" untuk membuat jadwal kegiatan baru.</p>
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