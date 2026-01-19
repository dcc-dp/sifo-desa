<x-app-layout>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
        <div class="top-0 bg-cover z-index-n1 min-height-100 max-height-200 h-25 position-absolute w-100 start-0 end-0"
            style="background-image: url('../../../assets/img/header-blue-purple.jpg'); background-position: bottom;">
        </div>
        <x-app.navbar />
        <div class="px-5 py-4 container-fluid">
            <form action="{{ route('rt-store') }}" method="POST">
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
                                <h3>Tambah Data RT</h3>
                            </div>
                            <div class="pt-0 card-body">

                                <div class="mb-3">
                                    <label for="rw_id">RW</label>
                                    <select name="rw_id" id="rw_id" class="form-control">
                                        <option value="">-- Pilih RW --</option>
                                        @foreach ($rw_list as $rw)
                                            <option value="{{ $rw->id }}" 
                                                {{ old('rw_id') == $rw->id ? 'selected' : '' }}>
                                                RW {{ $rw->nomor_rw }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('rw_id') 
                                        <span class="text-danger text-sm">{{ $message }}</span> 
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="nomor_rt">Nomor RT</label>
                                    <input type="text" name="nomor_rt" id="nomor_rt" 
                                           value="{{ old('nomor_rt') }}" 
                                           class="form-control" 
                                           placeholder="masukkan rt">
                                    @error('nomor_rt') 
                                        <span class="text-danger text-sm">{{ $message }}</span> 
                                    @enderror
                                </div>

                                <div class="d-flex justify-content-between">
                                    <a href="{{ route('rt-index') }}" class="btn btn-secondary">Kembali</a>
                                    <button type="submit" class="btn btn-primary">Simpan Data</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <x-app.footer />
    </main>
</x-app-layout>