<x-app-layout>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <x-app.navbar />
        <div class="container-fluid py-4 px-5">
            <div class="row">
                <div class="col-12">
                    <div class="d-flex justify-content-between align-items-center">
                        <h2 class="mb-4">Surat Domisili</h2>
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
                                            <th>Status</th>
                                            <th>Keterangan</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody id="surat-table">
                                        @foreach ($data as $surat)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $surat->surat->nomor_surat ?? '-' }}</td>
                                                <td>{{ $surat->surat->penduduk->nama ?? '-' }}</td>
                                                <td>{{ $surat->surat->tanggal_dibuat ?? '-' }}</td>
                                                <td>
                                                    @php
                                                        $badgeClass = match ($surat->surat->status ?? '') {
                                                            'diterima' => 'bg-success',
                                                            'tolak' => 'bg-danger',
                                                            'proses' => 'bg-warning',
                                                            default => 'bg-secondary',
                                                        };
                                                    @endphp
                                                    <span class="badge {{ $badgeClass }}">
                                                        {{ ucfirst($surat->surat->status ?? '-') }}
                                                    </span>
                                                </td>
                                                <td>{{ $surat->surat->keterangan ?? '-' }}</td>
                                                <td>
                                                    <a href="{{ route('surat.edit', $surat->surat->id ?? '#') }}" class="text-secondary me-2" title="Ubah Status">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    <a href="{{ route('surat.show', $surat->surat->id ?? '#') }}" class="text-secondary me-2" title="Lihat Surat">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                    <form action="{{ route('surat.destroy', $surat->surat->id ?? 0) }}" method="POST" class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-link text-danger p-0 m-0"
                                                            onclick="return confirm('Yakin ingin menghapus surat ini?')">
                                                            <i class="fas fa-trash-alt"></i>
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
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

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#search').on('keyup', function() {
                let keyword = $(this).val();
                $.ajax({
                    url: '{{ route('surat.search') }}',
                    method: 'GET',
                    data: { keyword: keyword },
                    success: function(data) {
                        let rows = '';
                        if (data.length === 0) {
                            rows = `<tr><td colspan="7">Data tidak ditemukan.</td></tr>`;
                        } else {
                            data.forEach((item, index) => {
                                rows += `
                                    <tr>
                                        <td>${index + 1}</td>
                                        <td>${item.nomor_surat}</td>
                                        <td>${item.penduduk?.nama ?? '-'}</td>
                                        <td>${item.tanggal_dibuat ?? '-'}</td>
                                        <td><span class="badge ${getBadge(item.status)}">${capitalize(item.status)}</span></td>
                                        <td>${item.keterangan ?? '-'}</td>
                                        <td>
                                            <a href="/surat/${item.id}/edit" class="text-secondary me-2"><i class="fas fa-edit"></i></a>
                                            <a href="/surat/${item.id}" class="text-secondary me-2"><i class="fas fa-eye"></i></a>
                                            <form action="/surat/${item.id}" method="POST" class="d-inline">
                                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                <input type="hidden" name="_method" value="DELETE">
                                                <button type="submit" class="btn btn-link text-danger p-0 m-0"
                                                    onclick="return confirm('Yakin ingin menghapus data ini?')">
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>`;
                            });
                        }
                        $('#surat-table').html(rows);
                    },
                    error: function() {
                        $('#surat-table').html('<tr><td colspan="7">Terjadi kesalahan, coba lagi.</td></tr>');
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
