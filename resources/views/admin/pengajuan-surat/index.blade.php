<x-app-layout>

    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">

        <x-app.navbar />

        <div class="container-fluid py-4 px-5">

            <div class="d-flex justify-content-between align-items-center">
                <h2 class="mb-4">
                    Pengajuan Surat
                </h2>

                <div class="input-group w-sm-25 ms-auto">
                    <span class="input-group-text text-body">
                        <i class="fas fa-search"></i>
                    </span>

                    <input
                        type="text"
                        id="searchInput"
                        class="form-control"
                        placeholder="Cari nama, NIK atau nomor surat...">
                </div>
            </div>

            <hr style="height:2px; color:black;">

            <div class="card border shadow-xs mb-4">

                <div class="card-body px-0 py-0">

                    <div class="border-bottom py-3 px-3">

                        <h5 class="mb-0">
                            Daftar Pengajuan Surat
                        </h5>

                    </div>

                    <div class="table-responsive px-3">

                        <table class="table table-bordered text-center align-middle mt-2">

                            <thead>

                                <tr>

                                    <th class="text-white"
                                        style="background-color:#313d52;">
                                        No
                                    </th>

                                    <th class="text-white"
                                        style="background-color:#313d52;">
                                        No Surat
                                    </th>

                                    <th class="text-white"
                                        style="background-color:#313d52;">
                                        Nama
                                    </th>

                                    <th class="text-white"
                                        style="background-color:#313d52;">
                                        NIK
                                    </th>

                                    <th class="text-white"
                                        style="background-color:#313d52;">
                                        Jenis Surat
                                    </th>

                                    <th class="text-white"
                                        style="background-color:#313d52;">
                                        Tanggal
                                    </th>

                                    <th class="text-white"
                                        style="background-color:#313d52;">
                                        Status
                                    </th>

                                    <th class="text-white"
                                        style="background-color:#313d52;">
                                        Aksi
                                    </th>

                                </tr>

                            </thead>

                            <tbody id="tableBody">

                                @forelse($surats as $surat)

                                <tr>

                                    <td>
                                        {{ $loop->iteration }}
                                    </td>

                                    <td>
                                        {{ $surat->nomor_surat }}
                                    </td>

                                    <td>
                                        {{ $surat->penduduk->nama ?? '-' }}
                                    </td>

                                    <td>
                                        {{ $surat->penduduk->nik ?? '-' }}
                                    </td>

                                    <td>
                                        {{ $surat->keterangan }}
                                    </td>

                                    <td>
                                        {{ \Carbon\Carbon::parse($surat->tanggal_dibuat)->format('d/m/Y') }}
                                    </td>

                                    <td>

                                        @if($surat->status == 'menunggu')
                                            <span class="badge bg-warning">
                                                Menunggu
                                            </span>

                                        @elseif($surat->status == 'diterima')
                                            <span class="badge bg-success">
                                                Diterima
                                            </span>

                                        @elseif($surat->status == 'ditolak')
                                            <span class="badge bg-danger">
                                                Ditolak
                                            </span>
                                        @endif

                                    </td>

                                    <td>

                                        <a
                                            href="{{ route('admin.pengajuan-surat.show',$surat->id) }}"
                                            class="btn btn-info btn-sm">

                                            <i class="fas fa-eye"></i>
                                            Detail

                                        </a>

                                        @if($surat->status == 'diterima')

                                            <a
                                                href="{{ route('surat.download',$surat->id) }}"
                                                class="btn btn-success btn-sm">

                                                <i class="fas fa-download"></i>
                                                PDF

                                            </a>

                                        @endif

                                    </td>

                                </tr>

                                @empty

                                <tr>

                                    <td colspan="8">
                                        Tidak ada data pengajuan surat
                                    </td>

                                </tr>

                                @endforelse

                            </tbody>

                        </table>

                    </div>

                </div>

            </div>

            <x-app.footer />

        </div>

    </main>

    <script>

        document.getElementById('searchInput')
        .addEventListener('keyup', function(){

            let keyword = this.value.toLowerCase();

            let rows =
                document.querySelectorAll('#tableBody tr');

            rows.forEach(row => {

                let text =
                    row.textContent.toLowerCase();

                row.style.display =
                    text.includes(keyword)
                    ? ''
                    : 'none';

            });

        });

    </script>

</x-app-layout>