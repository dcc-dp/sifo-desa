@extends('layouts.user')

@section('title', 'Galeri Desa | Sistem Informasi Desa')

@push('styles')
    <style>
        .gallery-swiper {
            position: relative;
            width: min(600px, 86vw);
            margin: 0 auto;
            overflow: visible;
            z-index: 1;
            display: block;
            list-style: none;
            padding: 20px 0;
        }

        .gallery-swiper.swiper-3d {
            perspective: 1200px;
        }

        .gallery-swiper .swiper-slide {
            position: relative;
            flex-shrink: 0;
            width: 100%;
            height: 400px;
            display: block;
            overflow: hidden;
            border-radius: 18px;
            text-decoration: none;
            backface-visibility: hidden;
            transform-origin: center bottom;
            transition-property: transform;
            box-shadow: 0 16px 36px rgba(0, 0, 0, 0.18);
        }

        .gallery-swiper .swiper-slide-shadow {
            background: transparent;
        }

        .gallery-card {
            position: relative;
            width: 100%;
            height: 100%;
            overflow: hidden;
            border-radius: 18px;
            background: #0f172a;
        }

        .gallery-card__image {
            position: absolute;
            inset: 0;
            background-position: center;
            background-size: cover;
            transition: transform 0.5s ease;
        }

        .gallery-card:hover .gallery-card__image {
            transform: scale(1.05);
        }

        .gallery-card::after {
            content: "";
            position: absolute;
            inset: 0;
            background: linear-gradient(180deg, rgba(0,0,0,0.1) 0%, rgba(6, 40, 24, 0.75) 60%, rgba(5, 30, 18, 0.95) 100%);
        }

        .gallery-card__content {
            position: relative;
            z-index: 2;
            height: 100%;
            display: flex;
            flex-direction: column;
            justify-content: flex-end;
            padding: 28px;
            color: #fff;
        }

        .gallery-card__title {
            margin: 0 0 10px;
            font-size: 1.6rem;
            font-weight: 700;
            color: #ffffff;
            line-height: 1.25;
        }

        .gallery-card__meta {
            margin: 0;
            display: inline-flex;
            align-items: center;
            gap: 7px;
            font-size: 0.88rem;
            font-weight: 600;
            color: #facc15;
            background: rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(8px);
            padding: 5px 14px;
            border-radius: 9999px;
            width: fit-content;
            border: 1px solid rgba(255, 255, 255, 0.25);
        }

        .gallery-swiper .swiper-button-prev,
        .gallery-swiper .swiper-button-next {
            position: absolute;
            top: 50%;
            z-index: 10;
            width: 46px;
            height: 46px;
            margin-top: -23px;
            background: #ffffff;
            color: var(--color-primary-dark);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 6px 18px rgba(0, 0, 0, 0.14);
            cursor: pointer;
            border: 1px solid #e2e8f0;
            transition: all 0.25s ease;
        }

        .gallery-swiper .swiper-button-prev:hover,
        .gallery-swiper .swiper-button-next:hover {
            background: var(--color-primary);
            color: #ffffff;
            transform: scale(1.1);
        }

        .gallery-swiper .swiper-button-prev::after,
        .gallery-swiper .swiper-button-next::after {
            display: none !important;
        }

        .gallery-swiper .swiper-button-prev {
            left: -60px;
        }

        .gallery-swiper .swiper-button-next {
            right: -60px;
        }

        @media (max-width: 768px) {
            .gallery-swiper {
                width: min(320px, 82vw);
            }
            .gallery-swiper .swiper-slide {
                height: 320px;
            }
            .gallery-swiper .swiper-button-prev {
                left: -20px;
            }
            .gallery-swiper .swiper-button-next {
                right: -20px;
            }
        }
    </style>
@endpush

@section('content')

    @php
        $setting = \App\Models\Setting::first();
        $desaName = (!empty($setting?->nama_desa)) ? $setting->nama_desa : 'Rante Gola';
    @endphp

    <section class="page-hero-header">
        <div class="container">
            <div class="page-hero-eyebrow">
                <i class="fas fa-images"></i>
                <span>Profil Desa • Galeri</span>
            </div>
            <h1 class="page-hero-title">Galeri Dokumentasi & Kegiatan Desa</h1>
            <p class="page-hero-desc">Kumpulan arsip visual kegiatan pembangunan, potensi desa, perayaan kebudayaan, dan momen bersejarah Desa {{ $desaName }}.</p>
            <div class="page-hero-divider"></div>
            
            <div class="page-breadcrumbs">
                <a href="{{ route('home') }}"><i class="fas fa-home me-1"></i>Home</a>
                <span class="sep">/</span>
                <span>Profil Desa</span>
                <span class="sep">/</span>
                <span class="current">Galeri Desa</span>
            </div>
        </div>
    </section>

    <section class="profile-content-section">
        <div class="profile-content-container">

            <div class="gallery-wrapper mb-5">
                <div class="gallery-wrapper-header">
                    <div>
                        <h3 class="mb-1" style="font-size: 1.45rem; font-weight: 700; color: #0f172a;">
                            <i class="fas fa-layer-group text-success me-2"></i>Koleksi Album Unggulan
                        </h3>
                        <p class="text-muted small mb-0">Geser untuk melihat album dokumentasi desa</p>
                    </div>

                    <span class="gallery-badge">
                        <i class="fas fa-folder-open me-1"></i>
                        {{ $batches->count() }} Album
                    </span>
                </div>

                <div class="swiper gallery-swiper">
                    <div class="swiper-wrapper">
                        @forelse ($batches as $batch)
                            <a class="swiper-slide" href="{{ route('user.galeri.show', $batch) }}">
                                <div class="gallery-card">
                                    <div class="gallery-card__image"
                                        style="background-image:url('{{ asset(optional($batch->galeris->first())->gambar ?? 'assets/img/default.jpg') }}')">
                                    </div>

                                    <div class="gallery-card__content">
                                        <h2 class="gallery-card__title">
                                            {{ $batch->nama }}
                                        </h2>

                                        <span class="gallery-card__meta">
                                            <i class="fas fa-camera"></i>
                                            {{ $batch->galeris->count() }} Foto Dokumentasi
                                        </span>
                                    </div>
                                </div>
                            </a>
                        @empty
                            <div class="swiper-slide">
                                <div class="gallery-card">
                                    <div class="gallery-card__content">
                                        <h2 class="gallery-card__title">Belum Ada Galeri</h2>
                                        <p class="gallery-card__meta">
                                            <i class="fas fa-image"></i> 0 Foto
                                        </p>
                                    </div>
                                </div>
                            </div>
                        @endforelse
                    </div>

                    <div class="swiper-button-prev">
                        <i class="fas fa-chevron-left"></i>
                    </div>
                    <div class="swiper-button-next">
                        <i class="fas fa-chevron-right"></i>
                    </div>
                </div>
            </div>

            <div class="mt-5 pt-3">
                <div class="d-flex align-items-center justify-content-between mb-4">
                    <h3 style="font-size: 1.35rem; font-weight: 700; color: #0f172a; margin: 0;">
                        <i class="fas fa-th-large text-success me-2"></i>Semua Album Foto
                    </h3>
                    <span class="text-muted small">{{ $batches->count() }} Album Tersedia</span>
                </div>

                <div class="galeri-batches-grid">
                    @forelse ($batches as $batch)
                        <a href="{{ route('user.galeri.show', $batch) }}" class="galeri-batch-card">
                            <div class="galeri-batch-bg" 
                                 style="background-image:url('{{ asset(optional($batch->galeris->first())->gambar ?? 'assets/img/default.jpg') }}');">
                            </div>
                            <div class="galeri-batch-overlay"></div>
                            <div class="galeri-batch-content">
                                <h4 class="galeri-batch-title">{{ $batch->nama }}</h4>
                                <span class="galeri-batch-pill">
                                    <i class="fas fa-images"></i>
                                    {{ $batch->galeris->count() }} Foto
                                </span>
                            </div>
                        </a>
                    @empty
                        <div class="card p-5 text-center shadow-sm border-0 rounded-4 w-100">
                            <i class="fas fa-images text-muted mb-3" style="font-size: 3rem; opacity: 0.35;"></i>
                            <h4 class="text-muted fw-bold">Album Dokumentasi Belum Tersedia</h4>
                            <p class="text-secondary small mb-0">Dokumentasi foto kegiatan masyarakat desa akan segera diunggah.</p>
                        </div>
                    @endforelse
                </div>
            </div>

        </div>
    </section>

@endsection

@push('scripts')
    <script src="{{ asset('assets/js/plugins/swiper-bundle.min.js') }}" type="text/javascript"></script>
    <script>
        const gallerySwiper = document.querySelector('.gallery-swiper');

        if (gallerySwiper && typeof Swiper !== 'undefined') {
            new Swiper(".gallery-swiper", {
                effect: "cards",
                grabCursor: true,
                initialSlide: {{ max(0, min(1, $batches->count() - 1)) }},
                navigation: {
                    nextEl: '.swiper-button-next',
                    prevEl: '.swiper-button-prev',
                },
            });
        }
    </script>
@endpush
