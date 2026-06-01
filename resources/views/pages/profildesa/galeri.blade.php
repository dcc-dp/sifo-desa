@extends('layouts.user')

@section('title', 'Galeri | Sistem Informasi Desa')

@push('styles')
    <style>
        .gallery-section {
            min-height: calc(100vh - 180px);
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 96px 0;
            background: var(--color-bg-light);
        }

        .gallery-swiper {
            position: relative;
            width: min(600px, 82vw);
            margin: 0 auto;
            overflow: visible;
            z-index: 1;
            display: block;
            list-style: none;
            padding: 0;
        }

        .gallery-swiper.swiper-3d {
            perspective: 1200px;
        }

        .gallery-swiper .swiper-wrapper {
            position: relative;
            width: 100%;
            height: 100%;
            z-index: 1;
            display: flex;
            box-sizing: content-box;
            transition-property: transform;
            transform-style: preserve-3d;
        }

        .gallery-swiper .swiper-slide {
            position: relative;
            flex-shrink: 0;
            width: 100%;
            height: 390px;
            display: block;
            overflow: hidden;
            color: inherit;
            border-radius: 8px;
            text-decoration: none;
            backface-visibility: hidden;
            transform-origin: center bottom;
            transition-property: transform;
        }

        .gallery-swiper .swiper-slide-shadow {
            background: transparent;
        }

        .gallery-card {
            position: relative;
            width: 100%;
            height: 100%;
            overflow: hidden;
            border-radius: 8px;
            background: #1f2937;
            box-shadow: 0 18px 45px rgba(15, 23, 42, 0.18);
        }

        .gallery-card__image {
            position: absolute;
            inset: 0;
            background-position: center;
            background-size: cover;
        }

        .gallery-card::after {
            content: "";
            position: absolute;
            inset: 0;
            background: linear-gradient(180deg, rgba(15, 23, 42, 0.05), rgba(15, 23, 42, 0.58));
        }

        .gallery-card__content {
            position: relative;
            z-index: 1;
            height: 100%;
            display: flex;
            flex-direction: column;
            justify-content: flex-end;
            padding: 24px;
            color: #fff;
        }

        .gallery-card__count {
            margin: 0;
            font-size: 2rem;
            font-weight: 700;
            line-height: 1;
        }

        .gallery-card__label {
            margin: 4px 0 8px;
            font-size: 0.78rem;
            font-weight: 600;
            opacity: 0.78;
            text-transform: uppercase;
        }

        .gallery-card__title {
            margin: 0;
            font-size: 1.25rem;
            font-weight: 700;
            line-height: 1.25;
        }

        .gallery-swiper .swiper-button-next,
        .gallery-swiper .swiper-button-prev {
            position: absolute;
            top: 50%;
            z-index: 10;
            width: 36px;
            height: 36px;
            margin-top: -18px;
            color: #1f2937;
            cursor: pointer;
        }

        .gallery-swiper .swiper-button-prev {
            left: -54px;
        }

        .gallery-swiper .swiper-button-next {
            right: -54px;
        }

        .gallery-swiper .swiper-button-next::after,
        .gallery-swiper .swiper-button-prev::after {
            font-size: 2rem;
            line-height: 1;
        }

        .gallery-swiper .swiper-button-prev::after {
            content: "<";
        }

        .gallery-swiper .swiper-button-next::after {
            content: ">";
        }

        @media (max-width: 767px) {
            .gallery-section {
                padding: 64px 0;
            }

            .gallery-swiper {
                width: min(300px, 78vw);
            }

            .gallery-swiper .swiper-slide {
                height: 300px;
            }

            .gallery-swiper .swiper-button-prev {
                left: -34px;
            }

            .gallery-swiper .swiper-button-next {
                right: -34px;
            }
        }
    </style>
@endpush

@section('content')
    <section class="gallery-section">
        <div class="container">
            <div class="swiper gallery-swiper">
                <div class="swiper-wrapper">
                    @forelse ($batches as $batch)
                        <a class="swiper-slide" href="{{ route('user.galeri.show', $batch) }}">
                            <div class="gallery-card">
                                <div class="gallery-card__image"
                                    style="background-image: url('{{ asset(optional($batch->galeris->first())->gambar ?? 'assets/img/default.jpg') }}')">
                                </div>
                                <div class="gallery-card__content">
                                    <p class="gallery-card__count">
                                        {{ $batch->galeris->count() }}
                                    </p>
                                    <p class="gallery-card__label">
                                        Folder
                                    </p>
                                    <h2 class="gallery-card__title">
                                        {{ $batch->nama }}
                                    </h2>
                                </div>
                            </div>
                        </a>
                    @empty
                        <div class="swiper-slide">
                            <div class="gallery-card">
                                <div class="gallery-card__content">
                                    <p class="gallery-card__count">0</p>
                                    <p class="gallery-card__label">Folder</p>
                                    <h2 class="gallery-card__title">Belum ada galeri</h2>
                                </div>
                            </div>
                        </div>
                    @endforelse
                </div>
                <div class="swiper-button-prev"></div>
                <div class="swiper-button-next"></div>
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