@extends('layouts.user')

@section('title', 'Agenda & Kegiatan Desa | Sistem Informasi Desa')

@section('content')

    @php
        $setting = \App\Models\Setting::first();
        $desaName = (!empty($setting?->nama_desa)) ? $setting->nama_desa : 'Rante Gola';
    @endphp

    {{-- 1. Standard Page Hero Header --}}
    <section class="page-hero-header">
        <div class="container">
            <div class="page-hero-eyebrow">
                <i class="fas fa-calendar-check"></i>
                <span>Jadwal & Agenda Desa</span>
            </div>
            <h1 class="page-hero-title">Agenda & Kegiatan Masyarakat</h1>
            <p class="page-hero-desc">Informasi jadwal musyawarah desa, program pembangunan, bakti sosial, dan agenda kemasyarakatan Desa {{ $desaName }}.</p>
            <div class="page-hero-divider"></div>
            
            <div class="page-breadcrumbs">
                <a href="{{ route('home') }}"><i class="fas fa-home me-1"></i>Home</a>
                <span class="sep">/</span>
                <span>Berita & Agenda</span>
                <span class="sep">/</span>
                <span class="current">Agenda Kegiatan</span>
            </div>
        </div>
    </section>

    {{-- 2. Modern Agenda Cards Grid --}}
    <section class="profile-content-section">
        <div class="profile-content-container">

            <div class="d-flex align-items-center justify-content-between flex-wrap gap-3 mb-4 pb-2 border-bottom">
                <div class="d-flex align-items-center gap-2">
                    <span class="badge bg-success-subtle text-success-emphasis px-3 py-2 rounded-pill fw-semibold border border-success-subtle">
                        <i class="fas fa-calendar-alt me-1"></i> {{ $agendas->count() }} Agenda Terjadwal
                    </span>
                </div>

                <a href="{{ route('home') }}" class="btn btn-outline-secondary btn-sm px-3 py-2 rounded-pill fw-semibold">
                    <i class="fas fa-home me-2"></i>Home
                </a>
            </div>

            <div class="agenda-grid-modern">
                @forelse ($agendas as $agenda)
                    <div class="agenda-card-modern">
                        <div class="agenda-calendar-box">
                            <i class="far fa-calendar-alt"></i>
                        </div>

                        <div class="agenda-card-info">
                            <h3 class="agenda-card-title">{{ $agenda->nama_kegiatan }}</h3>
                            
                            <div class="agenda-time-pill">
                                <i class="far fa-clock text-success"></i>
                                <span>{{ $agenda->waktu_pelaksanaan }}</span>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="card p-5 text-center shadow-sm border-0 rounded-4 w-100">
                        <i class="far fa-calendar-times text-muted mb-3" style="font-size: 3rem; opacity: 0.35;"></i>
                        <h4 class="text-muted fw-bold">Belum Ada Agenda Kegiatan</h4>
                        <p class="text-secondary small mb-0">Saat ini belum ada jadwal agenda atau kegiatan baru yang dicatat.</p>
                    </div>
                @endforelse
            </div>

        </div>
    </section>

@endsection