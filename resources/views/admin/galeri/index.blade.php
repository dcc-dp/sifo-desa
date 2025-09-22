<x-app-layout>

    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <x-app.navbar />
        <div class="container-fluid py-4 px-5">
            <div class="row">
                <div class="col-md-12">
                    <div class="d-md-flex align-items-center mb-3 mx-2">
                        <div class="mb-md-0 mb-3">
                            <h3 class="font-weight-bold mb-0">Galeri Desa</h3>
                            <p class="mb-0">Galeri untuk mengupdate foto-foto di desa!!!</p>
                        </div>
                        <button type="button" onclick="document.location='{{route('tambahGaleri')}}'"
                            class="btn btn-sm btn-white btn-icon d-flex align-items-center mb-0 ms-md-auto mb-sm-0 mb-2 me-2">
                            <span class="btn-inner--icon">
                                <span class="p-1 bg-success rounded-circle d-flex ms-auto me-2">
                                    <span class="visually-hidden">New</span>
                                </span>
                            </span>
                            <span class="btn-inner--text">Tambah</span>
                        </button>
                       
                    </div>
                </div>
            </div>
            <hr class="my-0">
                <div class="row row-cols-1 row-cols-md-3 g-3"> <!-- otomatis 3 kolom -->
                    @foreach ($BatchGaleri as $batch)
                    <a href="{{route('detailGaleri',$batch->id)}}">
                        <div class="col">
                             @php
                                $lastImage = $batch->galeris()->latest()->first();
                            @endphp
                            <div class="card h-100"> <!-- h-100 biar semua card sama tinggi -->
                                @if ($lastImage)
                                    <img src="{{ asset('assets/img/galeri/' . $lastImage->gambar) }}" 
                                        class="card-img-top" alt="gambar">
                                @else
                                    <img src="{{ asset('assets/img/galeri/no-image.jpg') }}" 
                                        class="card-img-top" alt="gambar default">
                                @endif
                                <div class="card-body d-flex justify-content-between align-items-center">
                                    <h5 class="card-title mb-0">{{ $batch->nama }}</h5>

                                    <form action="{{ route('hapusGaleri') }}" class="mb-0">
                                        @csrf
                                        <input type="text" name="id" hidden value="{{$batch->id}}">
                                        <button type="submit" class="btn btn-danger btn-sm">
                                            <i class="bi bi-trash"></i> Hapus
                                        </button>
                                    </form>
                                </div>

                            </div>
                        </div>
                        
                    </a>
                    @endforeach
                </div>
            </div>
            <x-app.footer />
        </div>
    </main>

</x-app-layout>
