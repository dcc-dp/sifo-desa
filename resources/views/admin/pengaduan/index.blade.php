<x-app-layout>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
        <x-app.navbar />
        <div class="container-fluid py-4 px-5">

            <!-- PAGE HEADER -->
            <div class="admin-page-header">
                <div>
                    <h2 class="admin-page-title">
                        <i class="fas fa-bullhorn"></i>
                        <span>Pengaduan Masyarakat</span>
                    </h2>
                    <p class="admin-page-subtitle">Kelola dan tindak lanjuti laporan, keluhan, dan aspirasi warga desa</p>
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
                        <span>Daftar Laporan Pengaduan</span>
                    </h5>
                    <div class="admin-search-wrapper">
                        <i class="fas fa-search"></i>
                        <input type="text" id="searchInput" class="admin-search-input" placeholder="Cari pelapor atau judul aduan...">
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table table-admin">
                        <thead>
                            <tr>
                                <th class="text-center" style="width: 60px;">No</th>
                                <th>Pelapor</th>
                                <th>Kategori</th>
                                <th>Judul Laporan</th>
                                <th>Uraian Masalah</th>
                                <th class="text-center" style="width: 80px;">Foto</th>
                                <th class="text-center" style="width: 100px;">Lampiran</th>
                                <th class="text-center" style="width: 130px;">Status</th>
                                <th class="text-center col-aksi" style="width: 150px;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="tableBody">
                            @forelse ($pengaduans as $pengaduan)
                                <tr>
                                    <td class="text-center fw-semibold text-muted">{{ $loop->iteration }}</td>
                                    <td>
                                        @if ($pengaduan->anonymous)
                                            <span class="badge bg-light text-muted border px-2 py-1 fs-8">
                                                <i class="fas fa-user-secret me-1"></i> Anonim
                                            </span>
                                        @else
                                            <span class="fw-bold text-dark">{{ $pengaduan->penduduk->nama ?? '-' }}</span>
                                        @endif
                                    </td>
                                    <td>
                                        <span class="badge-kategori">
                                            {{ $pengaduan->kategori->nama_kategori ?? '-' }}
                                        </span>
                                    </td>
                                    <td class="fw-semibold text-dark">{{ $pengaduan->judul }}</td>
                                    <td class="text-muted">
                                        {{ \Illuminate\Support\Str::limit(strip_tags($pengaduan->deskripsi), 80, '...') }}
                                    </td>
                                    <td class="text-center">
                                        @if ($pengaduan->gambar && file_exists(public_path($pengaduan->gambar)))
                                            <a href="{{ asset($pengaduan->gambar) }}" target="_blank">
                                                <img src="{{ asset($pengaduan->gambar) }}" alt="Gambar Aduan" class="table-thumb" style="width: 42px; height: 42px;">
                                            </a>
                                        @else
                                            <span class="text-muted fs-8">-</span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        @if ($pengaduan->file && file_exists(public_path($pengaduan->file)))
                                            <a href="{{ asset($pengaduan->file) }}" target="_blank" class="btn-action-pill btn-action-pdf"
                                                title="Unduh Berkas Lampiran">
                                                <i class="fas fa-paperclip"></i> <span>File</span>
                                            </a>
                                        @else
                                            <span class="text-muted fs-8">-</span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        @if ($pengaduan->status == 1)
                                            <span class="badge-status badge-status-pending">
                                                <i class="fas fa-clock"></i> Proses
                                            </span>
                                        @elseif ($pengaduan->status == 2)
                                            <span class="badge-status badge-status-danger">
                                                <i class="fas fa-times-circle"></i> Ditolak
                                            </span>
                                        @elseif ($pengaduan->status == 3)
                                            <span class="badge-status badge-status-success">
                                                <i class="fas fa-check-circle"></i> Selesai
                                            </span>
                                        @else
                                            <span class="badge-status badge-status-info">
                                                Pending
                                            </span>
                                        @endif
                                    </td>
                                    <td class="text-center col-aksi">
                                        <div class="action-buttons-group">
                                            @can('edit_pengaduan')
                                            <a href="{{ route('admin.pengaduan-edit', $pengaduan->id) }}" class="btn-action-pill btn-action-view"
                                                title="Tindak Lanjuti Pengaduan">
                                                <i class="fas fa-tasks"></i> <span>Tindak Lanjut</span>
                                            </a>
                                            @endcan
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="9">
                                        <div class="admin-table-empty">
                                            <i class="fas fa-clipboard-check"></i>
                                            <h6>Belum Ada Laporan Pengaduan</h6>
                                            <p>Saat ini belum ada keluhan atau aspirasi yang masuk dari masyarakat.</p>
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