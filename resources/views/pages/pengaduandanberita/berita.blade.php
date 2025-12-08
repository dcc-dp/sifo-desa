@extends('layouts.user')

@section('title', 'Berita Desa | Sistem Informasi Desa')

@section('content')

    <section>
            <div class="container">
                <h2><i class="fas fa-bullhorn"></i> Berita Desa Terbaru</h2>
                
                <div class="filter-bar">
                    <div class="search-bar">
                        <input type="text" placeholder="judul berita...">
                    </div>
                    <!-- <div class="filter-category">
                        <select>
                            <option value="">All Categories</option>
                            <option value="pembangunan">Pembangunan</option>
                            <option value="sosial">Sosial & Budaya</option>
                            <option value="ekonomi">Ekonomi</option>
                        </select>
                    </div> -->
                </div>

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