@extends('layouts.user')

@section('title', 'Berita Desa | Sistem Informasi Desa')

@section('content')

<section>
    <div class="container">
        <h2><i class="fas fa-bullhorn"></i> Berita Desa Terbaru</h2>

        <h3>Berita Kategori: {{ $kategori->nama_kategori }}</h3>

        <div class="news-grid">
            @foreach ($beritas as $berita)

                <a href="{{ route('detail-berita', $berita->slug) }}"
                   class="text-decoration-none text-dark">

                    <div class="card news-item">

                        @if($berita->gambar)
                            <img src="{{ asset($berita->gambar ?? 'upload/berita/default.jpg') }}">
                        @else
                            <img src="{{ asset('upload/berita/default.jpg') }}"
                                 class="img-fluid w-100"
                                 alt="Default pemerintah">
                        @endif

                        <div class="content">
                            <h4>{{ $berita->judul }}</h4>
                            <p>{{ Str::limit($berita->deskripsi, 120) }}</p>
                        </div>

                    </div>
                </a>

            @endforeach
        </div>
    </div>
</section>

@endsection
