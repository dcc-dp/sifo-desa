<x-app-layout>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <div class="top-0 bg-cover z-index-n1 min-height-100 max-height-200 h-25 position-absolute w-100 start-0 end-0"
            style="background-image: url('../../../assets/img/header-blue-purple.jpg'); background-position: bottom;">
        </div>
        <x-app.navbar />
        <div class="container-fluid px-5 py-4">
            <form action="{{ route('pemerintah-update', $pemerintahs->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="row justify-content-center mb-4">
                    <div class="col-lg-9 col-12">
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

                <div class="row justify-content-center mb-5">
                    <div class="col-lg-9 col-12">
                        <div class="card shadow-sm">
                            <div class="card-header bg-gradient-primary text-white">
                                <h5 class="mb-0">Edit Data Pemerintah</h5>
                            </div>
                            <div class="card-body pt-3">
                                <div class="row mb-3">
                                    <div class="col-6">
                                        <label for="nama" class="form-label">Nama</label>
                                        <input type="text" name="nama" id="nama"
                                            class="form-control @error('nama') is-invalid @enderror"
                                            value="{{ old('nama', $pemerintahs->nama) }}" required>
                                        @error('nama')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-6">
                                        <label for="jabatan" class="form-label">Jabatan</label>
                                        <input type="text" name="jabatan" id="jabatan"
                                            class="form-control @error('jabatan') is-invalid @enderror"
                                            value="{{ old('jabatan', $pemerintahs->jabatan) }}" required>
                                        @error('jabatan')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="foto" class="form-label">Foto Pemerintah 
                                        <small class="text-muted">(kosongkan jika tidak ingin mengubah)</small>
                                    </label>
                                    <input type="file" name="foto" id="foto"
                                        class="form-control @error('foto') is-invalid @enderror"
                                        accept="image/*">
                                    @error('foto')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror

                                    @if ($pemerintahs->foto)
                                        <small class="d-block mt-2">Foto saat ini:</small>
                                        <img src="{{ asset('storage/' . $pemerintahs->foto) }}" alt="Foto Pemerintah"
                                            class="img-thumbnail mt-2" width="150">
                                    @endif
                                </div>

                                <div class="mb-3">
                                    <label for="tupoksi" class="form-label">Tugas Pokok Aksi</label>
                                    <input type="text" name="tupoksi" id="tupoksi"
                                        class="form-control @error('tupoksi') is-invalid @enderror"
                                        value="{{ old('tupoksi', $pemerintahs->tupoksi) }}" required>
                                    @error('tupoksi')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <button type="submit" class="btn btn-primary float-end">
                                    Simpan Perubahan
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
