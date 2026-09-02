@extends('layouts.user')

@section('title', 'Pemerintah Desa | Sistem Informasi Desa')

@section('content')

    @php
        $setting = \App\Models\Setting::first();
        $desaName = (!empty($setting?->nama_desa)) ? $setting->nama_desa : 'Rante Gola';
    @endphp

    {{-- 1. Standard Page Hero Header --}}
    <section class="page-hero-header">
        <div class="container">
            <div class="page-hero-eyebrow">
                <i class="fas fa-users"></i>
                <span>Profil Desa • Pemerintahan</span>
            </div>
            <h1 class="page-hero-title">Struktur Organisasi & Aparatur Desa</h1>
            <p class="page-hero-desc">Mengenal jajaran pimpinan dan aparatur Pemerintah Desa {{ $desaName }} yang berdedikasi melayani dan mengabdi untuk masyarakat.</p>
            <div class="page-hero-divider"></div>
            
            <div class="page-breadcrumbs">
                <a href="{{ route('home') }}"><i class="fas fa-home me-1"></i>Home</a>
                <span class="sep">/</span>
                <span>Profil Desa</span>
                <span class="sep">/</span>
                <span class="current">Pemerintah Desa</span>
            </div>
        </div>
    </section>

    {{-- 2. Modern Executive Grid --}}
    <section class="profile-content-section">
        <div class="profile-content-container">

            <div class="gov-grid-modern">
                @forelse ($pemerintahs as $pemerintah)
                    <div class="gov-card-modern">
                        <div class="gov-avatar-frame">
                            @if ($pemerintah->foto)
                                <img src="{{ asset($pemerintah->foto) }}" 
                                     alt="{{ $pemerintah->nama }}" 
                                     class="gov-avatar-img"
                                     loading="lazy">
                            @else
                                <img src="{{ asset('assets/img/default-avatar.png') }}" 
                                     alt="Default Aparatur" 
                                     class="gov-avatar-img"
                                     loading="lazy">
                            @endif
                            <div class="gov-verified-badge" title="Aparatur Terverifikasi">
                                <i class="fas fa-check"></i>
                            </div>
                        </div>

                        <h3 class="gov-name-modern">{{ $pemerintah->nama }}</h3>
                        
                        <div class="gov-role-pill">
                            <i class="fas fa-user-shield"></i>
                            <span>{{ $pemerintah->jabatan }}</span>
                        </div>

                        <p class="gov-tupoksi-excerpt">
                            {{ \Illuminate\Support\Str::limit(strip_tags($pemerintah->tupoksi), 130, '...') }}
                        </p>

                        <a href="{{ route('pemerintah-detail', $pemerintah->id) }}" class="gov-btn-detail">
                            <span>Lihat Profil Lengkap</span>
                            <i class="fas fa-arrow-right"></i>
                        </a>
                    </div>
                @empty
                    <div class="card p-5 text-center shadow-sm border-0 rounded-4 w-100">
                        <i class="fas fa-user-friends text-muted mb-3" style="font-size: 3rem; opacity: 0.35;"></i>
                        <h4 class="text-muted fw-bold">Data Aparatur Belum Tersedia</h4>
                        <p class="text-secondary small mb-0">Informasi susunan organisasi dan tata kerja pemerintah desa sedang diperbarui.</p>
                    </div>
                @endforelse
            </div>

        </div>
    </section>

@endsection
