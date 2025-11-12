@extends('layouts.user')

@section('title', 'Galeri | Sistem Informasi Desa')

@section('content')

    <section>
        <div class="container">
            <h2><i class="fas fa-images"></i> Galeri Foto Desa</h2>

            <div id="album-list" class="album-grid">
                <div class="card album-card" onclick="navigate('gallery-detail', {album: 'pembangunan'})">
                    <img src="https://picsum.photos/400/200?random=9" alt="Album Thumbnail">
                    <div class="album-name">Pembangunan Infrastruktur</div>
                </div>
                <div class="card album-card" onclick="navigate('gallery-detail', {album: 'budaya'})">
                    <img src="https://picsum.photos/400/200?random=10" alt="Album Thumbnail">
                    <div class="album-name">Acara Adat & Budaya</div>
                </div>
                <div class="card album-card" onclick="navigate('gallery-detail', {album: 'gotongroyong'})">
                    <img src="https://picsum.photos/400/200?random=11" alt="Album Thumbnail">
                    <div class="album-name">Kegiatan Gotong Royong</div>
                </div>
            </div>

            <div id="gallery-detail-container" style="display: none;">
                <button onclick="navigate('gallery')" class="btn btn-secondary" style="margin-bottom: 20px;"><i
                        class="fas fa-arrow-left"></i> Back to Albums</button>
                <h2 id="gallery-detail-title">Album: Pembangunan Infrastruktur</h2>
                <div id="photo-gallery-grid" class="photo-gallery">
                </div>
            </div>

        </div>
    </section>

@endsection