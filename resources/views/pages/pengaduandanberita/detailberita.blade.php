@extends('layouts.user')

@section('title', $berita->judul . ' | Sistem Informasi Desa')

@section('content')

    @php
        $kategoriSlug = $berita->kategori?->slug ?? '';
        $kategoriName = $berita->kategori?->nama_kategori ?? 'Umum';
        $setting = \App\Models\Setting::first();
        $desaName = (!empty($setting?->nama_desa)) ? $setting->nama_desa : 'Rante Gola';
        $gambarBerita = ($berita->gambar && file_exists(public_path($berita->gambar))) 
            ? asset($berita->gambar) 
            : asset('upload/berita/default.jpg');
    @endphp

    {{-- 1. Standard Page Hero Header --}}
    <section class="page-hero-header">
        <div class="container">
            <div class="page-hero-eyebrow">
                <i class="fas fa-newspaper"></i>
                <span>Warta Desa • {{ $kategoriName }}</span>
            </div>
            <h1 class="page-hero-title" style="max-width: 820px; margin-left: auto; margin-right: auto;">
                {{ $berita->judul }}
            </h1>
            <div class="page-hero-divider"></div>
            
            <div class="page-breadcrumbs">
                <a href="{{ route('home') }}"><i class="fas fa-home me-1"></i>Home</a>
                <span class="sep">/</span>
                <a href="{{ route('kategori') }}">Kategori Berita</a>
                @if($kategoriSlug)
                    <span class="sep">/</span>
                    <a href="{{ route('show-kategori', $kategoriSlug) }}">{{ $kategoriName }}</a>
                @endif
                <span class="sep">/</span>
                <span class="current">Detail Berita</span>
            </div>
        </div>
    </section>

    {{-- 2. Modern Editorial Article Layout --}}
    <section class="profile-content-section">
        <div class="profile-content-container">

            <div class="article-editorial-container">
                <div class="article-card-box">

                    {{-- Featured Article Image --}}
                    @if($berita->gambar)
                        <div class="article-featured-image-wrap">
                            <img src="{{ $gambarBerita }}" 
                                 alt="{{ $berita->judul }}" 
                                 class="article-featured-image">
                        </div>
                    @endif

                    {{-- Metadata Bar --}}
                    <div class="article-meta-bar">
                        <div class="article-meta-item">
                            <i class="far fa-calendar-alt"></i>
                            <span>{{ $berita->created_at ? $berita->created_at->format('d F Y') : 'Tanggal Tidak Tersedia' }}</span>
                        </div>

                        <div class="article-meta-item">
                            <i class="fas fa-tag"></i>
                            @if($kategoriSlug)
                                <a href="{{ route('show-kategori', $kategoriSlug) }}" class="text-success fw-semibold text-decoration-none">
                                    {{ $kategoriName }}
                                </a>
                            @else
                                <span class="text-success fw-semibold">{{ $kategoriName }}</span>
                            @endif
                        </div>

                        <div class="article-meta-item">
                            <i class="fas fa-landmark"></i>
                            <span>Pemerintah Desa {{ $desaName }}</span>
                        </div>
                    </div>

                    {{-- Article Content --}}
                    <div class="article-body-content">
                        {!! nl2br(e($berita->deskripsi)) !!}
                    </div>

                    {{-- Bottom Actions --}}
                    <div class="article-bottom-actions">
                        @if($kategoriSlug)
                            <a href="{{ route('show-kategori', $kategoriSlug) }}" class="btn btn-outline-success px-4 py-2 rounded-pill fw-semibold">
                                <i class="fas fa-arrow-left me-2"></i>Kembali ke Kategori {{ $kategoriName }}
                            </a>
                        @else
                            <a href="{{ route('kategori') }}" class="btn btn-outline-success px-4 py-2 rounded-pill fw-semibold">
                                <i class="fas fa-arrow-left me-2"></i>Kembali ke Kategori Berita
                            </a>
                        @endif

                        <a href="{{ route('home') }}" class="btn btn-outline-secondary px-4 py-2 rounded-pill fw-semibold">
                            <i class="fas fa-home me-2"></i>Beranda
                        </a>
                    </div>

                </div>
            </div>

        </div>
    </section>

@endsection