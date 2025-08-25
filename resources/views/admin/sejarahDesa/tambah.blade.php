<x-app-layout>

    <main class="main-content max-height-vh-100 h-100">
        <div class="pt-5 pb-6 bg-cover" style="background-image: url('../assets/img/header-blue-purple.jpg')"></div>
        <div class="container my-3 py-3">
            <div class="row mt-n6 mb-6">
                <div class="col">
                           <div class="px-5 container-fluid ">
                            <form action={{ route('users.update') }} method="POST">
                                @csrf
                                @method('PUT')
                                <div class="mb-5 row justify-content-center">
                                    <div class="col-lg-9 col-12 ">
                                        <div class="card " id="basic-info">
                                            <div class="card-header">
                                                <h5>Tambah Sejarah Desa</h5>
                                            </div>
                                            <div class="pt-0 card-body">

                                                <div class="row">
                                                    <div class="col-6">
                                                        <label for="name">Judul</label>
                                                        <input type="text" name="name" id="name"
                                                            value="{{ old('name', auth()->user()->name) }}" class="form-control">
                                                        @error('name')
                                                            <span class="text-danger text-sm">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="row p-2">
                                                    <label for="about">Isi</label>
                                                    <textarea name="about" id="about" rows="5" class="form-control">{{ old('about', auth()->user()->about) }}</textarea>
                                                    @error('about')
                                                        <span class="text-danger text-sm">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <button type="submit" class="mt-6 mb-0 btn btn-white btn-sm float-end">Submit</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                </div>
                
            </div>
            <hr class="horizontal mb-4 dark">
            <x-app.footer />
        </div>
    </main>

</x-app-layout>
