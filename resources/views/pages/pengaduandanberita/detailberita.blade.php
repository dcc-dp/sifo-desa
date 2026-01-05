@extends('layouts.user')

@section('title', 'Kategori Berita | Sistem Informasi Desa')

@section('content')
    <section class="py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">

                    <div class="card shadow-sm border-0">
                        <div class="mb-4 rounded overflow-hidden">
                            <img src="{{ asset($berita->gambar) }}" class="img-fluid rounded mb-4 mx-auto d-block"
                                style="max-height:420px; width:auto; max-width:100%; object-fit:contain;">

                        </div>

                        <h2 class="fw-bold mb-2">
                            {{ $berita->judul }}
                        </h2>

                        <div class="text-muted mb-4">
                            <i class="fas fa-calendar-alt"></i>
                            {{ $berita->created_at->format('d M Y') }}
                            &nbsp; | &nbsp;
                            <i class="fas fa-tag"></i>
                            {{ $berita->kategori->nama_kategori }}
                        </div>

                        <hr>

                        <div class="berita-content mt-4">
                            {!! nl2br(e($berita->deskripsi)) !!}
                        </div>

                    </div>
                </div>

            </div>
        </div>
        </div>
    </section>
@endsection