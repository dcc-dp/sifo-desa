<x-app-layout>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
        <x-app.navbar />
        <div class="container-fluid py-4 px-5">

            <!-- PAGE HEADER -->
            <div class="admin-page-header">
                <div>
                    <h2 class="admin-page-title">
                        <i class="fas fa-users"></i>
                        <span>Data Kependudukan Desa</span>
                    </h2>
                    <p class="admin-page-subtitle">Kelola catatan administrasi data kependudukan warga desa</p>
                </div>
                <div>
                    <a href="{{ route('data.penduduk-create') }}" class="btn-admin-primary">
                        <i class="fas fa-user-plus"></i>
                        <span>Tambah Data Penduduk</span>
                    </a>
                </div>
            </div>

            <!-- TABLE CARD -->
            <div class="admin-card">
                <div class="admin-card-header">
                    <h5 class="admin-card-title">
                        <i class="fas fa-list text-muted"></i>
                        <span>Daftar Penduduk Terdaftar</span>
                    </h5>
                    <div class="admin-search-wrapper">
                        <i class="fas fa-search"></i>
                        <input type="text" id="search" class="admin-search-input" placeholder="Cari NIK atau nama warga...">
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table table-admin">
                        <thead>
                            <tr>
                                <th class="text-center" style="width: 60px;">No</th>
                                <th style="width: 150px;">NIK</th>
                                <th>Nama Lengkap</th>
                                <th>Tempat Lahir</th>
                                <th>Tanggal Lahir</th>
                                <th>Alamat</th>
                                <th style="width: 130px;">Pekerjaan</th>
                                <th class="text-center col-aksi" style="width: 210px;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="penduduk-table">
                            @forelse ($data as $index => $y)
                                <tr>
                                    <td class="text-center fw-semibold text-muted">{{ $loop->iteration }}</td>
                                    <td class="fw-bold font-monospace text-dark">{{ $y->nik }}</td>
                                    <td class="fw-bold text-dark">{{ $y->nama }}</td>
                                    <td>{{ $y->tempat_lahir }}</td>
                                    <td>{{ \Carbon\Carbon::parse($y->tanggal_lahir)->translatedFormat('d M Y') }}</td>
                                    <td class="text-muted">{{ $y->alamat }}</td>
                                    <td>
                                        <span class="badge-kategori">
                                            {{ $y->pekerjaan }}
                                        </span>
                                    </td>
                                    <td class="text-center col-aksi">
                                        <div class="action-buttons-group">
                                            <a href="{{ route('data.penduduk-show', $y->id) }}" class="btn-action-pill btn-action-view" title="Detail Penduduk">
                                                <i class="fas fa-eye"></i> <span>Detail</span>
                                            </a>
                                            <a href="{{ route('data.penduduk-edit', $y->id) }}" class="btn-action-pill btn-action-edit" title="Edit Penduduk">
                                                <i class="fas fa-edit"></i> <span>Edit</span>
                                            </a>
                                            <form action="{{ route('data.penduduk-destroy', $y->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn-action-pill btn-action-delete" title="Hapus Penduduk"
                                                    onclick="return confirm('Apakah Anda yakin ingin menghapus data penduduk ini?')">
                                                    <i class="fas fa-trash-alt"></i> <span>Hapus</span>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8">
                                        <div class="admin-table-empty">
                                            <i class="fas fa-users-slash"></i>
                                            <h6>Belum Ada Data Penduduk</h6>
                                            <p>Silakan klik tombol "Tambah Data Penduduk" untuk menginput warga baru.</p>
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

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#search').on('keyup', function() {
                let keyword = $(this).val();

                $.ajax({
                    url: "{{ route('data.penduduk-search') }}",
                    method: 'GET',
                    data: {
                        keyword: keyword
                    },
                    success: function(data) {
                        let rows = '';

                        if (data.length === 0) {
                            rows = `
                            <tr>
                                <td colspan="8">
                                    <div class="admin-table-empty">
                                        <i class="fas fa-search"></i>
                                        <h6>Data Tidak Ditemukan</h6>
                                        <p>Tidak ada warga yang cocok dengan kata kunci pencarian.</p>
                                    </div>
                                </td>
                            </tr>
                            `;
                        } else {
                            data.forEach((item, index) => {
                                rows += generateTableRow(item, index);
                            });
                        }

                        $('#penduduk-table').html(rows);
                    },
                    error: function(xhr) {
                        console.error("Terjadi kesalahan saat mengambil data:", xhr.statusText);
                        $('#penduduk-table').html(
                            '<tr><td colspan="8" class="text-center py-4 text-danger">Terjadi kesalahan saat mencari data. Silakan coba lagi.</td></tr>'
                        );
                    }
                });
            });

            // Template builder function matching admin design system
            function generateTableRow(item, index) {
                return `
                <tr>
                    <td class="text-center fw-semibold text-muted">${index + 1}</td>
                    <td class="fw-bold font-monospace text-dark">${item.nik || '-'}</td>
                    <td class="fw-bold text-dark">${item.nama || '-'}</td>
                    <td>${item.tempat_lahir || '-'}</td>
                    <td>${item.tanggal_lahir || '-'}</td>
                    <td class="text-muted">${item.alamat || '-'}</td>
                    <td>
                        <span class="badge-kategori">
                            ${item.pekerjaan || '-'}
                        </span>
                    </td>
                    <td class="text-center col-aksi">
                        <div class="action-buttons-group">
                            <a href="/data-penduduk-show/${item.id}" class="btn-action-pill btn-action-view" title="Detail Penduduk">
                                <i class="fas fa-eye"></i> <span>Detail</span>
                            </a>
                            <a href="/data-penduduk-edit/${item.id}" class="btn-action-pill btn-action-edit" title="Edit Penduduk">
                                <i class="fas fa-edit"></i> <span>Edit</span>
                            </a>
                            <form action="/data-penduduk-destroy/${item.id}" method="POST" class="d-inline">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <input type="hidden" name="_method" value="DELETE">
                                <button type="submit" class="btn-action-pill btn-action-delete" title="Hapus Penduduk"
                                    onclick="return confirm('Apakah Anda yakin ingin menghapus data penduduk ini?')">
                                    <i class="fas fa-trash-alt"></i> <span>Hapus</span>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                `;
            }
        });
    </script>
</x-app-layout>
