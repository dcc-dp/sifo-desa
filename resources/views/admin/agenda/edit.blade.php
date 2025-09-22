<x-app-layout>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <div class="top-0 bg-cover z-index-n1 min-height-100 max-height-200 h-25 position-absolute w-100 start-0 end-0"
            style="background-image: url('../../../assets/img/header-blue-purple.jpg'); background-position: bottom;">
        </div>
        <x-app.navbar />
        <div class="px-5 py-4 container-fluid ">
            <form action="{{ route('agenda-update', $agendas->id) }}" method="POST">
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
                                <h3>Edit Data Agenda</h3>
                            </div>
                            <div class="pt-0 card-body">

                                <div class="row">
                                    <div class="col-6 mb-3">
                                        <label for="nama_kegiatan">Nama Kegiatan</label>
                                        <input type="text" name="nama_kegiatan" id="nama_kegiatan"
                                            value="{{ old('nama_kegiatan', $agendas->nama_kegiatan) }}"
                                            class="form-control">
                                        @error('nama_kegiatan')
                                            <span class="text-danger text-sm">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="col-6 mb-3">
                                        <label for="waktu_pelaksanaan">Waktu Kegiatan</label>
                                        <input type="datetime-local" name="waktu_pelaksanaan" id="waktu_pelaksanaan"
                                            value="{{ old('waktu_pelaksanaan', \Carbon\Carbon::parse($agendas->waktu_pelaksanaan)->format('Y-m-d\TH:i')) }}"
                                            class="form-control">
                                        @error('waktu_pelaksanaan')
                                            <span class="text-danger text-sm">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <button type="submit" class="mt-4 btn btn-primary float-end">Update Data</button>
                                <a href="{{ route('agenda-index') }}" class="mt-4 btn btn-secondary float-end me-2">Batal</a>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <x-app.footer />
    </main>
</x-app-layout>