<x-app-layout>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <div class="top-0 bg-cover z-index-n1 min-height-100 max-height-200 h-25 position-absolute w-100 start-0 end-0"
            style="background-image: url('../../../assets/img/header-blue-purple.jpg'); background-position: bottom;">
        </div>
        <x-app.navbar />
        <div class="px-5 py-4 container-fluid ">
            <form action="{{ route('berita-update', $beritas->id) }}" method="POST">
                @csrf
                @method('PUT')
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

                <div class="mb-5 row">
                    <div class="col-12 px-4">
                        <div class="card" id="basic-info">
                            <div class="card-header">
                                <h3>Edit Data Berita</h3>
                            </div>
                            <div class="pt-0 card-body">
                
                                <div class="row">
                                    <div class="form-group">
                                        <label for="id_kategori">Kategori</label>
                                        <select class="form-control @error('id_kategori') is-invalid @enderror" id="id_kategori"
                                            name="id_kategori" required>
                                            <option value="">-- Pilih Kategori --</option>
                                            @foreach($kategoris as $kategori)
                                                <option value="{{ $kategori->id }}" {{ old('id_kategori', $beritas->id_kategori) == $kategori->id ? 'selected' : '' }}>
                                                    {{ $kategori->nama_kategori }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('id_kategori')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>


                                    <div class="col-6 mb-3">
                                        <label for="judul">Judul Berita</label>
                                        <input type="text" name="judul" id="judul"
                                            value="{{ old('judul', $beritas->judul) }}"
                                            class="form-control">
                                        @error('judul')
                                            <span class="text-danger text-sm">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="gambar" class="form-label">Gambar berita (kosongkan jika tidak ingin mengubah)</label>
                                    <input type="file" name="gambar" id="gambar" class="form-control">

                                    <div class="mt-2">
                                        <label>gambar saat ini:</label><br>
                                        @if($beritas->gambar && file_exists(public_path($beritas->gambar)))
                                            <img src="{{ asset($beritas->gambar) }}" alt="{{ $beritas->nama }}" width="150" class="img-thumbnail">
                                        @else
                                            <span class="text-muted">Belum ada gambar</span>
                                        @endif
                                    </div>
                                </div>


                                <div class="form-group">
                                    <label for="deskripsi">deskripsi</label>
                                    <textarea name="deskripsi" id="deskripsi" rows="3"
                                        class="form-control @error('deskripsi') is-invalid @enderror">{{ old('deskripsi', $beritas->deskripsi) }}</textarea>
                                    @error('deskripsi')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>


                                <button type="submit" class="mt-4 btn btn-primary float-end">Update Data</button>
                                <a href="{{ route('berita-index') }}" class="mt-4 btn btn-secondary float-end me-2">Batal</a>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <x-app.footer />
    </main>
</x-app-layout>