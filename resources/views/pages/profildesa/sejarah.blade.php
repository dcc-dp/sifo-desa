@extends('layouts.user')

@section('title', 'Sejarah Desa | Sistem Informasi Desa')

@section('content')

    @php
        $setting = \App\Models\Setting::first();
        $desaName = (!empty($setting?->nama_desa)) ? $setting->nama_desa : 'Rante Gola';
    @endphp

    {{-- 1. Standard Page Hero Header --}}
    <section class="page-hero-header">
        <div class="container">
            <div class="page-hero-eyebrow">
                <i class="fas fa-history"></i>
                <span>Profil Desa • Sejarah</span>
            </div>
            <h1 class="page-hero-title">Perjalanan & Sejarah Desa {{ $desaName }}</h1>
            <p class="page-hero-desc">Mengenal jejak sejarah, tonggak perkembangan, dan kearifan masa lalu yang membentuk peradaban dan kemandirian Desa {{ $desaName }}.</p>
            <div class="page-hero-divider"></div>
            
            <div class="page-breadcrumbs">
                <a href="{{ route('home') }}"><i class="fas fa-home me-1"></i>Home</a>
                <span class="sep">/</span>
                <span>Profil Desa</span>
                <span class="sep">/</span>
                <span class="current">Sejarah Desa</span>
            </div>
        </div>
    </section>

    {{-- 2. Modern History Timeline --}}
    <section class="profile-content-section">
        <div class="profile-content-container">

            <div class="sejarah-timeline">
                @forelse ($sejarahs as $index => $item)
                    <div class="sejarah-timeline-item">
                        <div class="sejarah-timeline-marker">
                            <i class="fas fa-landmark"></i>
                        </div>

                        <div class="sejarah-timeline-card">
                            <h3 class="sejarah-card-title">
                                <i class="far fa-compass"></i>
                                <span>{{ $item->judul }}</span>
                            </h3>

                            @if($item->gambar)
                                <div class="mb-3 text-center">
                                    <img src="{{ asset($item->gambar) }}"
                                         alt="{{ $item->judul }}"
                                         class="sejarah-card-image"
                                         loading="lazy">
                                </div>
                            @endif

                            <p class="sejarah-card-text">{!! nl2br(e($item->deskripsi)) !!}</p>
                        </div>
                    </div>
                @empty
                    <div class="card p-5 text-center shadow-sm border-0 rounded-4">
                        <i class="fas fa-book-open text-muted mb-3" style="font-size: 3rem; opacity: 0.35;"></i>
                        <h4 class="text-muted fw-bold">Data Sejarah Belum Tersedia</h4>
                        <p class="text-secondary small mb-0">Informasi kronologis sejarah desa sedang dalam tahap pendokumentasian.</p>
                    </div>
                @endforelse
            </div>

        </div>
    </section>

@endsection