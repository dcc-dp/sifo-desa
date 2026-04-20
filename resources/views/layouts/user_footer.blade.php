<footer class="footer" id="main-footer">
    <div class="container footer-grid">

        <div class="footer-col">
            <h4><i class="fas fa-leaf"></i> {{ $setting->nama_desa ?? 'DESA DIGITAL' }}</h4>
            <p style="margin-top: 10px; font-size: 0.9rem;">
                {{ $setting->deskripsi ?? '-' }}
            </p>
        </div>

        <div class="footer-col">
            <h4>Contact Info</h4>
            <p style="display:flex; align-items:flex-start; gap:8px;">
                <i class="fas fa-map-marker-alt" style="margin-top:4px; flex-shrink:0;"></i> 
                <span>{{ $setting->alamat ?? '-' }}</span>
            </p>
            <p style="display:flex; align-items:center; gap:8px;">
                <i class="fas fa-envelope" style="flex-shrink:0;"></i> 
                <span>{{ $setting->email ?? '-' }}</span>
            </p>
            <p style="display:flex; align-items:center; gap:8px;">
                <i class="fas fa-phone" style="flex-shrink:0;"></i> 
                <span>{{ $setting->telepon ?? '-' }}</span>
            </p>
        </div>

        <div class="footer-col">
            <h4>Quick Links</h4>
            <p><a href="{{ url('/news') }}">News & Updates</a></p>
            <p><a href="{{ url('/complaints') }}">Submit a Complaint</a></p>
            <p><a href="{{ url('/services') }}">Public Services</a></p>
        </div>

        <div class="footer-col">
            <h4>Follow Us</h4>
            <div class="social-links" style="margin-top: 10px;">
                @if($setting?->facebook)
                    <a href="{{ $setting->facebook }}" target="_blank"><i class="fab fa-facebook-f"></i></a>
                @endif
                @if($setting?->instagram)
                    <a href="{{ $setting->instagram }}" target="_blank"><i class="fab fa-instagram"></i></a>
                @endif
                @if($setting?->twitter)
                    <a href="{{ $setting->twitter }}" target="_blank"><i class="fab fa-twitter"></i></a>
                @endif
            </div>
        </div>

        <div class="footer-col">
            <h4>Lokasi</h4>
            @if($setting?->maps_embed)
                <div style="border-radius:15px; overflow:hidden;">
                    <iframe
                        src="{{ $setting->maps_embed }}"
                        width="100%"
                        height="150"
                        style="border:0;"
                        loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade">
                    </iframe>
                </div>
            @endif
        </div>

    </div>

    <div class="container" style="text-align: center; border-top: 1px solid rgba(255,255,255,0.1); margin-top: 20px; padding-top: 15px;">
        <p style="font-size: 0.8rem;">
            &copy; {{ date('Y') }} {{ $setting->nama_desa ?? 'Desa Digital' }}. All rights reserved.
        </p>
    </div>
</footer>