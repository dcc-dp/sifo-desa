@extends('layouts.user')

@section('title', 'Pemerintah | Sistem Informasi Desa')

@section('content')

    <section>
        <div class="container">
            <h2><i class="fas fa-users"></i> Struktur Pemerintahan Desa</h2>
            <div class="gov-grid">
                @foreach ($pemerintahs as $pemerintah)
                <div class="card official-card">
                    @if($pemerintah->foto)
                        <img src="{{ asset($pemerintah->foto) }}" class="img-fluid w-100" alt="{{ $pemerintah->nama }}">
                    @else
                        <img src="{{ asset('/upload/pemerintah/default.jpg') }}" class="img-fluid w-100" alt="Default pemerintah" style="height: px; object-fit: cover;">
                    @endif
                    <h4>{{ $pemerintah->nama }}</h4>
                    <p class="position">{{ $pemerintah->jabatan }}</p>
                    <p class="duties">{{ $pemerintah->tupoksi }}</p>
                </div>
                @endforeach
            </div>
        </div>
    </section>

@endsection