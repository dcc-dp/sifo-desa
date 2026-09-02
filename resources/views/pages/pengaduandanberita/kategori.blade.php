@extends('layouts.user')

@section('title', 'Kategori Berita | Sistem Informasi Desa')

@section('content')

    @php
        $setting = \App\Models\Setting::first();
        $desaName = (!empty($setting?->nama_desa)) ? $setting->nama_desa : 'Rante Gola';
    @endphp

    {{-- 1. Standard Page Hero Header --}}
    <section class="page-hero-header">
        <div class="container">
            <div class="page-hero-eyebrow">
                <i class="fas fa-newspaper"></i>
                <span>Warta & Publikasi Desa</span>
            </div>
            <h1 class="page-hero-title">Kategori Berita & Informasi</h1>
            <p class="page-hero-desc">Pilih topik kategori warta untuk menemukan informasi resmi, liputan kegiatan, dan pengumuman penting di Desa {{ $desaName }}.</p>
            <div class="page-hero-divider"></div>
            
            <div class="page-breadcrumbs">
                <a href="{{ route('home') }}"><i class="fas fa-home me-1"></i>Home</a>
                <span class="sep">/</span>
                <span>Berita & Agenda</span>
                <span class="sep">/</span>
                <span class="current">Kategori Berita</span>
            </div>
        </div>
    </section>

    {{-- 2. Modern Category Cards Grid --}}
    <section class="profile-content-section">
        <div class="profile-content-container">

            <div class="kategori-grid-modern">
                @forelse ($kategoris as $kategori)
                    <a href="{{ route('show-kategori', $kategori->slug) }}" class="kategori-card-modern">
                        <div class="kategori-icon-wrap">
                            <i class="fas fa-folder"></i>
                        </div>

                        <h3 class="kategori-title">#{{ $kategori->nama_kategori }}</h3>

                        <div class="kategori-count-badge">
                            <i class="fas fa-file-alt text-success"></i>
                            <span>{{ $kategori->beritas_count }} Publikasi Berita</span>
                        </div>

                        <div class="kategori-btn-view">
                            <span>Jelajahi Berita</span>
                            <i class="fas fa-arrow-right"></i>
                        </div>
                    </a>
                @empty
                    <div class="card p-5 text-center shadow-sm border-0 rounded-4 w-100">
                        <i class="fas fa-newspaper text-muted mb-3" style="font-size: 3rem; opacity: 0.35;"></i>
                        <h4 class="text-muted fw-bold">Kategori Belum Tersedia</h4>
                        <p class="text-secondary small mb-0">Belum ada kategori warta yang ditambahkan oleh admin.</p>
                    </div>
                @endforelse
            </div>

        </div>
    </section>

@endsection