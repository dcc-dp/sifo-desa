@extends('layouts.user')

@section('title', $pemerintah->nama . ' - Aparatur Desa | Sistem Informasi Desa')

@section('content')

    @php
        $setting = \App\Models\Setting::first();
        $desaName = (!empty($setting?->nama_desa)) ? $setting->nama_desa : 'Rante Gola';
        $fotoAparatur = ($pemerintah->foto && file_exists(public_path($pemerintah->foto))) 
            ? asset($pemerintah->foto) 
            : asset('assets/img/default-avatar.png');
    @endphp

    {{-- 1. Standard Page Hero Header --}}
    <section class="page-hero-header">
        <div class="container">
            <div class="page-hero-eyebrow">
                <i class="fas fa-id-badge"></i>
                <span>Profil Aparatur Desa</span>
            </div>
            <h1 class="page-hero-title">{{ $pemerintah->nama }}</h1>
            <p class="page-hero-desc">{{ $pemerintah->jabatan }} Pemerintah Desa {{ $desaName }}</p>
            <div class="page-hero-divider"></div>

            <div class="page-breadcrumbs">
                <a href="{{ route('home') }}"><i class="fas fa-home me-1"></i>Home</a>
                <span class="sep">/</span>
                <a href="{{ url('/pemerintah') }}">Pemerintah Desa</a>
                <span class="sep">/</span>
                <span class="current">{{ $pemerintah->nama }}</span>
            </div>
        </div>
    </section>

    {{-- 2. Detail Layout --}}
    <section class="profile-content-section">
        <div class="profile-content-container">

            <div class="gov-detail-grid">

                {{-- Left Column: Portrait Showcase --}}
                <div class="gov-detail-sidebar">
                    <div class="gov-detail-photo-card">
                        <img src="{{ $fotoAparatur }}" alt="{{ $pemerintah->nama }}" class="gov-detail-img">

                        <h3 class="gov-name-modern mb-2">{{ $pemerintah->nama }}</h3>
                        <div class="gov-role-pill mb-3">
                            <i class="fas fa-user-shield"></i>
                            <span>{{ $pemerintah->jabatan }}</span>
                        </div>

                        <a href="{{ url('/pemerintah') }}" class="gov-btn-detail">
                            <i class="fas fa-arrow-left"></i>
                            <span>Kembali ke Aparatur</span>
                        </a>
                    </div>
                </div>

                {{-- Right Column: Information & Tupoksi --}}
                <div class="gov-detail-main">
                    <div class="gov-detail-info-card">
                        <div class="gov-detail-badge-group">
                            <span class="badge bg-success-subtle text-success-emphasis px-3 py-2 rounded-pill fw-semibold border border-success-subtle">
                                <i class="fas fa-check-circle me-1"></i> Aparatur Resmi Desa
                            </span>
                        </div>

                        <h2 class="gov-detail-name">{{ $pemerintah->nama }}</h2>

                        <div class="d-flex align-items-center gap-3 pb-3 mb-3 border-bottom">
                            <div>
                                <small class="text-muted text-uppercase fw-bold letter-spacing-1 d-block mb-1" style="font-size: 0.72rem; letter-spacing: 0.06em;">Jabatan Struktural</small>
                                <span class="fw-bold text-success fs-5">{{ $pemerintah->jabatan }}</span>
                            </div>
                        </div>

                        <div class="gov-tupoksi-box">
                            <h4 class="gov-tupoksi-title">
                                <i class="fas fa-tasks"></i>
                                <span>Tugas Pokok & Fungsi (Tupoksi)</span>
                            </h4>
                            <div class="gov-tupoksi-content">
                                {!! nl2br(e($pemerintah->tupoksi)) !!}
                            </div>
                        </div>

                        <div class="d-flex justify-content-end">
                            <a href="{{ url('/pemerintah') }}" class="btn btn-outline-secondary px-4 py-2 rounded-pill fw-semibold">
                                <i class="fas fa-arrow-left me-2"></i>Kembali ke Daftar Aparatur
                            </a>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </section>

@endsection