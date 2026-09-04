<x-app-layout>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
        <x-app.navbar />
        <div class="container-fluid py-4 px-5">

            <!-- PAGE HEADER -->
            <div class="admin-page-header">
                <div>
                    <h2 class="admin-page-title">
                        <i class="fas fa-user-tie"></i>
                        <span>Pemerintah Desa</span>
                    </h2>
                    <p class="admin-page-subtitle">Kelola struktur kepengurusan dan aparatur Pemerintah Desa</p>
                </div>
                <div>
                    <a href="{{ route('pemerintah-create') }}" class="btn-admin-primary">
                        <i class="fas fa-plus"></i>
                        <span>Tambah Aparatur</span>
                    </a>
                </div>
            </div>

            <!-- TABLE CARD -->
            <div class="admin-card">
                <div class="admin-card-header">
                    <h5 class="admin-card-title">
                        <i class="fas fa-list text-muted"></i>
                        <span>Daftar Aparatur & Perangkat Desa</span>
                    </h5>
                    <div class="admin-search-wrapper">
                        <i class="fas fa-search"></i>
                        <input type="text" id="searchInput" class="admin-search-input" placeholder="Cari nama atau jabatan...">
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table table-admin">
                        <thead>
                            <tr>
                                <th class="text-center" style="width: 50px;">No</th>
                                <th style="width: 70px;">Foto</th>
                                <th style="min-width: 170px;">Nama Lengkap</th>
                                <th style="min-width: 150px;">Jabatan</th>
                                <th>Tugas Pokok & Fungsi (Tupoksi)</th>
                                <th class="text-center col-aksi" style="width: 160px;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="tableBody">
                            @forelse ($pemerintahs as $pemerintah)
                                <tr>
                                    <td class="text-center fw-semibold text-muted">{{ $loop->iteration }}</td>
                                    <td>
                                        @if ($pemerintah->foto && file_exists(public_path($pemerintah->foto)))
                                            <img src="{{ asset($pemerintah->foto) }}" alt="{{ $pemerintah->nama }}" class="table-avatar">
                                        @else
                                            <div class="table-avatar d-flex align-items-center justify-content-center bg-light text-muted">
                                                <i class="fas fa-user"></i>
                                            </div>
                                        @endif
                                    </td>
                                    <td class="fw-bold text-dark">{{ $pemerintah->nama }}</td>
                                    <td>
                                        @if(stripos($pemerintah->jabatan, 'Kepala Desa') !== false)
                                            <span class="badge bg-success text-white px-2 py-1 fs-8 fw-semibold">
                                                <i class="fas fa-crown me-1 text-warning"></i> {{ $pemerintah->jabatan }}
                                            </span>
                                            <small class="text-muted d-block mt-1 fs-8"><i class="fas fa-star text-warning"></i> Pimpinan Beranda & Surat</small>
                                        @else
                                            <span class="badge-kategori">
                                                {{ $pemerintah->jabatan }}
                                            </span>
                                        @endif
                                    </td>
                                    <td class="text-muted">
                                        {{ \Illuminate\Support\Str::limit(strip_tags($pemerintah->tupoksi), 120, '...') }}
                                    </td>
                                    <td class="text-center col-aksi">
                                        <div class="action-buttons-group">
                                            <a href="{{ route('pemerintah-edit', $pemerintah->id) }}" class="btn-action-pill btn-action-edit" title="Edit Aparatur">
                                                <i class="fas fa-edit"></i> <span>Edit</span>
                                            </a>
                                            <a href="{{ route('pemerintah-destroy', $pemerintah->id) }}" class="btn-action-pill btn-action-delete"
                                                title="Hapus Aparatur"
                                                onclick="return confirm('Apakah Anda yakin ingin menghapus data aparatur ini?')">
                                                <i class="fas fa-trash-alt"></i> <span>Hapus</span>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6">
                                        <div class="admin-table-empty">
                                            <i class="fas fa-user-friends"></i>
                                            <h6>Belum Ada Data Aparatur</h6>
                                            <p>Silakan klik tombol "Tambah Aparatur" untuk memasukkan data perangkat desa.</p>
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