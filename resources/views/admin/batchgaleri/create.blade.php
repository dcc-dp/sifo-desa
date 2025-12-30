<x-app-layout>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">

        <div class="top-0 bg-cover z-index-n1 min-height-100 max-height-200 h-25 position-absolute w-100 start-0 end-0"
            style="background-image: url('../../../assets/img/header-blue-purple.jpg'); background-position: bottom;">
        </div>
        <x-app.navbar />

        <div class="container-fluid px-5 py-4">

            <form action="{{ route('batchgaleri.store') }}" method="POST">
                @csrf

                <div class="row">
                    <div class="col-12">

                        @if (session('error'))
                            <div class="alert alert-danger" role="alert" id="alert">
                                {{ session('error') }}
                            </div>
                        @endif

                        @if (session('success'))
                            <div class="alert alert-success" role="alert" id="alert">
                                {{ session('success') }}
                            </div>
                        @endif

                    </div>
                </div>

                <div class="row mb-5">
                    <div class="col-12 px-4">

                        <div class="card">
                            <div class="card-header">
                                <h3>Tambah Batch Galeri</h3>
                            </div>

                            <div class="card-body pt-0">
                                <div class="mb-3">
                                    <label for="nama">Nama Batch</label>
                                    <input type="text" name="nama" id="nama"
                                        class="form-control"
                                        value="{{ old('nama') }}"
                                        placeholder="Masukkan nama folder">

                                    @error('nama')
                                        <span class="text-danger text-sm">{{ $message }}</span>
                                    @enderror
                                </div>

                                <button type="submit" class="btn btn-primary mt-4 float-end">
                                    Simpan Batch
                                </button>

                            </div>
                        </div>

                    </div>
                </div>

            </form>

        </div>

        <x-app.footer />
    </main>
</x-app-layout>
