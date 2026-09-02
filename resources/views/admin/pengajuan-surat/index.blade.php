<x-app-layout>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
        <x-app.navbar />
        <div class="container-fluid py-4 px-5">

            <!-- PAGE HEADER -->
            <div class="admin-page-header">
                <div>
                    <h2 class="admin-page-title">
                        <i class="fas fa-envelope-open-text"></i>
                        <span>Pelayanan Permohonan Surat</span>
                    </h2>
                    <p class="admin-page-subtitle">Verifikasi berkas, persetujuan penerbitan, dan arsip surat keterangan warga</p>
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
                        <span>Daftar Permohonan Surat Masuk</span>
                    </h5>
                    <div class="admin-search-wrapper">
                        <i class="fas fa-search"></i>
                        <input type="text" id="searchInput" class="admin-search-input" placeholder="Cari pemohon atau nomor surat...">
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table table-admin">
                        <thead>
                            <tr>
                                <th class="text-center" style="width: 60px;">No</th>
                                <th>Nomor Surat</th>
                                <th>Nama Pemohon</th>
                                <th>NIK</th>
                                <th>Jenis Surat</th>
                                <th>Tanggal Dibuat</th>
                                <th class="text-center" style="width: 120px;">Status</th>
                                <th class="text-center col-aksi" style="width: 180px;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="tableBody">
                            @forelse ($surats as $surat)
                                <tr>
                                    <td class="text-center fw-semibold text-muted">{{ $loop->iteration }}</td>
                                    <td>
                                        @if ($surat->nomor_surat)
                                            <span class="font-monospace fw-bold text-dark fs-7">{{ $surat->nomor_surat }}</span>
                                        @else
                                            <span class="badge bg-light text-muted border fs-8">Belum Terbit</span>
                                        @endif
                                    </td>
                                    <td class="fw-bold text-dark">{{ $surat->penduduk->nama ?? '-' }}</td>
                                    <td class="font-monospace text-muted">{{ $surat->penduduk->nik ?? '-' }}</td>
                                    <td>
                                        <span class="badge-kategori">
                                            {{ $surat->keterangan }}
                                        </span>
                                    </td>
                                    <td>{{ \Carbon\Carbon::parse($surat->tanggal_dibuat)->translatedFormat('d M Y') }}</td>
                                    <td class="text-center">
                                        @if($surat->status == 'menunggu')
                                            <span class="badge-status badge-status-pending">
                                                <i class="fas fa-clock"></i> Menunggu
                                            </span>
                                        @elseif($surat->status == 'diterima')
                                            <span class="badge-status badge-status-success">
                                                <i class="fas fa-check-circle"></i> Diterima
                                            </span>
                                        @elseif($surat->status == 'ditolak')
                                            <span class="badge-status badge-status-danger">
                                                <i class="fas fa-times-circle"></i> Ditolak
                                            </span>
                                        @endif
                                    </td>
                                    <td class="text-center col-aksi">
                                        <div class="action-buttons-group">
                                            <a href="{{ route('admin.pengajuan-surat.show', $surat->id) }}"
                                                class="btn-action-pill btn-action-view"
                                                title="Periksa Permohonan">
                                                <i class="fas fa-eye"></i> <span>Periksa</span>
                                            </a>
                                            @if($surat->status == 'diterima')
                                                <a href="{{ route('surat.download', $surat->id) }}"
                                                    class="btn-action-pill btn-action-pdf"
                                                    title="Unduh PDF Surat">
                                                    <i class="fas fa-file-pdf"></i> <span>PDF</span>
                                                </a>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8">
                                        <div class="admin-table-empty">
                                            <i class="fas fa-folder-open"></i>
                                            <h6>Belum Ada Pengajuan Surat</h6>
                                            <p>Semua permohonan surat dari warga desa akan tercatat di sini.</p>
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