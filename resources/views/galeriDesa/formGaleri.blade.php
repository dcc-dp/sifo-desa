<x-app-layout>

    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <x-app.navbar />
        <div class="container-fluid py-4 px-5">
            <form action={{ route('users.update') }} method="POST">
                @csrf
                @method('PUT')
                <div class="mb-5 row justify-content-center">
                    <div class="col-lg-9 col-12 ">
                        <div class="card " id="basic-info">
                            <div class="card-header">
                                <h5>Galeri Desa</h5>
                            </div>
                            <div class="pt-0 card-body">
                                <div class="row p-2">
                                    <label for="about">Tambah Gambar</label>
                                    <input type="file" name="tambah" id="tambah" placeholder=""
                                            value="{{ old('phone', auth()->user()->phone) }}" class="form-control">
                                    @error('about')
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
