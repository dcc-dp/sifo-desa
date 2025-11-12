<x-app-layout>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <div class="top-0 bg-cover z-index-n1 min-height-100 max-height-200 h-25 position-absolute w-100 start-0 end-0"
            style="background-image: url('../../../assets/img/header-blue-purple.jpg'); background-position: bottom;">
        </div>
        <x-app.navbar />
        <div class="px-5 py-4 container-fluid ">
            <form action="{{ route('pengaduan-update', $pengaduan->id) }}" method="POST">
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
                                <h3>Edit Data pengaduan</h3>
                            </div>
                            <div class="pt-0 card-body">

                                <div class="row">
                                    <label for="status">Status</label>
                                    <select name="status" class="form-control">
                                        <option value="1" {{ $pengaduan->status == '1' ? 'selected' : '' }}>Proses</option>
                                        <option value="2" {{ $pengaduan->status == '2' ? 'selected' : '' }}>Tolak</option>
                                        <option value="3" {{ $pengaduan->status == '3' ? 'selected' : '' }}>Selesai</option>
                                    </select>

                                </div>
                                <button type="submit" class="mt-4 btn btn-primary float-end">Update Data</button>
                                <a href="{{ route('pengaduan-index') }}" class="mt-4 btn btn-secondary float-end me-2">Batal</a>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <x-app.footer />
    </main>
</x-app-layout>