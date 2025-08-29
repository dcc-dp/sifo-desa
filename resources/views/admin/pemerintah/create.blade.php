<x-app-layout>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <div class="top-0 bg-cover z-index-n1 min-height-100 max-height-200 h-25 position-absolute w-100 start-0 end-0"
            style="background-image: url('../../../assets/img/header-blue-purple.jpg'); background-position: bottom;">
        </div>
        <x-app.navbar />
            <div class="px-5 py-4 container-fluid ">
                <form action="{{ route('pemerintah-store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mt-5 mb-5 mt-lg-9 row justify-content-center">
                        <div class="col-lg-9 col-12">
                            <div>
                                
                            </div>
                        </div>
                    </div>
                    <div class="row justify-content-center">
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
                    <div class="mb-5 row justify-content-center">
                        <div class="col-lg-9 col-12 ">
                            <div class="card " id="basic-info">
                                <div class="card-header">
                                    <h5>Tambah Data Pemerintah</h5>
                                </div>
                                <div class="pt-0 card-body">

                                    <div class="row">
                                        <div class="col-6">
                                            <label for="nama">Nama</label>
                                            <input type="text" name="nama" id="nama"
                                                value="{{ old('nama', auth()->user()->nama) }}" class="form-control">
                                            @error('nama')
                                                <span class="text-danger text-sm">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="col-6">
                                            <label for="jabatan">Jabatan</label>
                                            <input type="text" name="jabatan" id="jabatan"
                                                value="{{ old('jabatan', auth()->user()->jabatan) }}" class="form-control">
                                            @error('jabatan')
                                                <span class="text-danger text-sm">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="foto">Foto Pemerintah</label>
                                        <input type="file" class="form-control @error('foto') is-invalid @enderror"
                                            id="foto" name="foto" accept="image/*">
                                        @error('foto')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="row p-2">
                                        <label for="tupoksi">Tupoksi</label>
                                        <textarea name="tupoksi" id="tupoksi" rows="5" class="form-control">{{ old('tupoksi', auth()->user()->tupoksi) }}</textarea>
                                        @error('tupoksi')
                                            <span class="text-danger text-sm">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <button type="submit" class="mt-6 mb-0 btn btn-white btn-sm float-end">Save
                                        changes</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        <x-app.footer />
    </main>
</x-app-layout>
