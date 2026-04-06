@extends('layouts.user')

@section('title', 'Sejarah | Sistem Informasi Desa')

@section('content')

<section>
    <div class="container">

        <div class="section-header">
            <h2 class="section-title">
                <i class="fas fa-landmark"></i> Sejarah Desa
            </h2>
            <p class="section-subtitle">
                Mengenal lebih dekat asal-usul dan perkembangan Desa Kami
            </p>
        </div>

        <div class="card" style="margin-bottom: 30px;">
            <div class="card-body">
                <h3 class="card-title" style="text-align: center; margin-bottom: 25px;">
                    Perjalanan Sejarah Desa
                </h3>

                <div class="timeline">
                    @forelse ($sejarahs as $item)
                        <div class="timeline-item">
                            <div class="timeline-marker">
                                <i class="fas fa-landmark"></i>
                            </div>

                            <div class="timeline-content">
                                <h4>{{ $item->judul }}</h4>

                                @if($item->gambar)
                                    <div style="display:flex; justify-content:center; margin-bottom:15px;">
                                        <img src="{{ asset($item->gambar) }}"
                                             style="width:360px; max-width:100%; border-radius:10px;">
                                    </div>
                                @endif

                                <p>{{ $item->deskripsi }}</p>
                            </div>
                        </div>
                    @empty
                        <p style="text-align:center;">Data sejarah belum tersedia.</p>
                    @endforelse
                </div>
            </div>
        </div>

        <div class="card" style="margin-top: 30px;">
            <div class="card-body">
                <h3 class="card-title" style="text-align: center; margin-bottom: 25px;">
                    Warisan Budaya
                </h3>

                <div class="heritage-grid">

                    <div class="heritage-item">
                        <div class="heritage-icon">
                            <img src="{{ asset('upload/berita/tari.jpg') }}"
                                 style="width:100px; height:100px; object-fit:cover; border-radius:50%;">
                        </div>
                        <h4>Tari Tradisional</h4>
                        <p>Tari "Lenggang Nusantara" yang diwariskan turun-temurun sejak abad ke-19.</p>
                    </div>

                    <div class="heritage-item">
                        <div class="heritage-icon">
                            <img src="{{ asset('upload/berita/nasi.jpg') }}"
                                 style="width:100px; height:100px; object-fit:cover; border-radius:50%;">
                        </div>
                        <h4>Kuliner Khas</h4>
                        <p>Nasi "Jangkrik" dengan bumbu rahasia yang hanya ditemukan di Desa Kami.</p>
                    </div>

                    <div class="heritage-item">
                        <div class="heritage-icon">
                            <img src="{{ asset('upload/berita/rumah.jpg') }}"
                                 style="width:100px; height:100px; object-fit:cover; border-radius:50%;">
                        </div>
                        <h4>Bangunan Bersejarah</h4>
                        <p>Rumah adat "Joglo Tua" yang masih terpelihara dengan baik sejak 1890.</p>
                    </div>

                    <div class="heritage-item">
                        <div class="heritage-icon">
                            <img src="{{ asset('upload/berita/festival.jpg') }}"
                                 style="width:100px; height:100px; object-fit:cover; border-radius:50%;">
                        </div>
                        <h4>Festival Tahunan</h4>
                        <p>"Sedekah Bumi" yang digelar setiap tahun sebagai wujud syukur atas hasil panen.</p>
                    </div>

                </div>
            </div>
        </div>

    </div>
</section>

<style>
.section-subtitle {
    text-align: center;
    color: #6c757d;
    margin-bottom: 40px;
    font-size: 1.1rem;
    max-width: 700px;
    margin-left: auto;
    margin-right: auto;
}

/* Timeline */
.timeline {
    position: relative;
    max-width: 800px;
    margin: 0 auto;
}

.timeline::before {
    content: '';
    position: absolute;
    left: 30px;
    top: 0;
    bottom: 0;
    width: 4px;
    background-color: #4e73df;
    border-radius: 2px;
}

.timeline-item {
    display: flex;
    margin-bottom: 30px;
    position: relative;
}

.timeline-marker {
    width: 60px;
    height: 60px;
    border-radius: 50%;
    background-color: #4e73df;
    color: white;
    display: flex;
    align-items: center;
    justify-content: center;
    z-index: 1;
    flex-shrink: 0;
    margin-right: 20px;
}

.timeline-content {
    flex: 1;
    background-color: #f8f9fc;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 4px 10px rgba(0,0,0,0.05);
}

.timeline-content h4 {
    color: #4e73df;
    margin-bottom: 15px;
}

/* Heritage */
.heritage-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 20px;
}

.heritage-item {
    text-align: center;
    padding: 20px 15px;
    background-color: #f8f9fc;
    border-radius: 10px;
    transition: 0.3s;
}

.heritage-item:hover {
    transform: translateY(-5px);
}

.heritage-item h4 {
    color: #4e73df;
    margin-top: 15px;
    margin-bottom: 10px;
}

@media (max-width: 768px) {
    .timeline::before {
        left: 25px;
    }

    .timeline-marker {
        width: 50px;
        height: 50px;
        margin-right: 15px;
    }
}
</style>

@endsection