<nav class="navbar navbar-main navbar-expand-lg px-4 py-3 shadow-none border-bottom" id="navbarBlur" navbar-scroll="true" style="background: rgba(255, 255, 255, 0.85); backdrop-filter: blur(10px); border-color: #e2e8f0 !important; margin: 0 1.5rem 1rem 1.5rem; border-radius: 14px;">
    <div class="container-fluid py-0 px-0 d-flex justify-content-between align-items-center">
        <!-- BREADCRUMB / PORTAL BRAND -->
        <div class="d-flex align-items-center gap-2">
            <span class="badge bg-emerald-light text-success fw-bold px-2 py-1 fs-8" style="background: #ecfdf5; color: #15803d; border: 1px solid #bbf7d0;">
                <i class="fas fa-shield-alt me-1"></i> Admin Panel
            </span>
            <span class="text-muted fs-7 d-none d-sm-inline">/</span>
            <span class="text-dark fw-semibold fs-7 d-none d-sm-inline">SIFO-DESA Rante Gola</span>
        </div>

        <div class="d-flex align-items-center gap-3">
            <!-- USER BADGE -->
            @auth
                <div class="d-none d-md-flex align-items-center gap-2 pe-2 border-end">
                    <div class="d-flex align-items-center justify-content-center text-white fw-bold fs-7 rounded-circle shadow-xs"
                        style="width: 32px; height: 32px; background: linear-gradient(135deg, #15803d, #16a34a);">
                        {{ strtoupper(substr(auth()->user()->name ?? 'A', 0, 1)) }}
                    </div>
                    <div class="d-flex flex-column text-start">
                        <span class="text-xs fw-bold text-dark lh-1">{{ auth()->user()->name }}</span>
                        <span class="text-2xs text-muted">Administrator</span>
                    </div>
                </div>
            @endauth

            <!-- LOGOUT BUTTON -->
            <form method="POST" action="{{ route('logout') }}" class="m-0">
                @csrf
                <button type="submit" class="btn btn-sm btn-outline-danger m-0 px-3 py-1 d-inline-flex align-items-center gap-1 rounded-3 fs-7 fw-semibold"
                    onclick="return confirm('Apakah Anda yakin ingin keluar dari sesi admin?')">
                    <i class="fas fa-sign-out-alt"></i>
                    <span class="d-none d-sm-inline">Keluar</span>
                </button>
            </form>

            <!-- MOBILE TOGGLER -->
            <div class="d-xl-none">
                <a href="javascript:;" class="nav-link text-body p-0" id="iconNavbarSidenav">
                    <div class="sidenav-toggler-inner">
                        <i class="sidenav-toggler-line"></i>
                        <i class="sidenav-toggler-line"></i>
                        <i class="sidenav-toggler-line"></i>
                    </div>
                </a>
            </div>
        </div>
    </div>
</nav>
<!-- End Navbar -->
