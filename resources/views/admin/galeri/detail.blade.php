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
                        <button type="button" onclick="document.location='{{route('tambahDetailGambar', $id)}}'"
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
            <div class="row">
                <div class="position-relative overflow-hidden">
                    <div class="swiper mySwiper mt-4 mb-2">
                        <div class="swiper-wrapper">
                            @foreach ($Galeri as $g)
                                <div class="swiper-slide">
                                    <div class="ratio ratio-16x9 d-flex align-items-end"> 
                                        <div class="w-100 h-100 position-absolute top-0 start-0"
                                            style="background-image: url('{{ asset('assets/img/galeri/' . $g->gambar) }}');
                                                background-position:center; background-size:cover;">
                                        </div>
                                        <div class="container-fluid position-relative" style="margin-left: 250px">
                                            <div class="row w-100">
                                                <div class="col-sm-3 ms-auto mt-auto">
                                                    <form action="{{ route('hapusDetailGaleri', $id) }}" class="mb-2 me-2">
                                                        @csrf
                                                        <input type="text" name="id" hidden value="{{$g->id}}">
                                                        <button type="submit" class="btn btn-danger btn-sm">
                                                            <i class="bi bi-trash"></i> Hapus
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="swiper-button-prev"></div>
                    <div class="swiper-button-next"></div>
                </div>
            </div>

            <x-app.footer />
        </div>
    </main>

</x-app-layout>
