<footer class="footer py-4 mt-auto">
    <div class="container-fluid">
        <div class="row align-items-center">
            <div class="col-12 text-center">
                <p class="mb-0 text-muted fs-8">
                    &copy; {{ date('Y') }} <strong>SIFO-DESA</strong> &mdash; Pemerintah Desa {{ \App\Models\Setting::first()->nama_desa ?? 'Rante Gola' }}. Seluruh Hak Cipta Dilindungi.
                </p>
            </div>
        </div>
    </div>
</footer>
