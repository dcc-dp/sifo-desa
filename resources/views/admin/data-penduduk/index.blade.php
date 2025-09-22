<x-app-layout>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <x-app.navbar />
        <div class="container-fluid py-4 px-5">
            <div class="row">
                <div class="col-12">
                    <div class="d-flex justify-content-between align-items-center">
                        <h2 class="mb-4">Data Penduduk</h2>
                        <div class="input-group w-sm-25 ms-auto">
                            <span class="input-group-text text-body">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16px" height="16px" fill="none"
                                    viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z">
                                    </path>
                                </svg>
                            </span>
                            <input type="text" id="search" class="form-control"
                                placeholder="Cari nama penduduk...">
                    </div>
                </div>
                <hr style="height: 2px; color:black;">
                <div class="card border shadow-xs mb-4">
                    <div class="card-body px-0 py-0 ">
                        <div class="border-bottom py-3 px-3 d-sm-flex align-items-center">
                            <div class="ms-auto d-flex">
                                <button type="button"
                                    class="btn btn-sm btn-dark btn-icon d-flex align-items-center me-2">
                                    <span class="btn-inner--icon">
                                        <svg width="16" height="16" xmlns="http://www.w3.org/2000/svg"
                                            viewBox="0 0 24 24" fill="currentColor" class="d-block me-2">
                                            <path
                                                d="M6.25 6.375a4.125 4.125 0 118.25 0 4.125 4.125 0 01-8.25 0zM3.25 19.125a7.125 7.125 0 0114.25 0v.003l-.001.119a.75.75 0 01-.363.63 13.067 13.067 0 01-6.761 1.873c-2.472 0-4.786-.684-6.76-1.873a.75.75 0 01-.364-.63l-.001-.122zM19.75 7.5a.75.75 0 00-1.5 0v2.25H16a.75.75 0 000 1.5h2.25v2.25a.75.75 0 001.5 0v-2.25H22a.75.75 0 000-1.5h-2.25V7.5z" />
                                        </svg>
                                    </span>
                                    <a href="{{ route('data.penduduk-create') }}" class="btn-primary">Tambah Data
                                        Penduduk</a>
                                </button>
                            </div>

                        </div>
                        <div class="table-responsive px-3">
                            <table class="table table-bordered text-center align-middle mt-2">
                                <thead class="table-light">
                                    <tr>
                                        <th class=" small fw-semibold opacity-75 text-white"
                                            style="background-color: #313d52ff;">No</th>
                                        <th class=" small fw-semibold opacity-75 text-white"
                                            style="background-color: #313d52ff;">Nik</th>
                                        <th class=" small fw-semibold opacity-75 text-white"
                                            style="background-color: #313d52ff;">Nama</th>
                                        <th class=" small fw-semibold opacity-75 text-white"
                                            style="background-color: #313d52ff;">Tempat Lahir</th>
                                        <th class=" small fw-semibold opacity-75 text-white"
                                            style="background-color: #313d52ff;">Tanggal Lahir</th>
                                        <th class=" small fw-semibold opacity-75 text-white"
                                            style="background-color: #313d52ff;">Alamat</th>
                                        <th class=" small fw-semibold opacity-75 text-white"
                                            style="background-color: #313d52ff;">Pekerjaan</th>
                                        <th class=" small fw-semibold opacity-75 text-white"
                                            style="background-color: #313d52ff;">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody id="penduduk-table">
                                    @foreach ($data as $y)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $y->nik }}</td>
                                            <td>{{ $y->nama }}</td>
                                            <td>{{ $y->tempat_lahir }}</td>
                                            <td>{{ $y->tanggal_lahir }}</td>
                                            <td>{{ $y->alamat }}</td>
                                            <td>{{ $y->pekerjaan }}</td>
                                            <td class="align-middle">
                                                <a href="{{ route('data.penduduk-edit', $y->id) }}"
                                                    class="text-secondary font-weight-bold text-xs"
                                                    data-bs-toggle="tooltip" data-bs-title="Edit user">
                                                    <svg width="14" height="14" viewBox="0 0 15 16"
                                                        fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                            d="M11.2201 2.02495C10.8292 1.63482 10.196 1.63545 9.80585 2.02636C9.41572 2.41727 9.41635 3.05044 9.80726 3.44057L11.2201 2.02495ZM12.5572 6.18502C12.9481 6.57516 13.5813 6.57453 13.9714 6.18362C14.3615 5.79271 14.3609 5.15954 13.97 4.7694L12.5572 6.18502ZM11.6803 1.56839L12.3867 2.2762L12.3867 2.27619L11.6803 1.56839ZM14.4302 4.31284L15.1367 5.02065L15.1367 5.02064L14.4302 4.31284ZM3.72198 15V16C3.98686 16 4.24091 15.8949 4.42839 15.7078L3.72198 15ZM0.999756 15H-0.000244141C-0.000244141 15.5523 0.447471 16 0.999756 16L0.999756 15ZM0.999756 12.2279L0.293346 11.5201C0.105383 11.7077 -0.000244141 11.9624 -0.000244141 12.2279H0.999756ZM9.80726 3.44057L12.5572 6.18502L13.97 4.7694L11.2201 2.02495L9.80726 3.44057ZM12.3867 2.27619C12.7557 1.90794 13.3549 1.90794 13.7238 2.27619L15.1367 0.860593C13.9869 -0.286864 12.1236 -0.286864 10.9739 0.860593L12.3867 2.27619ZM13.7238 2.27619C14.0917 2.64337 14.0917 3.23787 13.7238 3.60504L15.1367 5.02064C16.2875 3.8721 16.2875 2.00913 15.1367 0.860593L13.7238 2.27619ZM13.7238 3.60504L3.01557 14.2922L4.42839 15.7078L15.1367 5.02065L13.7238 3.60504ZM3.72198 14H0.999756V16H3.72198V14ZM1.99976 15V12.2279H-0.000244141V15H1.99976ZM1.70617 12.9357L12.3867 2.2762L10.9739 0.86059L0.293346 11.5201L1.70617 12.9357Z"
                                                            fill="#64748B" />
                                                    </svg>
                                                </a>
                                                <a href="{{ route('data.penduduk-show', $y->id) }}"
                                                    class="text-secondary font-weight-bold text-xs"
                                                    data-bs-toggle="tooltip" data-bs-title="Edit user">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                        height="16" fill="currentColor" class="bi bi-eye"
                                                        viewBox="0 0 16 16">
                                                        <path
                                                            d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8M1.173 8a13 13 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5s3.879 1.168 5.168 2.457A13 13 0 0 1 14.828 8q-.086.13-.195.288c-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5s-3.879-1.168-5.168-2.457A13 13 0 0 1 1.172 8z" />
                                                        <path
                                                            d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5M4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0" />
                                                    </svg>
                                                </a>
                                                <a href="{{ route('data.penduduk-destroy', $y->id) }}"
                                                    class="text-secondary font-weight-bold text-xs"
                                                    data-bs-toggle="tooltip" data-bs-title="Edit user">
                                                    <form action="" method="POST" class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit"
                                                            class="btn btn-link text-danger font-weight-bold text-xs p-0 m-0"
                                                            data-bs-toggle="tooltip" data-bs-title="Hapus"
                                                            onclick="return confirm('Yakin ingin menghapus data ini?')">
                                                            <i class="fas fa-trash-alt"></i>
                                                        </button>
                                                    </form>
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                        height="16" fill="currentColor" class="bi bi-trash3"
                                                        viewBox="0 0 16 16">
                                                        <path
                                                            d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5M11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47M8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5" />
                                                    </svg>
                                                </a>


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

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#search').on('keyup', function() {
                let keyword = $(this).val();

                $.ajax({
                    url: '{{ route('data.penduduk-search') }}',
                    method: 'GET',
                    data: {
                        keyword: keyword
                    },
                    success: function(data) {
                        let rows = '';

                        if (data.length === 0) {
                            rows = '<tr><td colspan="8">Data tidak ditemukan.</td></tr>';
                        } else {
                            data.forEach((item, index) => {
                                rows += generateTableRow(item, index);
                            });
                        }

                        $('#penduduk-table').html(rows);

                        // Re-initialize tooltip after content update
                        const tooltipTriggerList = document.querySelectorAll(
                            '[data-bs-toggle="tooltip"]');
                        [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(
                            tooltipTriggerEl));
                    },
                    error: function(xhr) {
                        console.error("Terjadi kesalahan saat mengambil data:", xhr.statusText);
                        $('#penduduk-table').html(
                            '<tr><td colspan="8">Terjadi kesalahan. Silakan coba lagi.</td></tr>'
                        );
                    }
                });
            });

            // Template builder function
            function generateTableRow(item, index) {
                return `
                <tr>
                    <td>${index + 1}</td>
                    <td>${item.nik}</td>
                    <td>${item.nama}</td>
                    <td>${item.tempat_lahir}</td>
                    <td>${item.tanggal_lahir}</td>
                    <td>${item.alamat}</td>
                    <td>${item.pekerjaan}</td>
                    <td class="align-middle">
                        <a href="/data-penduduk/${item.id}/edit"
                            class="text-secondary font-weight-bold text-xs"
                                                    data-bs-toggle="tooltip" data-bs-title="Edit user">
                                                    <svg width="14" height="14" viewBox="0 0 15 16"
                                                        fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                            d="M11.2201 2.02495C10.8292 1.63482 10.196 1.63545 9.80585 2.02636C9.41572 2.41727 9.41635 3.05044 9.80726 3.44057L11.2201 2.02495ZM12.5572 6.18502C12.9481 6.57516 13.5813 6.57453 13.9714 6.18362C14.3615 5.79271 14.3609 5.15954 13.97 4.7694L12.5572 6.18502ZM11.6803 1.56839L12.3867 2.2762L12.3867 2.27619L11.6803 1.56839ZM14.4302 4.31284L15.1367 5.02065L15.1367 5.02064L14.4302 4.31284ZM3.72198 15V16C3.98686 16 4.24091 15.8949 4.42839 15.7078L3.72198 15ZM0.999756 15H-0.000244141C-0.000244141 15.5523 0.447471 16 0.999756 16L0.999756 15ZM0.999756 12.2279L0.293346 11.5201C0.105383 11.7077 -0.000244141 11.9624 -0.000244141 12.2279H0.999756ZM9.80726 3.44057L12.5572 6.18502L13.97 4.7694L11.2201 2.02495L9.80726 3.44057ZM12.3867 2.27619C12.7557 1.90794 13.3549 1.90794 13.7238 2.27619L15.1367 0.860593C13.9869 -0.286864 12.1236 -0.286864 10.9739 0.860593L12.3867 2.27619ZM13.7238 2.27619C14.0917 2.64337 14.0917 3.23787 13.7238 3.60504L15.1367 5.02064C16.2875 3.8721 16.2875 2.00913 15.1367 0.860593L13.7238 2.27619ZM13.7238 3.60504L3.01557 14.2922L4.42839 15.7078L15.1367 5.02065L13.7238 3.60504ZM3.72198 14H0.999756V16H3.72198V14ZM1.99976 15V12.2279H-0.000244141V15H1.99976ZM1.70617 12.9357L12.3867 2.2762L10.9739 0.86059L0.293346 11.5201L1.70617 12.9357Z"
                                                            fill="#64748B" />
                                                    </svg>
                                                </a>

                        <a href="/data-penduduk/${item.id}"
                           class="text-secondary font-weight-bold text-xs"
                                                    data-bs-toggle="tooltip" data-bs-title="Edit user">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                        height="16" fill="currentColor" class="bi bi-eye"
                                                        viewBox="0 0 16 16">
                                                        <path
                                                            d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8M1.173 8a13 13 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5s3.879 1.168 5.168 2.457A13 13 0 0 1 14.828 8q-.086.13-.195.288c-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5s-3.879-1.168-5.168-2.457A13 13 0 0 1 1.172 8z" />
                                                        <path
                                                            d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5M4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0" />
                                                    </svg>
                                                </a>

                        <form action="/data-penduduk/${item.id}" method="POST" class="d-inline">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="hidden" name="_method" value="DELETE">
                            <button type="submit"
                                                            class="btn btn-link text-danger font-weight-bold text-xs p-0 m-0"
                                                            data-bs-toggle="tooltip" data-bs-title="Hapus"
                                                            onclick="return confirm('Yakin ingin menghapus data ini?')">
                                                            <i class="fas fa-trash-alt"></i>
                                                        </button>
                                                    </form>
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                        height="16" fill="currentColor" class="bi bi-trash3"
                                                        viewBox="0 0 16 16">
                                                        <path
                                                            d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5M11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47M8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5" />
                                                    </svg>
                            </button>
                        </form>
                    </td>
                </tr>
            `;
            }
        });
    </script>


</x-app-layout>