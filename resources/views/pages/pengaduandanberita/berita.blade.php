@extends('layouts.user')

@php
    $kategoriName = is_object($kategori) && isset($kategori->nama_kategori) 
        ? $kategori->nama_kategori 
        : 'Semua Kategori';
    $setting = \App\Models\Setting::first();
    $desaName = (!empty($setting?->nama_desa)) ? $setting->nama_desa : 'Rante Gola';
@endphp

@section('title', 'Berita Kategori: ' . $kategoriName . ' | Sistem Informasi Desa')

@section('content')

    {{-- 1. Standard Page Hero Header --}}
    <section class="page-hero-header">
        <div class="container">
            <div class="page-hero-eyebrow">
                <i class="fas fa-tag"></i>
                <span>Kategori • {{ $kategoriName }}</span>
            </div>
            <h1 class="page-hero-title">Warta & Berita: {{ $kategoriName }}</h1>
            <p class="page-hero-desc">Kumpulan informasi terkini, liputan kegiatan, dan pengumuman resmi Desa {{ $desaName }} dalam kategori {{ $kategoriName }}.</p>
            <div class="page-hero-divider"></div>
            
            <div class="page-breadcrumbs">
                <a href="{{ route('home') }}"><i class="fas fa-home me-1"></i>Home</a>
                <span class="sep">/</span>
                <a href="{{ route('kategori') }}">Kategori Berita</a>
                <span class="sep">/</span>
                <span class="current">{{ $kategoriName }}</span>
            </div>
        </div>
    </section>

    {{-- 2. Modern Editorial News Grid --}}
    <section class="profile-content-section">
        <div class="profile-content-container">

            <div class="d-flex align-items-center justify-content-between flex-wrap gap-3 mb-4 pb-2 border-bottom">
                <div class="d-flex align-items-center gap-2">
                    <span class="badge bg-success-subtle text-success-emphasis px-3 py-2 rounded-pill fw-semibold border border-success-subtle">
                        <i class="fas fa-newspaper me-1"></i> {{ $beritas->count() }} Artikel Tersedia
                    </span>
                </div>

                <a href="{{ route('kategori') }}" class="btn btn-outline-secondary btn-sm px-3 py-2 rounded-pill fw-semibold">
                    <i class="fas fa-arrow-left me-2"></i>Pilih Kategori Lain
                </a>
            </div>

            <div class="news-grid-modern">
                @forelse ($beritas as $berita)
                    <a href="{{ route('detail-berita', $berita->slug) }}" class="news-card-modern">
                        <div class="news-card-thumb-wrap">
                            @if($berita->gambar && file_exists(public_path($berita->gambar)))
                                <img src="{{ asset($berita->gambar) }}" 
                                     alt="{{ $berita->judul }}" 
                                     class="news-card-thumb"
                                     loading="lazy">
                            @else
                                <img src="{{ asset('upload/berita/default.jpg') }}" 
                                     alt="{{ $berita->judul }}" 
                                     class="news-card-thumb"
                                     loading="lazy">
                            @endif

                            <span class="news-card-category-tag">
                                {{ $kategoriName }}
                            </span>
                        </div>

                        <div class="news-card-body">
                            <div class="news-card-date">
                                <i class="far fa-calendar-alt"></i>
                                <span>{{ $berita->created_at ? $berita->created_at->format('d M Y') : 'Baru' }}</span>
                            </div>

                            <h3 class="news-card-title">{{ $berita->judul }}</h3>

                            <p class="news-card-excerpt">
                                {{ \Illuminate\Support\Str::limit(strip_tags($berita->deskripsi), 120, '...') }}
                            </p>

                            <div class="news-card-readmore">
                                <span>Baca Selengkapnya</span>
                                <i class="fas fa-arrow-right"></i>
                            </div>
                        </div>
                    </a>
                @empty
                    <div class="card p-5 text-center shadow-sm border-0 rounded-4 w-100">
                        <i class="far fa-newspaper text-muted mb-3" style="font-size: 3rem; opacity: 0.35;"></i>
                        <h4 class="text-muted fw-bold">Belum Ada Berita di Kategori Ini</h4>
                        <p class="text-secondary small mb-3">Artikel atau warta untuk kategori {{ $kategoriName }} belum dipublikasikan.</p>
                        <div>
                            <a href="{{ route('kategori') }}" class="btn btn-outline-success px-4 py-2 rounded-pill fw-semibold">
                                <i class="fas fa-arrow-left me-2"></i>Kembali ke Kategori
                            </a>
                        </div>
                    </div>
                @endforelse
            </div>

        </div>
    </section>

@endsection
