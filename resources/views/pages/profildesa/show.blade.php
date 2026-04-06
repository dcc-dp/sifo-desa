@extends('layouts.user')

@section('title', $batch->nama . ' | Galeri Desa')

@section('content')
    <section>
        <div class="container">
            <nav aria-label="breadcrumb" class="mb-4">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ route('user.galeri') }}">
                            <i class="fas fa-images me-1"></i>Galeri
                        </a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">{{ $batch->nama }}</li>
                </ol>
            </nav>

            {{-- <div class="row mb-4"> --}}

            <div class="gallery-header">
                <h2>{{ $batch->nama }}</h2>
                <p>
                    <i class="fas fa-images"></i>
                    {{ $batch->galeris->count() }} Foto
                </p>
            </div>


            {{-- <div class="col-lg-4 text-lg-end mt-3 mt-lg-0">
                    <a href="{{ route('user.galeri') }}" class="btn btn-outline-primary btn-sm">
                        <i class="fas fa-arrow-left me-2"></i>Kembali
                    </a>
                </div>
            </div> --}}

            <div class="gallery-grid">
                @forelse ($batch->galeris as $index => $galeri)
                    <div>
                        <div class="gallery-item shadow-sm" onclick="openLightbox({{ $index }})">
                            <img src="{{ asset($galeri->gambar) }}" alt="{{ $galeri->judul ?? 'Foto ' . ($index + 1) }}"
                                loading="lazy">
                        </div>

                        @if ($galeri->judul)
                            <span class="gallery-title">{{ $galeri->judul }}</span>
                        @endif
                    </div>
                @empty
                    <p>Belum ada foto</p>
                @endforelse
            </div>

        </div>
    </section>

    <div id="lightbox" class="lightbox" onclick="closeLightbox(event)">
        <span class="lightbox-close" onclick="closeLightbox(event)">&times;</span>
        <span class="lightbox-prev" onclick="changeImage(-1); event.stopPropagation()">&#10094;</span>
        <img id="lightbox-img" class="lightbox-content" src="" alt="">
        <span class="lightbox-next" onclick="changeImage(1); event.stopPropagation()">&#10095;</span>
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
