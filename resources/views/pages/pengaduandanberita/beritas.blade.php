@extends('layouts.user')

@section('title', 'Kategori Berita | Sistem Informasi Desa')

@section('content')

    <section>
        <div class="container">
            <div class="section-header">
                <h2 class="section-title"><i class="fas fa-landmark"></i> Sejarah Desa</h2> 
        </div>
        <div class="row">
            <div class="position-relative">

                <div class="swiper mySwiper mt-4 mb-2">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide">
                            <div>
                                <div
                                    class="card card-background shadow-none border-radius-xl card-background-after-none align-items-start mb-0">
                                    <div class="full-background bg-cover"
                                        style="background-image: url('../assets/img/img-2.jpg')"></div>
                                    <div class="card-body text-start px-3 py-0 w-100">
                                        <div class="row mt-12">
                                            <div class="col-sm-3 mt-auto" >
                                                <a href="{{ route('berita') }}"><h2 class="text-dark font-weight-bolder">#Pendidikan</h2></a>
                                                <a href="{{ route('berita') }}"><h4 class="text-dark font-weight-bolder">3 Berita</h4></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div>
                                <div
                                    class="card card-background shadow-none border-radius-xl card-background-after-none align-items-start mb-0">
                                    <div class="full-background bg-cover"
                                        style="background-image: url('../assets/img/img-2.jpg')"></div>
                                    <div class="card-body text-start px-3 py-0 w-100">
                                        <div class="row mt-12">
                                            <div class="col-sm-3 mt-auto">
                                                <a href="{{ route('berita') }}"><h2 class="text-dark font-weight-bolder">#Kesehatan</h2></a>
                                                <a href="{{ route('berita') }}"><h4 class="text-dark font-weight-bolder">3 Berita</h4></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div>
                                <div
                                    class="card card-background shadow-none border-radius-xl card-background-after-none align-items-start mb-0">
                                    <div class="full-background bg-cover"
                                        style="background-image: url('../assets/img/img-2.jpg')"></div>
                                    <div class="card-body text-start px-3 py-0 w-100">
                                        <div class="row mt-12">
                                            <div class="col-sm-3 mt-auto">
                                                <a href="{{ route('berita') }}"><h2 class="text-dark font-weight-bolder">#Infrastruktur</h2></a>
                                                <a href="{{ route('berita') }}"><h4 class="text-dark font-weight-bolder">3 Berita</h4></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div>
                                <div
                                    class="card card-background shadow-none border-radius-xl card-background-after-none align-items-start mb-0">
                                    <div class="full-background bg-cover"
                                        style="background-image: url('../assets/img/img-2.jpg')"></div>
                                    <div class="card-body text-start px-3 py-0 w-100">
                                        <div class="row mt-12">
                                            <div class="col-sm-3 mt-auto">
                                                <a href="{{ route('berita') }}"><h2 class="text-dark font-weight-bolder">#Pertanian</h2></a>
                                                <a href="{{ route('berita') }}"><h4 class="text-dark font-weight-bolder">3 Berita</h4></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        </div>
        
    </section>

@endsection