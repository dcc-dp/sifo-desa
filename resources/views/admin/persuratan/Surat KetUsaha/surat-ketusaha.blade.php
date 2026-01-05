<x-app-layout>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <x-app.navbar />

        <div class="container-fluid py-4 px-5">
            <div class="row">
                <div class="col-12">

                    <div class="d-flex justify-content-between align-items-center">
                        <h2 class="mb-4">Surat Keterangan Usaha</h2>
                        <div class="input-group w-sm-25 ms-auto">
                            <span class="input-group-text text-body">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none"
                                    viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
                                </svg>
                            </span>
                            <input type="text" id="search" class="form-control" placeholder="Cari nama / NIK...">
                        </div>
                    </div>

                    <hr class="my-3">

                    <div class="card border shadow-xs mb-4">
                        <div class="card-body px-0 py-0">
                            <div class="table-responsive px-3">
                                <table class="table table-bordered text-center align-middle mt-2">
                                    <thead class="table-light">
                                        <tr>
                                            <th>No</th>
                                            <th>Nomor Surat</th>
                                            <th>Nama Penduduk</th>
                                            <th>Tanggal Dibuat</th>
                                            <th>Nama Usaha</th>
                                            <th>Alamat Usaha</th>
                                            <th>Status</th>
                                            <th>Keterangan</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody id="surat-table">
                                        @forelse ($data as $surat)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $surat->nomor_surat ?? '-' }}</td>
                                                <td>{{ $surat->penduduk->nama ?? '-' }}</td>
                                                <td>{{ $surat->tanggal_dibuat ?? '-' }}</td>
                                                <td>{{ $surat->nama_usaha ?? '-' }}</td>
                                                <td>{{ $surat->alamat_usaha ?? '-' }}</td>
                                                <td>
                                                    @php
                                                        $badgeClass = match ($surat->status) {
                                                            'diterima' => 'bg-success',
                                                            'tolak' => 'bg-danger',
                                                            'proses' => 'bg-warning',
                                                            default => 'bg-secondary',
                                                        };
                                                    @endphp
                                                    <span class="badge {{ $badgeClass }}">
                                                        {{ ucfirst($surat->status ?? '-') }}
                                                    </span>
                                                </td>
                                                <td>{{ $surat->keterangan ?? '-' }}</td>
                                                <td>
                                                    <a href="{{ route('suratketus.edit', $surat->id) }}"
                                                        class="text-secondary me-2" title="Ubah Data">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    <a href="{{ route('suratketus.show', $surat->id) }}"
                                                        class="text-secondary me-2" title="Lihat Detail">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                    <form action="{{ route('suratketus.destroy', $surat->id) }}"
                                                        method="POST" class="d-inline"
                                                        onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit"
                                                            class="btn btn-link text-danger p-0 m-0"><i
                                                                class="fas fa-trash-alt"></i></button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="9">Tidak ada data surat keterangan usaha.</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>

                            <div class="border-top py-3 px-3">
                                {{ $data->links() }}
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <x-app.footer />
    </main>

    {{-- AJAX Search --}}
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#search').on('keyup', function() {
                let keyword = $(this).val();
                $.ajax({
                    url: '{{ route('suratketus.search') }}',
                    method: 'GET',
                    data: { keyword: keyword },
                    success: function(response) {
                        let rows = '';
                        if (response.length > 0) {
                            response.forEach((item, index) => {
                                rows += `
                                    <tr>
                                        <td>${index + 1}</td>
                                        <td>${item.nomor_surat ?? '-'}</td>
                                        <td>${item.penduduk?.nama ?? '-'}</td>
                                        <td>${item.tanggal_dibuat ?? '-'}</td>
                                        <td>${item.nama_usaha ?? '-'}</td>
                                        <td>${item.alamat_usaha ?? '-'}</td>
                                        <td><span class="badge ${getBadge(item.status)}">${capitalize(item.status)}</span></td>
                                        <td>${item.keterangan ?? '-'}</td>
                                        <td>
                                            <a href="/admin/suratketus/${item.id}/edit" class="text-secondary me-2"><i class="fas fa-edit"></i></a>
                                            <a href="/admin/suratketus/${item.id}" class="text-secondary me-2"><i class="fas fa-eye"></i></a>
                                            <form action="/admin/suratketus/${item.id}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                                <input type="hidden" name="_method" value="DELETE">
                                                <button type="submit" class="btn btn-link text-danger p-0 m-0"><i class="fas fa-trash-alt"></i></button>
                                            </form>
                                        </td>
                                    </tr>`;
                            });
                        } else {
                            rows = `<tr><td colspan="9">Data tidak ditemukan.</td></tr>`;
                        }
                        $('#surat-table').html(rows);
                    },
                    error: function() {
                        $('#surat-table').html('<tr><td colspan="9">Terjadi kesalahan, coba lagi.</td></tr>');
                    }
                });
            });

            function getBadge(status) {
                switch (status) {
                    case 'diterima': return 'bg-success';
                    case 'tolak': return 'bg-danger';
                    case 'proses': return 'bg-warning';
                    default: return 'bg-secondary';
                }
            }

            function capitalize(word) {
                return word ? word.charAt(0).toUpperCase() + word.slice(1) : '-';
            }
        });
    </script>
</x-app-layout>
