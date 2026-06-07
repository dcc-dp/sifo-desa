<x-app-layout>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
        <x-app.navbar />

        <div class="container-fluid py-4 px-5">

            <form action="{{ route('admin.user-update',$user->id) }}"
                method="POST">

                @csrf
                @method('PUT')

                <div class="card">
                    <div class="card-header">
                        <h3>Edit Admin</h3>
                    </div>

                    <div class="card-body">

                        <div class="mb-3">
                            <label>NIK</label>
                            <input type="text"
                                name="nik_id"
                                class="form-control"
                                value="{{ old('nik_id',$user->nik_id) }}">
                        </div>

                        <div class="mb-3">
                            <label>Nama</label>
                            <input type="text"
                                name="name"
                                class="form-control"
                                value="{{ old('name',$user->name) }}">
                        </div>

                        <div class="mb-3">
                            <label>Email</label>
                            <input type="email"
                                name="email"
                                class="form-control"
                                value="{{ old('email',$user->email) }}">
                        </div>

                        <div class="mb-3">
                            <label>Password Baru</label>
                            <input type="password"
                                name="password"
                                class="form-control">

                            <small class="text-muted">
                                Kosongkan jika tidak ingin mengganti password
                            </small>
                        </div>

                        <button type="submit" class="btn btn-primary">
                            Update
                        </button>

                        <a href="{{ route('admin.user-index') }}"
                            class="btn btn-secondary">
                            Kembali
                        </a>

                    </div>
                </div>

            </form>

        </div>

        <x-app.footer />
    </main>
</x-app-layout>