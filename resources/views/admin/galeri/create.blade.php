<x-app-layout>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <div class="top-0 bg-cover z-index-n1 min-height-100 max-height-200 h-25 position-absolute w-100 start-0 end-0"
            style="background-image: url('../../../assets/img/header-blue-purple.jpg'); background-position: bottom;">
        </div>

        <x-app.navbar />

        <div class="px-5 py-4 container-fluid">

            <form action="{{ route('galeri.store', $batch->id) }}"
                  method="POST"
                  enctype="multipart/form-data">
                @csrf

                <div class="row">
                    <div class="col-12">
                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif
                    </div>
                </div>

                <div class="mb-5 row">
                    <div class="col-12 px-4">
                        <div class="card" id="basic-info">
                            <div class="card-header">
                                <h3>Tambah Gambar</h3>
                            </div>

                            <div class="pt-0 card-body">

                                <div class="mb-3">
                                    <label for="judul">Judul Gambar</label>
                                    <input type="text"
                                           name="judul"
                                           id="judul"
                                           class="form-control"
                                           value="{{ old('judul') }}">
                                    @error('judul')
                                        <span class="text-danger text-sm">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="gambar">Upload Gambar</label>
                                    <input type="file"
                                           name="gambar"
                                           id="gambar"
                                           class="form-control">
                                    @error('gambar')
                                        <span class="text-danger text-sm">{{ $message }}</span>
                                    @enderror
                                </div>

                                <button type="submit"
                                        class="mt-4 btn btn-primary float-end">
                                    Simpan Gambar
                                </button>

                                <a href="{{ route('batchgaleri.show', $batch->id) }}"
                                   class="mt-4 btn btn-secondary float-end me-2">
                                    Kembali
                                </a>

                            </div>
                        </div>
                    </div>
                </div>

            </form>
        </div>

        <x-app.footer />
    </main>
</x-app-layout>
