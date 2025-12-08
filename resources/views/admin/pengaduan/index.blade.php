<x-app-layout>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <x-app.navbar />
        <div class="container-fluid py-4 px-5">
            <div class="row">
                <div class="col-12">
                    <div class="d-flex justify-content-between align-items-center">
                        <h2 class="mb-4">Pengaduan</h2>
                        <div class="input-group w-sm-25 ms-auto">
                            <span class="input-group-text text-body">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16px" height="16px" fill="none"
                                    viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z">
                                    </path>
                                </svg>
                            </span>
                            <input type="text" class="form-control" placeholder="Search">
                        </div>
                    </div>
                    <hr style="height: 2px; color:black;">
                    <div class="card border shadow-xs mb-4">
                        <div class="card-body px-0 py-0 ">
                            <div class="border-bottom py-3 px-3 d-sm-flex align-items-center">
                                <div class="ms-auto d-flex">
                                    <!-- <button type="button"
                                        class="btn btn-sm btn-dark btn-icon d-flex align-items-center me-2">
                                        <span class="btn-inner--icon">
                                            <svg width="16" height="16" xmlns="http://www.w3.org/2000/svg"
                                                viewBox="0 0 24 24" fill="currentColor" class="d-block me-2">
                                                <path
                                                    d="M6.25 6.375a4.125 4.125 0 118.25 0 4.125 4.125 0 01-8.25 0zM3.25 19.125a7.125 7.125 0 0114.25 0v.003l-.001.119a.75.75 0 01-.363.63 13.067 13.067 0 01-6.761 1.873c-2.472 0-4.786-.684-6.76-1.873a.75.75 0 01-.364-.63l-.001-.122zM19.75 7.5a.75.75 0 00-1.5 0v2.25H16a.75.75 0 000 1.5h2.25v2.25a.75.75 0 001.5 0v-2.25H22a.75.75 0 000-1.5h-2.25V7.5z" />
                                            </svg>
                                        </span>
                                        <a href="{{ route('pengaduan-create') }}" class="btn-primary">Tambah pengaduan</a>
                                    </button> -->
                                </div>

                            </div>
                            <div class="table-responsive px-3">
                                <table class="table table-bordered text-center align-middle mt-2">
                                    <thead class="table-light">
                                        <tr>
                                            <th class=" small fw-semibold opacity-75 text-white"
                                                style="background-color: #313d52ff;">No</th>
                                            <th class=" small fw-semibold opacity-75 text-white"
                                                style="background-color: #313d52ff;">Kategori Pengaduan</th>
                                            <th class=" small fw-semibold opacity-75 text-white"
                                                style="background-color: #313d52ff;">Nama</th>
                                            <th class=" small fw-semibold opacity-75 text-white"
                                                style="background-color: #313d52ff;">Judul</th>
                                            <th class=" small fw-semibold opacity-75 text-white"
                                                style="background-color: #313d52ff;">Deskripsi</th>
                                            <th class=" small fw-semibold opacity-75 text-white"
                                                style="background-color: #313d52ff;">Gambar</th>
                                            <th class=" small fw-semibold opacity-75 text-white"
                                                style="background-color: #313d52ff;">File</th>
                                            <th class=" small fw-semibold opacity-75 text-white"
                                                style="background-color: #313d52ff;">Status</th>
                                            <th class=" small fw-semibold opacity-75 text-white"
                                                style="background-color: #313d52ff;">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($pengaduans as $pengaduan)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $pengaduan->kategori->nama_kategori ?? '-' }}</td>
                                                <td>{{ $pengaduan->user->name ?? 'Anonim' }}</td>
                                                <td>{{ $pengaduan->judul }}</td>
                                                <td>{{ Str::limit($pengaduan->deskripsi, 50) }}</td>
                                                <td>
                                                    @if ($pengaduan->gambar && file_exists(public_path($pengaduan->gambar)))
                                                        <img src="{{ asset($pengaduan->gambar) }}" alt="gambar" class="rounded" width="100">
                                                    @else
                                                        <span class="text-muted">Tidak Ada Gambar</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if ($pengaduan->file && file_exists(public_path($pengaduan->file)))
                                                        <a href="{{ asset($pengaduan->file) }}" target="_blank" class="btn btn-sm btn-info">
                                                            Download File
                                                        </a>
                                                    @else
                                                        <span class="text-muted">Tidak Ada File</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    @php
                                                        $statusLabel = match ($pengaduan->status) {
                                                        1 => ['PROSES', 'bg-warning-subtle text-dark'],
                                                        2 => ['TOLAK', 'bg-success-subtle text-dark'],
                                                        3 => ['SELESAI', 'bg-danger-subtle text-dark'],
                                                        default => ['Proses', 'bg-warning-subtle text-dark'],
                                                                                                    };
                                                    @endphp
                                                    <span class="badge {{ $statusLabel[1] }}">
                                                        {{ $statusLabel[0] }}
                                                    </span>
                                                </td>
                                                <td class="align-middle">
                                                    <a href="{{ route('pengaduan-edit', $pengaduan->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>

                                </table>
                            </div>
                            <div class="border-top py-3 px-3 d-flex align-items-center">
                                <p class="font-weight-semibold mb-0 text-dark text-sm">Page 1 of 10</p>
                                <div class="ms-auto">
                                    <button class="btn btn-sm btn-white mb-0">Previous</button>
                                    <button class="btn btn-sm btn-white mb-0">Next</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <x-app.footer />
        </div>
    </main>
</x-app-layout>