@extends('layouts.user')

@section('title', $batch->nama . ' - Galeri Desa | Sistem Informasi Desa')

@section('content')

    {{-- 1. Standard Page Hero Header --}}
    <section class="page-hero-header">
        <div class="container">
            <div class="page-hero-eyebrow">
                <i class="fas fa-camera"></i>
                <span>Dokumentasi Desa • Album</span>
            </div>
            <h1 class="page-hero-title">{{ $batch->nama }}</h1>
            <p class="page-hero-desc">Koleksi {{ $batch->galeris->count() }} arsip foto dokumentasi resmi kegiatan dan pembangunan desa.</p>
            <div class="page-hero-divider"></div>

            <div class="page-breadcrumbs">
                <a href="{{ route('home') }}"><i class="fas fa-home me-1"></i>Home</a>
                <span class="sep">/</span>
                <a href="{{ route('user.galeri') }}">Galeri Desa</a>
                <span class="sep">/</span>
                <span class="current">{{ $batch->nama }}</span>
            </div>
        </div>
    </section>

    {{-- 2. Album Photos Section --}}
    <section class="profile-content-section">
        <div class="profile-content-container">

            <div class="d-flex align-items-center justify-content-between flex-wrap gap-3 mb-4 pb-2 border-bottom">
                <div class="d-flex align-items-center gap-2">
                    <span class="badge bg-success-subtle text-success-emphasis px-3 py-2 rounded-pill fw-semibold border border-success-subtle">
                        <i class="fas fa-images me-1"></i> {{ $batch->galeris->count() }} Foto Dokumentasi
                    </span>
                </div>

                <a href="{{ route('user.galeri') }}" class="btn btn-outline-secondary btn-sm px-3 py-2 rounded-pill fw-semibold">
                    <i class="fas fa-arrow-left me-2"></i>Kembali ke Semua Album
                </a>
            </div>

            <div class="galeri-photos-grid">
                @forelse ($batch->galeris as $index => $galeri)
                    <div class="galeri-photo-card" onclick="openLightbox({{ $index }})" role="button" tabindex="0">
                        <div class="galeri-photo-thumb-wrap">
                            <img src="{{ asset($galeri->gambar) }}" 
                                 alt="{{ $galeri->judul ?? 'Foto ' . ($index + 1) }}" 
                                 class="galeri-photo-thumb"
                                 loading="lazy">
                            <div class="galeri-photo-hover-overlay">
                                <i class="fas fa-magnifying-glass-plus"></i>
                            </div>
                        </div>

                        <p class="galeri-photo-title" title="{{ $galeri->judul ?? 'Dokumentasi ' . ($index + 1) }}">
                            <i class="far fa-image text-success me-1"></i>
                            {{ $galeri->judul ?? 'Dokumentasi ' . ($index + 1) }}
                        </p>
                    </div>
                @empty
                    <div class="card p-5 text-center shadow-sm border-0 rounded-4 w-100">
                        <i class="fas fa-image text-muted mb-3" style="font-size: 3rem; opacity: 0.35;"></i>
                        <h4 class="text-muted fw-bold">Belum Ada Foto dalam Album Ini</h4>
                        <p class="text-secondary small mb-0">Foto kegiatan untuk album ini belum diunggah.</p>
                    </div>
                @endforelse
            </div>

        </div>
    </section>

    {{-- Lightbox Modal --}}
    <div id="lightbox" class="lightbox" onclick="closeLightbox(event)">
        <span class="lightbox-close" onclick="closeLightbox(event)" title="Tutup">&times;</span>
        <span class="lightbox-prev" onclick="changeImage(-1); event.stopPropagation()" title="Sebelumnya">
            <i class="fas fa-chevron-left"></i>
        </span>
        <img id="lightbox-img" class="lightbox-content" src="" alt="Detail Foto">
        <span class="lightbox-next" onclick="changeImage(1); event.stopPropagation()" title="Selanjutnya">
            <i class="fas fa-chevron-right"></i>
        </span>
        <div class="lightbox-counter">
            <span id="current-image">1</span> / <span id="total-images">{{ $batch->galeris->count() }}</span>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        const images = [
            @foreach ($batch->galeris as $galeri)
                "{{ asset($galeri->gambar) }}",
            @endforeach
        ];

        let currentIndex = 0;

        function openLightbox(index) {
            currentIndex = index;
            const lightbox = document.getElementById('lightbox');
            const lightboxImg = document.getElementById('lightbox-img');

            lightbox.classList.add('active');
            lightboxImg.src = images[currentIndex];
            updateCounter();
            document.body.style.overflow = 'hidden';
        }

        function closeLightbox(event) {
            if (event.target.id === 'lightbox' || event.target.classList.contains('lightbox-close')) {
                document.getElementById('lightbox').classList.remove('active');
                document.body.style.overflow = 'auto';
            }
        }

        function changeImage(direction) {
            currentIndex += direction;

            if (currentIndex < 0) {
                currentIndex = images.length - 1;
            } else if (currentIndex >= images.length) {
                currentIndex = 0;
            }

            document.getElementById('lightbox-img').src = images[currentIndex];
            updateCounter();
        }

        function updateCounter() {
            document.getElementById('current-image').textContent = currentIndex + 1;
        }

        document.addEventListener('keydown', function(e) {
            const lightbox = document.getElementById('lightbox');
            if (lightbox.classList.contains('active')) {
                if (e.key === 'ArrowLeft') {
                    changeImage(-1);
                } else if (e.key === 'ArrowRight') {
                    changeImage(1);
                } else if (e.key === 'Escape') {
                    lightbox.classList.remove('active');
                    document.body.style.overflow = 'auto';
                }
            }
        });

        document.getElementById('lightbox-img')?.addEventListener('dragstart', function(e) {
            e.preventDefault();
        });

        let touchStartX = 0;
        let touchEndX = 0;

        document.getElementById('lightbox')?.addEventListener('touchstart', function(e) {
            touchStartX = e.changedTouches[0].screenX;
        });

        document.getElementById('lightbox')?.addEventListener('touchend', function(e) {
            touchEndX = e.changedTouches[0].screenX;
            handleSwipe();
        });

        function handleSwipe() {
            if (touchEndX < touchStartX - 50) {
                changeImage(1);
            }
            if (touchEndX > touchStartX + 50) {
                changeImage(-1);
            }
        }
    </script>
@endpush
