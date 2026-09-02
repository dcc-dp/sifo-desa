<footer class="footer" id="main-footer">
    <div class="container footer-container">
        <div class="footer-grid">

            <div class="footer-col footer-col-brand">
                <div class="footer-logo">
                    <img src="{{ asset('uploads/galeri/logo_sifo.png') }}" alt="Logo Desa" class="footer-logo-img">
                    <div class="footer-logo-text">
                        <h4>DESA {{ strtoupper($setting->nama_desa ?? 'RANTE GOLA') }}</h4>
                        <span>Sistem Informasi & Layanan Terpadu</span>
                    </div>
                </div>
            
                <p class="footer-desc">
                    {{ $setting->deskripsi ?? 'Website resmi desa sebagai pusat informasi pembangunan, pelayanan administrasi masyarakat, transparansi data, dan sarana komunikasi warga.' }}
                </p>

                <div class="footer-social-wrap">
                    <span class="social-title">Media Sosial Resmi:</span>
                    <div class="social-links">
                        @if($setting?->facebook)
                            <a href="{{ $setting->facebook }}" target="_blank" aria-label="Facebook" class="social-btn"><i class="fab fa-facebook-f"></i></a>
                        @endif
                        @if($setting?->instagram)
                            <a href="{{ $setting->instagram }}" target="_blank" aria-label="Instagram" class="social-btn"><i class="fab fa-instagram"></i></a>
                        @endif
                        @if($setting?->twitter)
                            <a href="{{ $setting->twitter }}" target="_blank" aria-label="Twitter" class="social-btn"><i class="fab fa-x-twitter"></i></a>
                        @endif
                        <a href="#" class="social-btn" aria-label="YouTube"><i class="fab fa-youtube"></i></a>
                    </div>
                </div>
            </div>
            
            <div class="footer-col footer-col-links">
                <h4 class="footer-heading">Menu Pintas</h4>
                <ul class="footer-links">
                    <li><a href="{{ route('home') }}"><i class="fas fa-chevron-right"></i> Beranda</a></li>
                    <li><a href="{{ route('sejarah') }}"><i class="fas fa-chevron-right"></i> Sejarah Desa</a></li>
                    <li><a href="{{ url('/pemerintah') }}"><i class="fas fa-chevron-right"></i> Pemerintah Desa</a></li>
                    <li><a href="{{ route('agenda') }}"><i class="fas fa-chevron-right"></i> Agenda Kegiatan</a></li>
                    <li><a href="{{ route('pengajuan.login-form') }}"><i class="fas fa-chevron-right"></i> Pengajuan Surat</a></li>
                    <li><a href="{{ route('pengaduan.login-form') }}"><i class="fas fa-chevron-right"></i> Pengaduan Warga</a></li>
                </ul>
            </div>

            <div class="footer-col footer-col-contact">
                <h4 class="footer-heading">Kontak & Pelayanan</h4>
                <div class="footer-contact-list">
                    <div class="contact-item">
                        <span class="contact-icon"><i class="fas fa-map-marker-alt"></i></span>
                        <div class="contact-text">
                            <strong>Alamat Kantor</strong>
                            <p>{{ $setting->alamat ?? 'Kantor Balai Desa, Pelayanan Setiap Hari Kerja' }}</p>
                        </div>
                    </div>
                    <div class="contact-item">
                        <span class="contact-icon"><i class="fas fa-envelope"></i></span>
                        <div class="contact-text">
                            <strong>Email Resmi</strong>
                            <p>{{ $setting->email ?? 'kontak@desa.id' }}</p>
                        </div>
                    </div>
                    <div class="contact-item">
                        <span class="contact-icon"><i class="fas fa-phone-alt"></i></span>
                        <div class="contact-text">
                            <strong>Telepon / WhatsApp</strong>
                            <p>{{ $setting->telepon ?? '(0411) 123456' }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="footer-col footer-col-maps">
                <h4 class="footer-heading">Peta Lokasi Desa</h4>
                @if($setting?->maps_embed)
                    <div class="footer-map-card">
                        <iframe
                            src="{{ $setting->maps_embed }}"
                            width="100%"
                            height="160"
                            style="border:0;"
                            loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade">
                        </iframe>
                    </div>
                @else
                    <div class="footer-map-placeholder">
                        <i class="fas fa-map-marked-alt"></i>
                        <span>Peta lokasi belum dikonfigurasi</span>
                    </div>
                @endif
            </div>

        </div>

        <div class="footer-bottom">
            <div class="copyright-text">
                &copy; {{ date('Y') }} <strong>Pemerintah Desa {{ $setting->nama_desa ?? 'Rante Gola' }}</strong>. Hak Cipta Dilindungi Undang-Undang.
            </div>
            <div class="footer-bottom-badge">
                <i class="fas fa-leaf"></i> Sistem Informasi Desa Mandiri
            </div>
        </div>
    </div>
</footer>