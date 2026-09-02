<header class="header" id="main-header">
    <div class="container header-container">
        <nav class="navbar">
            @php
                $setting = \App\Models\Setting::first();
            @endphp

            <div class="logo" onclick="window.location='{{ route('home') }}'">
                <img src="{{ asset('uploads/galeri/logo_sifo.png') }}" alt="Logo Desa" class="logo-img">
                <div class="logo-text-group">
                    <span class="logo-title">SIFO {{ strtoupper($setting->nama_desa ?? 'RANTE GOLA') }}</span>
                    <span class="logo-subtitle">Portal Informasi & Layanan Publik</span>
                </div>
            </div>

            <ul class="nav-links" id="nav-links">
                <li>
                    <a href="{{ route('home') }}" class="nav-item-link">
                        <i class="fas fa-home"></i>
                        <span>Home</span>
                    </a>
                </li>

                <li class="dropdown">
                    <a href="#" class="dropdown-toggle nav-item-link">
                        <i class="fas fa-landmark"></i>
                        <span>Profil Desa</span>
                        <i class="fas fa-chevron-down dropdown-arrow"></i>
                    </a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="{{ route('user.galeri') }}">
                                <i class="fas fa-images"></i>
                                <span>Galeri Desa</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('sejarah') }}">
                                <i class="fas fa-history"></i>
                                <span>Sejarah Desa</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ url('/pemerintah') }}">
                                <i class="fas fa-users"></i>
                                <span>Pemerintah Desa</span>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="dropdown">
                    <a href="#" class="dropdown-toggle nav-item-link">
                        <i class="fas fa-newspaper"></i>
                        <span>Berita & Agenda</span>
                        <i class="fas fa-chevron-down dropdown-arrow"></i>
                    </a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="{{ url('/kategori') }}">
                                <i class="fas fa-list"></i>
                                <span>Kategori Berita</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ url('/agenda') }}">
                                <i class="fas fa-calendar-alt"></i>
                                <span>Agenda Kegiatan</span>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="dropdown">
                    <a href="#" class="dropdown-toggle nav-item-link">
                        <i class="fas fa-chart-bar"></i>
                        <span>Data Statistik</span>
                        <i class="fas fa-chevron-down dropdown-arrow"></i>
                    </a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="{{ route('user.statistik.penduduk') }}">
                                <i class="fas fa-users"></i>
                                <span>Jumlah Penduduk</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('user.statistik.pendidikan') }}">
                                <i class="fas fa-graduation-cap"></i>
                                <span>Data Pendidikan</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('user.statistik.pekerjaan') }}">
                                <i class="fas fa-briefcase"></i>
                                <span>Data Pekerjaan</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('user.statistik.agama') }}">
                                <i class="fas fa-place-of-worship"></i>
                                <span>Data Agama</span>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="dropdown">
                    <a href="#" class="dropdown-toggle nav-item-link">
                        <i class="fas fa-laptop"></i>
                        <span>Layanan Online</span>
                        <i class="fas fa-chevron-down dropdown-arrow"></i>
                    </a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="{{ route('pengajuan.login-form') }}">
                                <i class="fas fa-envelope-open-text"></i>
                                <span>Pengajuan Surat</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('pengaduan.login-form') }}">
                                <i class="fas fa-file-signature"></i>
                                <span>Pengaduan Warga</span>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item-btn">
                    <a href="{{ url('/sign-in') }}" class="btn-login">
                        <i class="fas fa-arrow-right-to-bracket"></i>
                        <span>Login</span>
                    </a>
                </li>
            </ul>

            <div class="menu-toggle" id="menu-toggle" aria-label="Toggle navigation">
                <i class="fas fa-bars"></i>
            </div>
        </nav>
    </div>
</header>
