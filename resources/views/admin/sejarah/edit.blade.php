<x-app-layout>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <div class="top-0 bg-cover z-index-n1 min-height-100 max-height-200 h-25 position-absolute w-100 start-0 end-0"
            style="background-image: url('../../../assets/img/header-blue-purple.jpg'); background-position: bottom;">
        </div>

        <x-app.navbar />

        <div class="px-5 py-4 container-fluid ">
            <form action="{{ route('sejarah-update', $data->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="row">
                    <div class="col-12">
                        @if (session('error'))
                            <div class="alert alert-danger" role="alert">
                                {{ session('error') }}
                            </div>
                        @endif
                        @if (session('success'))
                            <div class="alert alert-success" role="alert">
                                {{ session('success') }}
                            </div>
                        @endif
                    </div>
                </div>

                <div class="mb-5 row">
                    <div class="col-12 px-4">
                        <div class="card" id="basic-info">
                            <div class="card-header">
                                <h3>Edit Data Sejarah</h3>
                            </div>

                            <div class="pt-0 card-body">

                                {{-- Judul --}}
                                <div class="col-6 mb-3">
                                    <label for="judul">Judul</label>
                                    <input type="text" name="judul" id="judul"
                                        value="{{ old('judul', $data->judul) }}"
                                        class="form-control @error('judul') is-invalid @enderror">

                                    @error('judul')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{-- Gambar --}}
                                <div class="mb-3">
                                    <label for="gambar" class="form-label">
                                        Gambar (kosongkan jika tidak ingin mengubah)
                                    </label>
                                    <input type="file" name="gambar" id="gambar" class="form-control">

                                    <div class="mt-2">
                                        <label>Gambar saat ini:</label><br>
                                        @if($data->gambar && file_exists(public_path($data->gambar)))
                                            <img src="{{ asset($data->gambar) }}" 
                                                 alt="{{ $data->judul }}" 
                                                 width="150" 
                                                 class="img-thumbnail">
                                        @else
                                            <span class="text-muted">Belum ada gambar</span>
                                        @endif
                                    </div>
                                </div>

                                {{-- Deskripsi --}}
                                <div class="form-group">
                                    <label for="deskripsi">Deskripsi</label>
                                    <textarea name="deskripsi" id="deskripsi" rows="4"
                                        class="form-control @error('deskripsi') is-invalid @enderror">{{ old('deskripsi', $data->deskripsi) }}</textarea>

                                    @error('deskripsi')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <button type="submit" class="mt-4 btn btn-primary float-end">
                                    Update Data
                                </button>

                                <a href="{{ route('sejarah-index') }}" 
                                   class="mt-4 btn btn-secondary float-end me-2">
                                    Batal
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
