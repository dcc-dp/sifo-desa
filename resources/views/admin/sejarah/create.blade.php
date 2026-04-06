<x-app-layout>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
        <x-app.navbar />
        <div class="px-5 py-4 container-fluid">
            <form action="{{ route('sejarah-store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="card">
                    <div class="card-header">
                        <h3>Tambah Data Sejarah</h3>
                    </div>
                    <div class="card-body">

                        <div class="mb-3">
                            <label>Judul Sejarah</label>
                            <input type="text" name="judul" value="{{ old('judul') }}" class="form-control">
                            @error('judul')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label>Gambar</label>
                            <input type="file" name="gambar" class="form-control">
                        </div>

                        <div class="mb-3">
                            <label>Deskripsi</label>
                            <textarea name="deskripsi" rows="5" class="form-control">{{ old('deskripsi') }}</textarea>
                        </div>

                        <button type="submit" class="btn btn-primary float-end">Simpan</button>

                    </div>
                </div>
            </form>
        </div>
        <x-app.footer />
    </main>
</x-app-layout>