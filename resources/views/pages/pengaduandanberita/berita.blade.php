@extends('layouts.user')

@section('title', 'Berita Desa | Sistem Informasi Desa')

@section('content')

    <section>
            <div class="container">
                <h2><i class="fas fa-bullhorn"></i> Berita Desa Terbaru</h2>
                
                <div class="filter-bar">
                    <div class="search-bar">
                        <input type="text" placeholder="Search news by title...">
                    </div>
                    <!-- <div class="filter-category">
                        <select>
                            <option value="">All Categories</option>
                            <option value="pembangunan">Pembangunan</option>
                            <option value="sosial">Sosial & Budaya</option>
                            <option value="ekonomi">Ekonomi</option>
                        </select>
                    </div> -->
                </div>

                <div class="news-grid">
                    <div class="card news-item" onclick="navigate('news-detail', {id: 1})">
                        <img src="https://picsum.photos/400/200?random=6" alt="News Image">
                        <div class="content">
                            <span class="category">Pembangunan</span>
                            <h4>Pembangunan Infrastruktur Tahap Akhir Selesai Tepat Waktu</h4>
                            <p>Proyek pembangunan jalan desa sepanjang 5 km telah selesai dan diresmikan oleh Kepala Desa...</p>
                            <span><i class="fas fa-calendar-alt"></i> 25 Okt 2025</span>
                        </div>
                    </div>
                    <div class="card news-item" onclick="navigate('news-detail', {id: 2})">
                        <img src="https://picsum.photos/400/200?random=7" alt="News Image">
                        <div class="content">
                            <span class="category">Ekonomi</span>
                            <h4>Pelatihan UMKM Digital Angkatan Ke-3 Dibuka</h4>
                            <p>Warga antusias mengikuti pelatihan pemasaran digital untuk meningkatkan omzet usaha mikro mereka...</p>
                            <span><i class="fas fa-calendar-alt"></i> 18 Okt 2025</span>
                        </div>
                    </div>
                    <div class="card news-item" onclick="navigate('news-detail', {id: 3})">
                        <img src="https://picsum.photos/400/200?random=8" alt="News Image">
                        <div class="content">
                            <span class="category">Sosial</span>
                            <h4>Pencegahan Demam Berdarah dengan Gerakan 3M Plus</h4>
                            <p>Pemerintah desa gencar melakukan sosialisasi dan fogging di daerah rawan...</p>
                            <span><i class="fas fa-calendar-alt"></i> 10 Okt 2025</span>
                        </div>
                    </div>
                    </div>
            </div>
        </section>

@endsection