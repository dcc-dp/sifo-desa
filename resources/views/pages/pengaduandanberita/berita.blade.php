@extends('layouts.user')

@section('title', 'Berita Desa | Sistem Informasi Desa')

@section('content')

    <section>
            <div class="container">
                <h2><i class="fas fa-bullhorn"></i> Berita Desa Terbaru</h2>

                <h3>Berita Kategori: {{ $kategori->nama_kategori }}</h3>

                <div class="news-grid">
                    @foreach ($beritas as $berita)
                    <div class="card news-item" onclick="navigate('news-detail', {id: 1})">
                        @if($berita->gambar)
                        <img src="{{ asset($berita->gambar) }}" class="img-fluid w-100" alt="{{ $berita->judul }}">
                        @else
                            <img src="{{ asset('/upload/berita/default.jpg') }}" class="img-fluid w-100" alt="Default pemerintah" style="height: px; object-fit: cover;">
                        @endif
                        <div class="content">
                            <h4>{{ $berita->judul }}</h4>
                            <p>{{ $berita->deskripsi }}</p>
                        </div>
                    </div>
                    @endforeach
                    </div>
            </div>
        </section>

@endsection