<x-app-layout>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <div class="top-0 bg-cover z-index-n1 min-height-100 max-height-200 h-25 position-absolute w-100 start-0 end-0"
            style="background-image: url('../../../assets/img/header-blue-purple.jpg'); background-position: bottom;">
        </div>
        <x-app.navbar />
        <div class="px-5 py-4 container-fluid ">
            <form action="{{ route('pemerintah-update', $pemerintahs->id) }}" method="POST">
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
                                <h3>Edit Data Pemerintah</h3>
                            </div>
                            <div class="pt-0 card-body">

                                <div class="row">
                                    <div class="col-6 mb-3">
                                        <label for="nama">Nama</label>
                                        <input type="text" name="nama" id="nama" value="{{ old('nama', $pemerintahs->nama) }}" class="form-control">
                                        @error('nama') <span class="text-danger text-sm">{{ $message }}</span> @enderror
                                    </div>
                                    <div class="col-6 mb-3">
                                        <label for="jabatan">Jabatan</label>
                                        <input type="text" name="jabatan" id="jabatan" value="{{ old('jabatan', $pemerintahs->jabatan) }}" class="form-control">
                                        @error('jabatan') <span class="text-danger text-sm">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="foto" class="form-label">Foto Pemerintah (kosongkan jika tidak ingin mengubah)</label>
                                    <input type="file" name="foto" id="foto" class="form-control">

                                    <div class="mt-2">
                                        <label>Foto saat ini:</label><br>
                                        @if($pemerintahs->foto && file_exists(public_path($pemerintahs->foto)))
                                            <img src="{{ asset($pemerintahs->foto) }}" alt="{{ $pemerintahs->nama }}" width="150" class="img-thumbnail">
                                        @else
                                            <span class="text-muted">Belum ada foto</span>
                                        @endif
                                    </div>
                                </div>


                                <div class="mb-3">
                                    <label for="tupoksi">Tugas Pokok Aksi</label>
                                    <textarea name="tupoksi" id="tupoksi" rows="3" class="form-control">{{ old('tupoksi', $pemerintahs->tupoksi) }}</textarea>
                                    @error('tupoksi') <span class="text-danger text-sm">{{ $message }}</span> @enderror
                                </div>

                                <button type="submit" class="mt-4 btn btn-primary float-end">Update Data</button>
                                <a href="{{ route('pemerintah-index') }}" class="mt-4 btn btn-secondary float-end me-2">Batal</a>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <x-app.footer />
    </main>
</x-app-layout>