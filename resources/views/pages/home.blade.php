@extends('layouts.user')

@section('title', 'Beranda | Sistem Informasi Desa')

@section('content')

    <section id="home-page" class="page-section active">
        @php
            $setting = \App\Models\Setting::first();
            $kades = $kades ?? \App\Models\PemerintahDesa::where('jabatan', 'Kepala Desa')
                ->orWhere('jabatan', 'like', '%Kepala Desa%')
                ->first();
            $desaName = (!empty($setting?->nama_desa)) ? $setting->nama_desa : 'Rante Gola';
            $hasKades = !empty($kades);
            $kadesName = $hasKades ? $kades->nama : 'Pemerintah Desa';
            $kadesRole = $hasKades ? $kades->jabatan : ('Pimpinan Desa ' . $desaName);
            $kadesFoto = ($hasKades && $kades->foto && file_exists(public_path($kades->foto))) 
                ? asset($kades->foto) 
                : asset('assets/img/kades_transparent.png');
        @endphp

        <div class="hero-galesong">
            <div class="hero-galesong-overlay"></div>
            <div class="container hero-galesong-container">
                <div class="hero-galesong-left">
                    <div class="hero-galesong-kicker">
                        <span class="kicker-profil">PROFIL DIGITAL</span>
                        <span class="kicker-dot">•</span>
                        <span class="kicker-desa">DESA {{ strtoupper($desaName) }}</span>
                    </div>

                    <h1 class="hero-galesong-title">
                        Selamat datang di <br>
                        <span class="hero-galesong-highlight">{{ $desaName }}</span>
                    </h1>

                    <p class="hero-galesong-quote">
                        "Komitmen kami menghadirkan keterbukaan informasi dan pelayanan publik yang cepat, mudah, serta terpercaya demi kemajuan dan kesejahteraan seluruh masyarakat Desa {{ $desaName }}."
                    </p>

                    <div class="hero-galesong-author">
                        <span class="galesong-author-bar">|</span>
                        <span class="galesong-author-name">— {{ $hasKades ? $kadesName : ('Pemerintah Desa ' . $desaName) }}</span>
                    </div>

                    <div class="hero-galesong-actions">
                        <a href="{{ route('pengajuan.login-form') }}" class="btn-galesong-action btn-galesong-primary">
                            <i class="fas fa-envelope-open-text"></i>
                            <span>Pengajuan Surat</span>
                        </a>
                        <a href="{{ route('pengaduan.login-form') }}" class="btn-galesong-action btn-galesong-outline">
                            <i class="fas fa-comment-dots"></i>
                            <span>Pengaduan Warga</span>
                        </a>
                        <a href="{{ url('/kategori') }}" class="btn-galesong-action btn-galesong-ghost">
                            <i class="fas fa-newspaper"></i>
                            <span>Kabar Desa</span>
                        </a>
                    </div>
                </div>

                <div class="hero-galesong-right">
                    <div class="kades-showcase">
                        <div class="kades-aura-glow"></div>
                        <img src="{{ $kadesFoto }}" alt="{{ $kadesName }}" class="kades-showcase-img">
                        <div class="kades-signature-tag">
                            <div class="kades-tag-name">{{ $kadesName }}</div>
                            <div class="kades-tag-role">{{ $kadesRole }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="container main-content-container">
            <div class="section-intro">
                <div class="section-badge-tag">Pusat Layanan & Kabar Desa</div>
                <h2 class="section-title-modern">Informasi Terkini & Aparatur Desa</h2>
                <p class="section-desc-modern">Akses cepat berita terhangat, agenda program desa, dan kepemimpinan pemerintah desa.</p>
            </div>

            <div class="quick-info-grid">

                {{-- Card 1: Latest News --}}
                <div class="card info-card card-news">
                    <div class="card-header-clean">
                        <div class="card-icon-badge bg-icon-emerald">
                            <i class="fas fa-newspaper"></i>
                        </div>
                        <div class="card-header-text">
                            <h3>Berita Terkini</h3>
                            <span>Publikasi kabar pembangunan</span>
                        </div>
                    </div>

                    <div class="news-list">
                        @forelse ($berita as $b)
                            <div class="article" onclick="navigate('news-detail', {id: 1})">
                                <div class="article-thumb-wrapper">
                                    <img src="{{ asset($b->gambar) }}" alt="{{ $b->judul }}" class="article-thumb">
                                </div>
                                <div class="article-info-wrapper">
                                    <h4>{{ $b->judul }}</h4>
                                    <span class="article-date">
                                        <i class="far fa-calendar-alt"></i>
                                        {{ optional($b->created_at)->translatedFormat('d M Y') }}
                                    </span>
                                </div>
                            </div>
                        @empty
                            <div class="empty-state-card">
                                <i class="far fa-newspaper"></i>
                                <p>Belum ada berita terbaru dipublikasikan.</p>
                            </div>
                        @endforelse
                    </div>

                    <a href="{{ url('/kategori') }}" class="btn-card-action">
                        <span>Lihat Semua Berita</span>
                        <i class="fas fa-arrow-right"></i>
                    </a>
                </div>

                {{-- Card 2: Upcoming Activities --}}
                <div class="card info-card card-agenda">
                    <div class="card-header-clean">
                        <div class="card-icon-badge bg-icon-teal">
                            <i class="fas fa-calendar-check"></i>
                        </div>
                        <div class="card-header-text">
                            <h3>Agenda Kegiatan</h3>
                            <span>Jadwal program & musyawarah</span>
                        </div>
                    </div>

                    <ul class="activity-list">
                        @forelse ($agenda as $g)
                            @php
                                $eventDate = \Carbon\Carbon::parse($g->waktu_pelaksanaan);
                            @endphp
                            <li class="activity-item">
                                <div class="activity-date-chip">
                                    <span class="chip-day">{{ $eventDate->format('d') }}</span>
                                    <span class="chip-month">{{ $eventDate->format('M') }}</span>
                                </div>
                                <div class="activity-details">
                                    <h4 class="activity-title">{{ $g->nama_kegiatan }}</h4>
                                    <span class="activity-time">
                                        <i class="far fa-clock"></i>
                                        {{ $eventDate->format('d M Y') }}
                                    </span>
                                </div>
                            </li>
                        @empty
                            <li class="empty-state-card">
                                <i class="far fa-calendar-times"></i>
                                <p>Belum ada jadwal agenda dalam waktu dekat.</p>
                            </li>
                        @endforelse
                    </ul>

                    <a href="{{ url('/agenda') }}" class="btn-card-action">
                        <span>Lihat Semua Agenda</span>
                        <i class="fas fa-arrow-right"></i>
                    </a>
                </div>

                {{-- Card 3: Village Government --}}
                @forelse ($pemerintah as $p)
                    <div class="card info-card village-head-card">
                        <div class="card-header-clean">
                            <div class="card-icon-badge bg-icon-forest">
                                <i class="fas fa-user-tie"></i>
                            </div>
                            <div class="card-header-text">
                                <h3>Pemerintah Desa</h3>
                                <span>Pimpinan & aparatur desa</span>
                            </div>
                        </div>

                        <div class="village-content">
                            <div class="village-avatar-container">
                                @if($p->foto)
                                    <img src="{{ asset($p->foto) }}" class="village-avatar" alt="{{ $p->nama }}">
                                @else
                                    <img src="{{ asset('assets/img/default-avatar.png') }}" class="village-avatar" alt="{{ $p->nama }}">
                                @endif
                                <span class="village-verified" title="Aparatur Desa Terverifikasi"><i class="fas fa-check"></i></span>
                            </div>

                            <h4 class="village-name">{{ $p->nama }}</h4>

                            <div class="village-position-tag">
                                <i class="fas fa-id-badge"></i>
                                <span>{{ $p->jabatan }}</span>
                            </div>

                            <p class="duties">
                                {{ \Illuminate\Support\Str::limit(strip_tags($p->tupoksi), 85, '...') }}
                            </p>

                            <div class="quote-card">
                                <i class="fas fa-quote-left quote-mark"></i>
                                <p class="quote-text">"Melayani warga masyarakat dengan sepenuh hati, integritas, dan keterbukaan."</p>
                            </div>
                        </div>

                        <a href="{{ url('/pemerintah') }}" class="btn-card-action">
                            <span>Lihat Aparatur Desa</span>
                            <i class="fas fa-arrow-right"></i>
                        </a>
                    </div>
                @empty
                    <div class="card info-card village-head-card">
                        <div class="card-header-clean">
                            <div class="card-icon-badge bg-icon-forest">
                                <i class="fas fa-user-tie"></i>
                            </div>
                            <div class="card-header-text">
                                <h3>Pemerintah Desa</h3>
                                <span>Pimpinan & aparatur desa</span>
                            </div>
                        </div>
                        <div class="village-content">
                            <div class="empty-state-card">
                                <i class="fas fa-user-friends"></i>
                                <p>Data pimpinan desa belum diperbarui.</p>
                            </div>
                        </div>
                        <a href="{{ url('/pemerintah') }}" class="btn-card-action">
                            <span>Lihat Aparatur Desa</span>
                            <i class="fas fa-arrow-right"></i>
                        </a>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    <section id="news-page" class="page-section">
        <div class="container">
            <h2><i class="fas fa-bullhorn"></i> Berita Desa Terbaru</h2>

            <div class="filter-bar">
                <div class="search-bar">
                    <input type="text" placeholder="Search news by title...">
                </div>
                <div class="filter-category">
                    <select>
                        <option value="">All Categories</option>
                        <option value="pembangunan">Pembangunan</option>
                        <option value="sosial">Sosial & Budaya</option>
                        <option value="ekonomi">Ekonomi</option>
                    </select>
                </div>
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
                        <p>Warga antusias mengikuti pelatihan pemasaran digital untuk meningkatkan omzet usaha mikro
                            mereka...</p>
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

    <section id="news-detail-page" class="page-section">
        <div class="container">
            <button onclick="navigate('news')" class="btn btn-secondary" style="margin-bottom: 20px;"><i
                    class="fas fa-arrow-left"></i> Back to News</button>
            <div class="card">
                <img id="news-detail-image" src="https://picsum.photos/800/400?random=1" alt="News Detail Image">
                <span id="news-detail-category" class="category" style="margin-bottom: 10px;"></span>
                <h1 id="news-detail-title">Sample News Title</h1>
                <p class="meta"><i class="fas fa-calendar-alt"></i> <span id="news-detail-date">Date</span> | <i
                        class="fas fa-user"></i> <span id="news-detail-author">Admin Desa</span></p>
                <div id="news-detail-content">
                    <p>This is the full content of the news article. Lorem ipsum dolor sit amet, consectetur adipiscing
                        elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                        quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure
                        dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>
                    <p>Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est
                        laborum. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt
                        ut labore et dolore magna aliqua.</p>
                    <p>Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla
                        pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit
                        anim id est laborum.</p>
                </div>
            </div>
        </div>
    </section>

    <section id="agenda-page" class="page-section">
        <div class="container">
            <h2><i class="fas fa-calendar-alt"></i> Agenda & Kegiatan Desa</h2>
            <div class="card" style="padding: 15px; text-align: right;">
                <a href="#" class="btn btn-primary"><i class="fas fa-calendar"></i> Calendar View (Optional)</a>
            </div>

            <ul class="agenda-list">
                <li>
                    <div class="icon"><i class="fas fa-handshake"></i></div>
                    <div class="details">
                        <h4>Rapat Persiapan HUT Desa ke-77</h4>
                        <span><i class="fas fa-clock"></i> Sunday, 2 Nov 2025 | 09:00 - 12:00 WIB</span>
                    </div>
                </li>
                <li>
                    <div class="icon"><i class="fas fa-hammer"></i></div>
                    <div class="details">
                        <h4>Gotong Royong Perbaikan Drainase RW 03</h4>
                        <span><i class="fas fa-clock"></i> Friday, 15 Nov 2025 | 07:00 - 10:00 WIB</span>
                    </div>
                </li>
                <li>
                    <div class="icon"><i class="fas fa-lightbulb"></i></div>
                    <div class="details">
                        <h4>Penyuluhan Kesehatan Ibu dan Anak (KIA)</h4>
                        <span><i class="fas fa-clock"></i> Wednesday, 20 Nov 2025 | 14:00 - 16:00 WIB</span>
                    </div>
                </li>
                <li>
                    <div class="icon"><i class="fas fa-tree"></i></div>
                    <div class="details">
                        <h4>Penanaman Pohon di Area Lahan Desa</h4>
                        <span><i class="fas fa-clock"></i> Saturday, 30 Nov 2025 | 08:00 - 11:00 WIB</span>
                    </div>
                </li>
            </ul>
        </div>
    </section>

    <section id="gallery-page" class="page-section">
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

    <section id="government-page" class="page-section">
        <div class="container">
            <h2><i class="fas fa-users"></i> Struktur Pemerintahan Desa</h2>
            <div class="gov-grid">
                <div class="card official-card">
                    <img src="https://picsum.photos/200/200?random=12" alt="Official Photo">
                    <h4>Dr. Ir. Budi Santoso</h4>
                    <p class="position">Kepala Desa</p>
                    <p class="duties">Bertanggung jawab atas penyelenggaraan pemerintahan, pembangunan, dan pelayanan
                        masyarakat desa.</p>
                </div>
                <div class="card official-card">
                    <img src="https://picsum.photos/200/200?random=13" alt="Official Photo">
                    <h4>Siti Nurjanah, S.E.</h4>
                    <p class="position">Sekretaris Desa</p>
                    <p class="duties">Membantu Kepala Desa dalam bidang administrasi dan memberikan pelayanan teknis
                        administrasi.</p>
                </div>
                <div class="card official-card">
                    <img src="https://picsum.photos/200/200?random=14" alt="Official Photo">
                    <h4>Ahmad Zaki</h4>
                    <p class="position">Kepala Urusan Keuangan</p>
                    <p class="duties">Melaksanakan pengelolaan administrasi keuangan desa, termasuk penerimaan dan
                        pengeluaran.</p>
                </div>
                <div class="card official-card">
                    <img src="https://picsum.photos/200/200?random=15" alt="Official Photo">
                    <h4>Dewi Lestari</h4>
                    <p class="position">Kepala Seksi Pemerintahan</p>
                    <p class="duties">Membantu Kades dalam pelaksanaan urusan tata praja, pertanahan, dan kependudukan.</p>
                </div>
            </div>
        </div>
    </section>

    <section id="complaints-page" class="page-section">
        <div class="container">
            <h2><i class="fas fa-comment-dots"></i> Sistem Pengaduan Masyarakat</h2>

            <div class="card" style="padding: 30px;">
                <h3>Submit New Complaint</h3>
                <form id="complaint-form">
                    <div class="form-group">
                        <label for="comp-title">Title</label>
                        <input type="text" id="comp-title" required>
                    </div>
                    <div class="form-group">
                        <label for="comp-category">Category</label>
                        <select id="comp-category" required>
                            <option value="">Select Category</option>
                            <option value="pelayanan">Service</option>
                            <option value="infrastruktur">Infrastucture</option>
                            <option value="apbdes">APBDes</option>
                            <option value="lainnya">Other</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="comp-desc">Description</label>
                        <textarea id="comp-desc" rows="5" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="comp-image">Upload Image (Optional)</label>
                        <input type="file" id="comp-image" accept="image/*">
                    </div>
                    <div class="form-group">
                        <label for="comp-file">Upload File (Optional)</label>
                        <input type="file" id="comp-file">
                    </div>
                    <div class="form-group checkbox-group">
                        <input type="checkbox" id="comp-anon">
                        <label for="comp-anon" style="margin-bottom: 0;">Submit as Anonymous</label>
                    </div>
                    <button type="submit" class="btn btn-primary" style="width: 100%; margin-top: 15px;">Submit
                        Complaint</button>
                </form>
            </div>

            <h3 style="margin-top: 40px;">Your Previous Complaints</h3>
            <div class="complaint-history">
                <div class="card" onclick="showComplaintDetail(1)">
                    <div>
                        <h4>Lampu Jalan Mati di Depan Balai Desa</h4>
                        <span style="font-size: 0.9rem; color: var(--color-text-light);">Submitted: 15 Oct 2025</span>
                    </div>
                    <span class="status-badge status-completed">Completed</span>
                </div>
                <div class="card" onclick="showComplaintDetail(2)">
                    <div>
                        <h4>Respon Lambat Permintaan Surat Pengantar</h4>
                        <span style="font-size: 0.9rem; color: var(--color-text-light);">Submitted: 20 Oct 2025</span>
                    </div>
                    <span class="status-badge status-in-process">In Process</span>
                </div>
                <div class="card" onclick="showComplaintDetail(3)">
                    <div>
                        <h4>Usulan Penolakan Pembangunan Posyandu</h4>
                        <span style="font-size: 0.9rem; color: var(--color-text-light);">Submitted: 28 Oct 2025</span>
                    </div>
                    <span class="status-badge status-rejected">Rejected</span>
                </div>
            </div>
        </div>
    </section>

    <section id="complaint-detail-page" class="page-section">
        <div class="container">
            <button onclick="navigate('complaints')" class="btn btn-secondary" style="margin-bottom: 20px;"><i
                    class="fas fa-arrow-left"></i> Back to History</button>
            <div class="card" style="padding: 30px;">
                <span id="comp-detail-status" class="status-badge status-completed" style="float: right;">Status</span>
                <h2 id="comp-detail-title" style="border-bottom: none; margin-bottom: 5px;">Complaint Title</h2>
                <p style="color: var(--color-text-light); margin-bottom: 20px;">Category: <strong
                        id="comp-detail-category">Category</strong> | Submitted: <span id="comp-detail-date">Date</span></p>

                <h3>Description:</h3>
                <p id="comp-detail-desc"
                    style="margin-bottom: 30px; border-left: 3px solid var(--color-primary); padding-left: 15px; font-style: italic;">
                </p>

                <h3>Attachments:</h3>
                <ul id="comp-detail-attachments" style="list-style: none; padding: 0;">
                </ul>
            </div>
        </div>
    </section>

    <section id="services-page" class="page-section">
        <div class="container">
            <h2><i class="fas fa-file-alt"></i> Layanan Surat Desa</h2>

            <p style="margin-bottom: 30px;">Choose the type of letter you need to apply for:</p>

            <div class="service-menu-grid">
                <div class="card service-card" onclick="showServiceForm('usaha')">
                    <i class="fas fa-store"></i>
                    <h4>Surat Keterangan Usaha (SKU)</h4>
                </div>
                <div class="card service-card" onclick="showServiceForm('domisili')">
                    <i class="fas fa-map-marker-alt"></i>
                    <h4>Surat Keterangan Domisili</h4>
                </div>
                <div class="card service-card" onclick="showServiceForm('izin_acara')">
                    <i class="fas fa-calendar-day"></i>
                    <h4>Surat Izin Acara/Keramaian</h4>
                </div>
                <div class="card service-card" onclick="showServiceForm('pengantar')">
                    <i class="fas fa-envelope-open-text"></i>
                    <h4>Surat Pengantar Umum</h4>
                </div>
                <div class="card service-card" onclick="showServiceForm('sktm')">
                    <i class="fas fa-hand-holding-usd"></i>
                    <h4>SKTM (Poverty Cert.)</h4>
                </div>
            </div>

            <div id="service-form-container" class="card" style="margin-top: 40px; display: none; padding: 30px;">
                <h3 id="service-form-title"></h3>
                <form id="dynamic-service-form">
                    <button type="submit" class="btn btn-primary" style="width: 100%; margin-top: 20px;">Submit
                        Request</button>
                </form>
            </div>

            <h3 style="margin-top: 40px;">Letter Request History</h3>
            <div class="card" style="overflow-x: auto;">
                <table style="width: 100%; border-collapse: collapse; text-align: left;">
                    <thead>
                        <tr style="background-color: var(--color-secondary);">
                            <th style="padding: 10px; border-radius: 8px 0 0 0;">Type</th>
                            <th style="padding: 10px;">Submission Date</th>
                            <th style="padding: 10px; border-radius: 0 8px 0 0;">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr style="border-bottom: 1px solid #eee;">
                            <td style="padding: 10px;">Surat Keterangan Usaha</td>
                            <td style="padding: 10px;">28 Oct 2025</td>
                            <td style="padding: 10px;"><span class="status-badge status-completed">Ready to Take</span></td>
                        </tr>
                        <tr style="border-bottom: 1px solid #eee;">
                            <td style="padding: 10px;">Surat Domisili</td>
                            <td style="padding: 10px;">2 Nov 2025</td>
                            <td style="padding: 10px;"><span class="status-badge status-in-process">In Process</span></td>
                        </tr>
                        <tr>
                            <td style="padding: 10px;">SKTM</td>
                            <td style="padding: 10px;">1 Nov 2025</td>
                            <td style="padding: 10px;"><span class="status-badge status-rejected">Missing Docs</span></td>
                        </tr>
                    </tbody>
                </table>
            </div>

        </div>
    </section>

    <section id="profile-page" class="page-section">
        <div class="container">
            <h2><i class="fas fa-user-circle"></i> User Profile</h2>

            <div class="card profile-layout">
                <div class="profile-avatar">
                    <img src="https://picsum.photos/200/200?random=16" alt="User Avatar">
                    <h4>Jane Doe</h4>
                    <p style="font-size: 0.9rem; color: var(--color-primary);">Warga Desa</p>
                </div>

                <div class="profile-details">
                    <h3>Personal Information</h3>
                    <p><strong>Name:</strong> Jane Doe</p>
                    <p><strong>NIK:</strong> 3516109988770001</p>
                    <p><strong>Email:</strong> jane.doe@example.com</p>
                    <p><strong>Phone:</strong> +62 812-3456-7890</p>
                    <p><strong>Address:</strong> RT 001/RW 002, Jl. Kenanga No. 10</p>

                    <h3 style="margin-top: 20px;">Short Bio</h3>
                    <p style="border-bottom: none; color: var(--color-text-light); font-style: italic;">Aktif di kegiatan
                        kepemudaan desa dan memiliki usaha mikro di bidang kuliner.</p>

                    <div class="profile-buttons">
                        <a href="#" class="btn btn-primary"><i class="fas fa-edit"></i> Edit Profile</a>
                        <a href="#" class="btn btn-secondary"><i class="fas fa-key"></i> Change Password</a>
                        <a href="#" data-page="complaints" class="btn btn-secondary"><i class="fas fa-history"></i> View
                            Complaint History</a>
                        <a href="#" data-page="services" class="btn btn-secondary"><i class="fas fa-envelope"></i> View
                            Letter Requests</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="login-page" class="page-section auth-page">
        <div class="card auth-container">
            <div class="logo" style="justify-content: center;"><i class="fas fa-leaf"></i> DESA DIGITAL</div>
            <h2>Login to Account</h2>
            <form>
                <div class="form-group">
                    <label for="login-email">Email or NIK</label>
                    <input type="text" id="login-email" placeholder="Enter your email or NIK" required>
                </div>
                <div class="form-group">
                    <label for="login-password">Password</label>
                    <input type="password" id="login-password" placeholder="Enter your password" required>
                </div>
                <button type="submit" class="btn btn-primary" style="width: 100%; margin-top: 10px;">Login</button>
                <p style="margin-top: 20px; font-size: 0.9rem;">Don't have an account? <a href="#"
                        onclick="navigate('register')">Register here</a></p>
            </form>
        </div>
    </section>

    <section id="register-page" class="page-section auth-page">
        <div class="card auth-container">
            <div class="logo" style="justify-content: center;"><i class="fas fa-leaf"></i> DESA DIGITAL</div>
            <h2>Create New Account</h2>
            <form>
                <div class="form-group">
                    <label for="reg-name">Full Name</label>
                    <input type="text" id="reg-name" required>
                </div>
                <div class="form-group">
                    <label for="reg-nik">NIK (ID Number)</label>
                    <input type="text" id="reg-nik" required>
                </div>
                <div class="form-group">
                    <label for="reg-email">Email</label>
                    <input type="email" id="reg-email" required>
                </div>
                <div class="form-group">
                    <label for="reg-password">Password</label>
                    <input type="password" id="reg-password" required>
                </div>
                <div class="form-group">
                    <label for="reg-confirm-password">Confirm Password</label>
                    <input type="password" id="reg-confirm-password" required>
                </div>
                <button type="submit" class="btn btn-primary" style="width: 100%; margin-top: 10px;">Register</button>
                <p style="margin-top: 20px; font-size: 0.9rem;">Already have an account? <a href="#"
                        onclick="navigate('login')">Login here</a></p>
            </form>
        </div>
    </section>
@endsection