<x-app-layout>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
        <x-app.navbar />

        <div class="container-fluid py-4 px-5">
            <div class="row">
                <div class="col-12">

                    <div class="d-flex justify-content-between align-items-center">
                        <h2 class="mb-4">Data Admin</h2>

                        <a href="{{ route('admin.user-create') }}" class="btn btn-primary">
                            Tambah User
                        </a>
                    </div>

                    <hr>

                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="card border shadow-xs">
                        <div class="card-body">

                            <div class="table-responsive">
                                <table class="table table-bordered text-center">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>NIK</th>
                                            <th>Nama</th>
                                            <th>Email</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @forelse($users as $user)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $user->nik_id }}</td>
                                                <td>{{ $user->name }}</td>
                                                <td>{{ $user->email }}</td>

                                                <td>
                                                    <a href="{{ route('admin.user-edit',$user->id) }}"
                                                        class="btn btn-warning btn-sm">
                                                        Edit
                                                    </a>

                                                    <a href="{{ route('admin.user-destroy',$user->id) }}"
                                                        class="btn btn-danger btn-sm"
                                                        onclick="return confirm('Yakin hapus user?')">
                                                        Hapus
                                                    </a>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="5">
                                                    Data User Belum Ada
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>

                                </table>
                            </div>

                        </div>
                    </div>

                </div>
            </div>

            <x-app.footer />
        </div>
    </main>
</x-app-layout>