<header class="header" id="main-header">
    <div class="container">
        <nav class="navbar">
            <div class="logo" onclick="navigate('home')">
                <i class="fas fa-leaf"></i> DESA DIGITAL
            </div>
            <ul class="nav-links" id="nav-links">
                <li><a href="{{ route('home') }}"><i class="fas fa-home" style="margin-right:6px;"></i>
                        Home</a></li>

                <li class="dropdown">
                    <a href="#" class="dropdown-toggle">
                        <i class="fas fa-landmark" style="margin-right:5px;"></i> Profil Desa
                    </a>
                    <ul class="dropdown-menu">
                        <li><a href="{{ route('galeri') }}"><i class="fas fa-images" style="margin-right:8px;"></i> Galeri Desa</a></li>
                        <li><a href="{{ route('sejarah') }}"><i class="fas fa-history" style="margin-right:8px;"></i> Sejarah Desa</a></li>
                        <li><a href="{{ url('/pemerintah') }}"><i class="fas fa-users" style="margin-right:8px;"></i> Pemerintah Desa</a></li>
                    </ul>
                </li>

                <li class="dropdown">
                    <a href="#" class="dropdown-toggle">
                        <i class="fas fa-newspaper" style="margin-right:5px;"></i> Berita dan Agenda
                    </a>
                    <ul class="dropdown-menu">
                        <li><a href="{{ url('/kategori') }}"><i class="fas fa-list" style="margin-right:8px;"></i> Kategori Berita</a></li>
                        <li><a href="{{ url('/agenda')}}"><i class="fas fa-calendar-alt" style="margin-right:8px;"></i> Agenda
                                Kegiatan</a></li>
                    </ul>
                </li>

                <li class="dropdown">
                    <a href="#" class="dropdown-toggle">
                        <i class="fas fa-chart-bar" style="margin-right:5px;"></i> Data Statistik
                    </a>
                    <ul class="dropdown-menu">
                        <li><a href="{{ ('penduduk') }}"><i class="fas fa-users" style="margin-right:8px;"></i> Jumlah Penduduk</a>
                        </li>
                        <li><a href="{{ ('pendidikan') }}"><i class="fas fa-graduation-cap" style="margin-right:8px;"></i> Data Pendidikan</a>
                        </li>
                        <li><a href="{{ ('pekerjaan') }}"><i class="fas fa-briefcase" style="margin-right:8px;"></i> Data Pekerjaan</a>
                        </li>
                        <li><a href="{{ ('agama') }}"><i class="fas fa-place-of-worship" style="margin-right:8px;"></i> Data Agama</a>
                        </li>
                    </ul>
                </li>

                <li class="dropdown">
                    <a href="#" class="dropdown-toggle">
                        <i class="fas fa-laptop" style="margin-right:5px;"></i> Layanan Online
                    </a>
                    <ul class="dropdown-menu">
                        <li><a href="{{ ('pengajuan') }}"><i class="fas fa-envelope-open-text" style="margin-right:8px;"></i> Pengajuan
                                Surat</a></li>
                        <li><a href="{{ ('pengaduan') }}"><i class="fas fa-file-signature" style="margin-right:8px;"></i> Pengaduan</a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item">
                    <a href="{{ ('sign-in') }}" class="btn-login"  style="margin-right:6px;">
                    Login
                    </a>
                </li>
            </ul>



            <div class="menu-toggle" id="menu-toggle"><i class="fas fa-bars"></i></div>
        </nav>
    </div>
</header>