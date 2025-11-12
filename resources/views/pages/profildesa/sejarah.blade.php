@extends('layouts.user')

@section('title', 'Sejarah | Sistem Informasi Desa')

@section('content')

    <section>
        <div class="container">
            <!-- Page Header -->
            <div class="section-header">
                <h2 class="section-title"><i class="fas fa-landmark"></i> Sejarah Desa</h2>
                <p class="section-subtitle">Mengenal lebih dekat asal-usul dan perkembangan Desa Kami</p>
            </div>

            <!-- Timeline Section -->
            <div class="card" style="margin-bottom: 30px;">
                <div class="card-body">
                    <h3 class="card-title" style="text-align: center; margin-bottom: 25px;">Perjalanan Sejarah Desa</h3>

                    <div class="timeline">
                        <div class="timeline-item">
                            <div class="timeline-marker">
                                <i class="fas fa-map-marker-alt"></i>
                            </div>
                            <div class="timeline-content">
                                <h4>Pendirian Desa (1850)</h4>
                                <div style="display: flex; justify-content: center;">
                                    <img src="{{URL::asset('/upload/berita/beritaa1.jpg')}}" alt="Gambar Berita"style="width: 360px; border-radius: 10px;">
                                </div>
                                <!-- <img src="{{URL::asset('/upload/berita/beritaa1.jpg')}}" alt="profile Pic" height="300" width="300"> -->
                                <p>Desa Kami didirikan oleh sekelompok perantau dari daerah tetangga yang mencari lahan subur untuk bercocok tanam.
                                    Nama desa diambil dari nama sungai kecil yang mengalir di wilayah ini.</p>
                            </div>
                        </div>

                        <div class="timeline-item">
                            <div class="timeline-marker">
                                <i class="fas fa-home"></i>
                            </div>
                            <div class="timeline-content">
                                <h4>Pembentukan Pemerintahan (1920)</h4>
                                <div style="display: flex; justify-content: center;">
                                    <img src="{{URL::asset('/upload/berita/beritaa1.jpg')}}" alt="Gambar Berita"style="width: 360px; border-radius: 10px;">
                                </div>
                                <p>Sistem pemerintahan desa mulai terbentuk dengan dipilihnya kepala desa pertama melalui musyawarah masyarakat. Balai desa pertama dibangun dari bahan kayu dan bambu.</p>
                            </div>
                        </div>

                        <div class="timeline-item">
                            <div class="timeline-marker">
                                <i class="fas fa-school"></i>
                            </div>
                            <div class="timeline-content">
                                <h4>Pendirian Sekolah (1955)</h4>
                                <div style="display: flex; justify-content: center;">
                                    <img src="{{URL::asset('/upload/berita/beritaa1.jpg')}}" alt="Gambar Berita"style="width: 360px; border-radius: 10px;">
                                </div>
                                <p>SD Negeri pertama didirikan, menandai komitmen masyarakat terhadap pendidikan. Bangunan sekolah pertama hanya memiliki dua ruang kelas dengan kapasitas terbatas.</p>
                            </div>
                        </div>

                        <div class="timeline-item">
                            <div class="timeline-marker">
                                <i class="fas fa-road"></i>
                            </div>
                            <div class="timeline-content">
                                <h4>Pembangunan Infrastruktur (1980)</h4>
                                <div style="display: flex; justify-content: center;">
                                    <img src="{{URL::asset('/upload/berita/beritaa1.jpg')}}" alt="Gambar Berita"style="width: 360px; border-radius: 10px;">
                                </div>
                                <p>Jalan desa pertama diaspal, menghubungkan Desa Kami dengan kota terdekat. Listrik mulai masuk ke desa, meningkatkan kualitas hidup masyarakat.</p>
                            </div>
                        </div>

                        <div class="timeline-item">
                            <div class="timeline-marker">
                                <i class="fas fa-trophy"></i>
                            </div>
                            <div class="timeline-content">
                                <h4>Penghargaan Desa Mandiri (2015)</h4>
                                <div style="display: flex; justify-content: center;">
                                    <img src="{{URL::asset('/upload/berita/beritaa1.jpg')}}" alt="Gambar Berita"style="width: 360px; border-radius: 10px;">
                                </div>
                                <p>Desa Kami meraih penghargaan sebagai Desa Mandiri tingkat kabupaten berkat kemajuan di bidang ekonomi, pendidikan, dan infrastruktur.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Village Facts Section -->
            <!-- <div class="card-grid" style="margin-bottom: 30px;">
                <div class="card">
                    <div class="card-body" style="text-align: center;">
                        <div class="fact-icon">
                            <i class="fas fa-users"></i>
                        </div>
                        <h3 class="card-title">Jumlah Penduduk</h3>
                        <p class="fact-number">2,547 Jiwa</p>
                        <p class="card-text">Terdiri dari 1,280 laki-laki dan 1,267 perempuan</p>
                    </div>
                </div>

                <div class="card">
                    <div class="card-body" style="text-align: center;">
                        <div class="fact-icon">
                            <i class="fas fa-map"></i>
                        </div>
                        <h3 class="card-title">Luas Wilayah</h3>
                        <p class="fact-number">542 Ha</p>
                        <p class="card-text">Terbagi menjadi pemukiman, pertanian, dan hutan rakyat</p>
                    </div>
                </div>

                <div class="card">
                    <div class="card-body" style="text-align: center;">
                        <div class="fact-icon">
                            <i class="fas fa-home"></i>
                        </div>
                        <h3 class="card-title">Jumlah RT/RW</h3>
                        <p class="fact-number">5 RW / 15 RT</p>
                        <p class="card-text">Terdiri dari 3 dusun dengan karakteristik berbeda</p>
                    </div>
                </div>
            </div> -->

            <!-- Village Leaders History -->
            <div class="card">
                <div class="card-body">
                    <h3 class="card-title" style="text-align: center; margin-bottom: 25px;">Para Pemimpin Desa</h3>
                    <p style="text-align: center; margin-bottom: 30px;">Dari masa ke masa, Desa Kami dipimpin oleh tokoh-tokoh berikut:</p>

                    <div class="leader-history">
                        <div class="leader-item">
                            <div class="leader-period">1850 - 1875</div>
                            <div class="leader-info">
                                <h4>Mbah Kromo</h4>
                                <div style="display: flex; justify-content: center;">
                                    <img src="{{URL::asset('/upload/berita/kepala.jpg')}}" alt="Gambar Berita"style="width: 150px; border-radius: 10px;">
                                </div>
                                <p>Pendiri dan kepala desa pertama. Membuka lahan dan memimpin pembangunan pemukiman pertama.</p>
                            </div>
                        </div>

                        <div class="leader-item">
                            <div class="leader-period">1875 - 1900</div>
                            <div class="leader-info">
                                <h4>Raden Mas Joyo</h4>
                                <div style="display: flex; justify-content: center;">
                                    <img src="{{URL::asset('/upload/berita/kepala.jpg')}}" alt="Gambar Berita"style="width: 150px; border-radius: 10px;">
                                </div>
                                <p>Memperluas wilayah pertanian dan membangun sistem irigasi tradisional.</p>
                            </div>
                        </div>

                        <div class="leader-item">
                            <div class="leader-period">1900 - 1925</div>
                            <div class="leader-info">
                                <h4>Kyai Hasan</h4>
                                <div style="display: flex; justify-content: center;">
                                    <img src="{{URL::asset('/upload/berita/kepala.jpg')}}" alt="Gambar Berita"style="width: 150px; border-radius: 10px;">
                                </div>
                                <p>Memperkenalkan pendidikan agama dan membangun langgar pertama di desa.</p>
                            </div>
                        </div>

                        <div class="leader-item">
                            <div class="leader-period">1925 - 1950</div>
                            <div class="leader-info">
                                <h4>Mbah Djojo</h4>
                                <div style="display: flex; justify-content: center;">
                                    <img src="{{URL::asset('/upload/berita/kepala.jpg')}}" alt="Gambar Berita"style="width: 150px; border-radius: 10px;">
                                </div>
                                <p>Memimpin desa di masa penjajahan dan mempertahankan kemandirian masyarakat.</p>
                            </div>
                        </div>

                        <div class="leader-item">
                            <div class="leader-period">1950 - 1975</div>
                            <div class="leader-info">
                                <h4>Bapak Sastro</h4>
                                <div style="display: flex; justify-content: center;">
                                    <img src="{{URL::asset('/upload/berita/kepala.jpg')}}" alt="Gambar Berita"style="width: 150px; border-radius: 10px;">
                                </div>
                                <p>Memimpin pembangunan infrastruktur dasar dan sekolah pertama.</p>
                            </div>
                        </div>

                        <div class="leader-item">
                            <div class="leader-period">1975 - 2000</div>
                            <div class="leader-info">
                                <h4>Bapak Suharto</h4>
                                <div style="display: flex; justify-content: center;">
                                    <img src="{{URL::asset('/upload/berita/kepala.jpg')}}" alt="Gambar Berita"style="width: 150px; border-radius: 10px;">
                                </div>
                                <p>Mengembangkan pertanian modern dan membangun jalan desa beraspal pertama.</p>
                            </div>
                        </div>

                        <div class="leader-item">
                            <div class="leader-period">2000 - Sekarang</div>
                            <div class="leader-info">
                                <h4>Said Sudirman</h4>
                                <div style="display: flex; justify-content: center;">
                                    <img src="{{URL::asset('/upload/pemerintah/said.png')}}" alt="Gambar Berita"style="width: 150px; border-radius: 10px;">
                                </div>
                                <p>Memimpin transformasi digital dan pembangunan berkelanjutan di desa.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Cultural Heritage Section -->
            <div class="card" style="margin-top: 30px;">
                <div class="card-body">
                    <h3 class="card-title" style="text-align: center; margin-bottom: 25px;">Warisan Budaya</h3>

                    <div class="heritage-grid">
                        <div class="heritage-item">
                            <div class="heritage-icon">
                                <img src="{{URL::asset('/upload/berita/tari.jpg')}}" alt="Tari Tradisional"
                                    style="width: 100px; height: 100px; object-fit: cover; border-radius: 50%;">
                            </div>
                            <h4>Tari Tradisional</h4>
                            <p>Tari "Lenggang Nusantara" yang diwariskan turun-temurun sejak abad ke-19.</p>
                        </div>

                        <div class="heritage-item">
                            <div class="heritage-icon">
                                <img src="{{URL::asset('/upload/berita/nasi.jpg')}}" alt="Tari Tradisional"
                                    style="width: 100px; height: 100px; object-fit: cover; border-radius: 50%;">
                            </div>
                            <h4>Kuliner Khas</h4>
                            <p>Nasi "Jangkrik" dengan bumbu rahasia yang hanya ditemukan di Desa Kami.</p>
                        </div>

                        <div class="heritage-item">
                            <div class="heritage-icon">
                                <img src="{{URL::asset('/upload/berita/rumah.jpg')}}" alt="Tari Tradisional"
                                    style="width: 100px; height: 100px; object-fit: cover; border-radius: 50%;">
                            </div>
                            <h4>Bangunan Bersejarah</h4>
                            <p>Rumah adat "Joglo Tua" yang masih terpelihara dengan baik sejak 1890.</p>
                        </div>

                        <div class="heritage-item">
                            <div class="heritage-icon">
                                <img src="{{URL::asset('/upload/berita/festival.jpg')}}" alt="Tari Tradisional"
                                    style="width: 100px; height: 100px; object-fit: cover; border-radius: 50%;">
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
        /* Timeline Styles */
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
            background-color: var(--primary-light);
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
            background-color: var(--primary);
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
            background-color: var(--light-gray);
            padding: 20px;
            border-radius: var(--radius);
            box-shadow: var(--shadow);
        }

        .timeline-content h4 {
            color: var(--primary);
            margin-bottom: 10px;
        }

        /* Facts Section */
        .fact-icon {
            width: 70px;
            height: 70px;
            background-color: var(--secondary);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 15px;
            color: var(--primary);
            font-size: 1.8rem;
        }

        .fact-number {
            font-size: 2rem;
            font-weight: 700;
            color: var(--primary);
            margin: 10px 0;
        }

        /* Leader History */
        .leader-history {
            max-width: 700px;
            margin: 0 auto;
        }

        .leader-item {
            display: flex;
            margin-bottom: 20px;
            padding-bottom: 20px;
            border-bottom: 1px dashed var(--gray);
        }

        .leader-period {
            width: 150px;
            flex-shrink: 0;
            font-weight: 600;
            color: var(--primary);
        }

        .leader-info {
            flex: 1;
        }

        .leader-info h4 {
            margin-bottom: 5px;
            color: var(--primary);
        }

        /* Heritage Grid */
        .heritage-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            margin-top: 20px;
        }

        .heritage-item {
            text-align: center;
            padding: 20px 15px;
            background-color: var(--light-gray);
            border-radius: var(--radius);
        }

        .heritage-icon {
            width: 60px;
            height: 60px;
            background-color: var(--secondary);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 15px;
            color: var(--primary);
            font-size: 1.5rem;
        }

        .heritage-item h4 {
            color: var(--primary);
            margin-bottom: 10px;
        }

        .section-subtitle {
            text-align: center;
            color: var(--dark-gray);
            margin-bottom: 40px;
            font-size: 1.1rem;
            max-width: 700px;
            margin-left: auto;
            margin-right: auto;
        }

        /* Responsive Adjustments */
        @media (max-width: 768px) {
            .timeline::before {
                left: 25px;
            }

            .timeline-marker {
                width: 50px;
                height: 50px;
                margin-right: 15px;
            }

            .leader-item {
                flex-direction: column;
            }

            .leader-period {
                width: 100%;
                margin-bottom: 10px;
            }
        }
    </style>

@endsection