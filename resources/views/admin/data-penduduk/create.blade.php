<x-app-layout>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <div class="top-0 bg-cover z-index-n1 min-height-100 max-height-200 h-25 position-absolute w-100 start-0 end-0"
            style="background-image: url('../../../assets/img/header-blue-purple.jpg'); background-position: bottom;">
        </div>
        <x-app.navbar />
        <div class="px-5 py-4 container-fluid ">
            <form action="{{ route('data.penduduk-store') }}" method="POST">
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

                <div class="mb-5 row">
                    <div class="col-12 px-4">
                        <div class="card" id="basic-info">
                            <div class="card-header">
                                <h3>Tambah Data Penduduk</h3>
                            </div>
                            <div class="pt-0 card-body">

                           
                                <div class="row">
                                    <div class="col-6 mb-3">
                                        <label for="nik">NIK</label>
                                        <input type="text" name="nik" id="nik" value="{{ old('nik') }}" class="form-control">
                                        @error('nik') <span class="text-danger text-sm">{{ $message }}</span> @enderror
                                    </div>
                                    <div class="col-6 mb-3">
                                        <label for="nama">Nama</label>
                                        <input type="text" name="nama" id="nama" value="{{ old('nama') }}" class="form-control">
                                        @error('nama') <span class="text-danger text-sm">{{ $message }}</span> @enderror
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-6 mb-3">
                                        <label for="tempat_lahir">Tempat Lahir</label>
                                        <input type="text" name="tempat_lahir" id="tempat_lahir" value="{{ old('tempat_lahir') }}" class="form-control">
                                        @error('tempat_lahir') <span class="text-danger text-sm">{{ $message }}</span> @enderror
                                    </div>
                                    <div class="col-6 mb-3">
                                        <label for="tanggal_lahir">Tanggal Lahir</label>
                                        <input type="date" name="tanggal_lahir" id="tanggal_lahir" value="{{ old('tanggal_lahir') }}" class="form-control">
                                        @error('tanggal_lahir') <span class="text-danger text-sm">{{ $message }}</span> @enderror
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-6 mb-3">
                                        <label for="jenis_kelamin">Jenis Kelamin</label>
                                        <select name="jenis_kelamin" id="jenis_kelamin" class="form-control">
                                            <option value="">-- Pilih --</option>
                                            <option value="L" {{ old('jenis_kelamin') == 'L' ? 'selected' : '' }}>Laki-laki</option>
                                            <option value="P" {{ old('jenis_kelamin') == 'P' ? 'selected' : '' }}>Perempuan</option>
                                        </select>
                                        @error('jenis_kelamin') <span class="text-danger text-sm">{{ $message }}</span> @enderror
                                    </div>
                                    <div class="col-6 mb-3">
                                        <label for="agama">Agama</label>
                                        <input type="text" name="agama" id="agama" value="{{ old('agama') }}" class="form-control">
                                        @error('agama') <span class="text-danger text-sm">{{ $message }}</span> @enderror
                                    </div>
                                </div>

                          
                                <div class="mb-3">
                                    <label for="alamat">Alamat</label>
                                    <textarea name="alamat" id="alamat" rows="3" class="form-control">{{ old('alamat') }}</textarea>
                                    @error('alamat') <span class="text-danger text-sm">{{ $message }}</span> @enderror
                                </div>

                                <div class="row">
                                    <div class="col-6 mb-3">
                                        <label for="rt">RT</label>
                                        <input type="text" name="rt" id="rt" value="{{ old('rt') }}" class="form-control">
                                        @error('rt') <span class="text-danger text-sm">{{ $message }}</span> @enderror
                                    </div>
                                    <div class="col-6 mb-3">
                                        <label for="rw">RW</label>
                                        <input type="text" name="rw" id="rw" value="{{ old('rw') }}" class="form-control">
                                        @error('rw') <span class="text-danger text-sm">{{ $message }}</span> @enderror
                                    </div>
                                </div>

                    
                                <div class="row">
                                    <div class="col-6 mb-3">
                                        <label for="keldesa">Kelurahan / Desa</label>
                                        <input type="text" name="keldesa" id="keldesa" value="{{ old('keldesa') }}" class="form-control">
                                        @error('keldesa') <span class="text-danger text-sm">{{ $message }}</span> @enderror
                                    </div>
                                    <div class="col-6 mb-3">
                                        <label for="kecamatan">Kecamatan</label>
                                        <input type="text" name="kecamatan" id="kecamatan" value="{{ old('kecamatan') }}" class="form-control">
                                        @error('kecamatan') <span class="text-danger text-sm">{{ $message }}</span> @enderror
                                    </div>
                                </div>

                              
                                <div class="row">
                                    <div class="col-6 mb-3">
                                        <label for="status_perkawinan">Status Perkawinan</label>
                                        <input type="text" name="status_perkawinan" id="status_perkawinan" value="{{ old('status_perkawinan') }}" class="form-control">
                                        @error('status_perkawinan') <span class="text-danger text-sm">{{ $message }}</span> @enderror
                                    </div>
                                    <div class="col-6 mb-3">
                                        <label for="pekerjaan">Pekerjaan</label>
                                        <input type="text" name="pekerjaan" id="pekerjaan" value="{{ old('pekerjaan') }}" class="form-control">
                                        @error('pekerjaan') <span class="text-danger text-sm">{{ $message }}</span> @enderror
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="kewarganegaraan">Kewarganegaraan</label>
                                    <input type="text" name="kewarganegaraan" id="kewarganegaraan" value="{{ old('kewarganegaraan') }}" class="form-control">
                                    @error('kewarganegaraan') <span class="text-danger text-sm">{{ $message }}</span> @enderror
                                </div>

                                <button type="submit" class="mt-4 btn btn-primary float-end">Simpan Data</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <x-app.footer />
    </main>
</x-app-layout>
