@extends('layouts.user')

@section('title', 'Beranda | Sistem Informasi Desa')

@section('content')

        <section id="home-page" class="page-section active">
            <div class="hero">
                <h1>Selamat Datang di Portal Desa Kami</h1>
                <p>Mewujudkan pelayanan publik yang transparan dan akuntabel.</p>
                <a href="#" data-page="complaints" class="btn btn-primary" style="background-color: var(--color-primary-dark);">Sampaikan Pengaduan <i class="fas fa-arrow-right"></i></a>
            </div>
            
            <div class="container">
                <div class="quick-info-grid">
                    
                    <div class="card info-card">
                        <h3><i class="fas fa-newspaper"></i> Latest News</h3>
                        <div class="news-list">
                            <div class="article" onclick="navigate('news-detail', {id: 1})">
                                <img src="https://picsum.photos/60/60?random=2" alt="News Image">
                                <div>
                                    <h4>Pembangunan Jalan Baru Desa Berjalan Lancar</h4>
                                    <span><i class="fas fa-calendar-alt"></i> 25 Okt 2025</span>
                                </div>
                            </div>
                            <div class="article" onclick="navigate('news-detail', {id: 2})">
                                <img src="https://picsum.photos/60/60?random=3" alt="News Image">
                                <div>
                                    <h4>Pelatihan UMKM Digital untuk Warga</h4>
                                    <span><i class="fas fa-calendar-alt"></i> 18 Okt 2025</span>
                                </div>
                            </div>
                            <div class="article" onclick="navigate('news-detail', {id: 3})">
                                <img src="https://picsum.photos/60/60?random=4" alt="News Image">
                                <div>
                                    <h4>Sosialisasi Program Bantuan Sosial Terbaru</h4>
                                    <span><i class="fas fa-calendar-alt"></i> 10 Okt 2025</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="card info-card">
                        <h3><i class="fas fa-calendar-check"></i> Upcoming Activities</h3>
                        <ul class="activity-list">
                            <li><i class="fas fa-clock"></i> **2 Nov 2025:** Rapat Bulanan RT/RW</li>
                            <li><i class="fas fa-clock"></i> **5 Nov 2025:** Kerja Bakti Massal Desa</li>
                            <li><i class="fas fa-clock"></i> **15 Nov 2025:** Pekan Olahraga Desa (Pordes)</li>
                            <li><i class="fas fa-clock"></i> **28 Nov 2025:** Pelantikan Karang Taruna Baru</li>
                        </ul>
                        <a href="#" data-page="agenda" class="btn btn-secondary" style="margin-top: 15px;">View All</a>
                    </div>
                    
                    <div class="card info-card village-head-card">
                        <h3><i class="fas fa-user-tie"></i> Village Government</h3>
                        <img src="{{URL::asset('/upload/pemerintah/said.png')}}" alt="Village Head Photo">
                        <p>Said Sudirman</p>
                        <span>Kepala Desa</span>
                        <p style="font-size: 0.9rem; margin-top: 10px; color: var(--color-text-light);">"Melayani warga dengan sepenuh hati."</p>
                        <a href="#" data-page="government" class="btn btn-primary" style="margin-top: 15px;">View Officials</a>
                    </div>
                    
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

        <section id="news-detail-page" class="page-section">
            <div class="container">
                <button onclick="navigate('news')" class="btn btn-secondary" style="margin-bottom: 20px;"><i class="fas fa-arrow-left"></i> Back to News</button>
                <div class="card">
                    <img id="news-detail-image" src="https://picsum.photos/800/400?random=1" alt="News Detail Image">
                    <span id="news-detail-category" class="category" style="margin-bottom: 10px;"></span>
                    <h1 id="news-detail-title">Sample News Title</h1>
                    <p class="meta"><i class="fas fa-calendar-alt"></i> <span id="news-detail-date">Date</span> | <i class="fas fa-user"></i> <span id="news-detail-author">Admin Desa</span></p>
                    <div id="news-detail-content">
                        <p>This is the full content of the news article. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>
                        <p>Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                        <p>Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
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
                    <button onclick="navigate('gallery')" class="btn btn-secondary" style="margin-bottom: 20px;"><i class="fas fa-arrow-left"></i> Back to Albums</button>
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
                        <p class="duties">Bertanggung jawab atas penyelenggaraan pemerintahan, pembangunan, dan pelayanan masyarakat desa.</p>
                    </div>
                    <div class="card official-card">
                        <img src="https://picsum.photos/200/200?random=13" alt="Official Photo">
                        <h4>Siti Nurjanah, S.E.</h4>
                        <p class="position">Sekretaris Desa</p>
                        <p class="duties">Membantu Kepala Desa dalam bidang administrasi dan memberikan pelayanan teknis administrasi.</p>
                    </div>
                    <div class="card official-card">
                        <img src="https://picsum.photos/200/200?random=14" alt="Official Photo">
                        <h4>Ahmad Zaki</h4>
                        <p class="position">Kepala Urusan Keuangan</p>
                        <p class="duties">Melaksanakan pengelolaan administrasi keuangan desa, termasuk penerimaan dan pengeluaran.</p>
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
                        <button type="submit" class="btn btn-primary" style="width: 100%; margin-top: 15px;">Submit Complaint</button>
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
                <button onclick="navigate('complaints')" class="btn btn-secondary" style="margin-bottom: 20px;"><i class="fas fa-arrow-left"></i> Back to History</button>
                <div class="card" style="padding: 30px;">
                    <span id="comp-detail-status" class="status-badge status-completed" style="float: right;">Status</span>
                    <h2 id="comp-detail-title" style="border-bottom: none; margin-bottom: 5px;">Complaint Title</h2>
                    <p style="color: var(--color-text-light); margin-bottom: 20px;">Category: <strong id="comp-detail-category">Category</strong> | Submitted: <span id="comp-detail-date">Date</span></p>

                    <h3>Description:</h3>
                    <p id="comp-detail-desc" style="margin-bottom: 30px; border-left: 3px solid var(--color-primary); padding-left: 15px; font-style: italic;"></p>

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
                        <button type="submit" class="btn btn-primary" style="width: 100%; margin-top: 20px;">Submit Request</button>
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
                        <p style="border-bottom: none; color: var(--color-text-light); font-style: italic;">Aktif di kegiatan kepemudaan desa dan memiliki usaha mikro di bidang kuliner.</p>

                        <div class="profile-buttons">
                            <a href="#" class="btn btn-primary"><i class="fas fa-edit"></i> Edit Profile</a>
                            <a href="#" class="btn btn-secondary"><i class="fas fa-key"></i> Change Password</a>
                            <a href="#" data-page="complaints" class="btn btn-secondary"><i class="fas fa-history"></i> View Complaint History</a>
                            <a href="#" data-page="services" class="btn btn-secondary"><i class="fas fa-envelope"></i> View Letter Requests</a>
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
                    <p style="margin-top: 20px; font-size: 0.9rem;">Don't have an account? <a href="#" onclick="navigate('register')">Register here</a></p>
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
                    <p style="margin-top: 20px; font-size: 0.9rem;">Already have an account? <a href="#" onclick="navigate('login')">Login here</a></p>
                </form>
            </div>
        </section>

@endsection
