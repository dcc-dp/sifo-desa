@extends('layouts.user')

@section('title', 'Pemerintah | Sistem Informasi Desa')

@section('content')

    <section>
        <div class="container py-3">
            <h2><i class="fas fa-users"></i> Struktur Pemerintahan Desa</h2>
            <div class="gov-grid">
                @foreach ($pemerintahs as $pemerintah)
                    <a href="{{ url('/pemerintah' . $pemerintah->id) }}" class="text-decoration-none text-dark">
                        <div class="card official-card">
                            @if ($pemerintah->foto)
                                <img src="{{ asset($pemerintah->foto) }}" class="rounded-circle mx-auto d-block"
                                    style="width:220px; height:220px; object-fit:cover;" alt="{{ $pemerintah->nama }}">
                            @else
                                <img src="{{ asset('/upload/pemerintah/default.jpg') }}"
                                    class="img-fluid w-100 rounded-circle" alt="Default pemerintah"
                                    style="object-fit: cover; aspect-ratio: 1/1;">
                            @endif
                            <h4>{{ $pemerintah->nama }}</h4>
                            <p class="position">{{ $pemerintah->jabatan }}</p>
                            <p class="duties">
                                {{ \Illuminate\Support\Str::limit(strip_tags($pemerintah->tupoksi), 120, '...') }}
                            </p>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </section>

@endsection
