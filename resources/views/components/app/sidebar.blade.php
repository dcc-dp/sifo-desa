<aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 bg-slate-900 fixed-start " id="sidenav-main">
    <div class="sidenav-header">
        @php
    $setting = \App\Models\Setting::first();
@endphp

        <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none"
            aria-hidden="true" id="iconSidenav">
        </i>

        <a class="navbar-brand d-flex align-items-center m-0">

            <!-- <img src="{{ asset('uploads/galeri/logo_sifo.png') }}" alt="Logo Desa"
                style="height:40px; margin-right:10px;"> -->

            <span class="font-weight-bold text-lg">

                <!-- DESA {{ strtoupper($setting->nama_desa ?? '') }} -->

                SIFO DESA


            </span>

        </a>

    </div>
    <div class="collapse navbar-collapse px-4  w-auto " id="sidenav-collapse-main">
        <ul class="navbar-nav">
            @if(isset($dynamicMenus) && $dynamicMenus->count() > 0)
                @foreach($dynamicMenus as $menu)
                    @if($menu->is_header)
                        <li class="nav-item mt-2">
                            <div class="d-flex align-items-center nav-link">
                                {!! $menu->icon !!}
                                <span class="font-weight-normal text-md ms-2">{{ $menu->title }}</span>
                            </div>
                        </li>
                        
                        @if(isset($menu->children) && $menu->children->count() > 0)
                            @foreach($menu->children as $child)
                                @php
                                    $link = '#';
                                    $isActive = false;
                                    
                                    if ($child->route_name) {
                                        if (Route::has($child->route_name)) {
                                            $link = route($child->route_name);
                                        }
                                        if (request()->routeIs($child->route_name) || request()->routeIs($child->route_name . '.*')) {
                                            $isActive = true;
                                        }
                                    } elseif ($child->url) {
                                        $link = url($child->url);
                                        if (request()->is(trim($child->url, '/')) || request()->is(trim($child->url, '/') . '/*')) {
                                            $isActive = true;
                                        }
                                    }
                                @endphp
                                <li class="nav-item border-start my-0 pt-2">
                                    <a class="nav-link {{ empty($child->icon) ? 'position-relative ms-0 ps-2 py-2' : '' }} {{ $isActive ? 'active' : '' }}" href="{{ $link }}">
                                        @if(!empty($child->icon))
                                        <div class="icon icon-shape icon-sm px-0 text-center d-flex align-items-center justify-content-center">
                                            {!! $child->icon !!}
                                        </div>
                                        @endif
                                        <span class="nav-link-text ms-1">{{ $child->title }}</span>
                                    </a>
                                </li>
                            @endforeach
                        @endif
                    @else
                        @php
                            $link = '#';
                            $isActive = false;
                            
                            if ($menu->route_name) {
                                if (Route::has($menu->route_name)) {
                                    $link = route($menu->route_name);
                                }
                                if (request()->routeIs($menu->route_name) || request()->routeIs($menu->route_name . '.*')) {
                                    $isActive = true;
                                }
                            } elseif ($menu->url) {
                                $link = url($menu->url);
                                if (request()->is(trim($menu->url, '/')) || request()->is(trim($menu->url, '/') . '/*')) {
                                    $isActive = true;
                                }
                            }
                        @endphp
                        <li class="nav-item">
                            <a class="nav-link {{ empty($menu->icon) ? 'position-relative ms-0 ps-2 py-2' : '' }} {{ $isActive ? 'active' : '' }}" href="{{ $link }}">
                                @if(!empty($menu->icon))
                                <div class="icon icon-shape icon-sm px-0 text-center d-flex align-items-center justify-content-center">
                                    {!! $menu->icon !!}
                                </div>
                                @endif
                                <span class="nav-link-text ms-1">{{ $menu->title }}</span>
                            </a>
                        </li>
                    @endif
                @endforeach
            @endif
        </ul>
    </div>
    {{-- <div class="sidenav-footer mx-4 ">
        <a class="btn bg-gradient-primary inline-block px-5 py-3 mx-auto text-xs align-middle transition-all ease-in border-0 rounded-lg select-none"
            href="https://www.creative-tim.com/product/corporate-ui-dashboard-pro-laravel" target="_blank">
            UPGRADE TO PRO
        </a>
        <div class="card border-radius-md" id="sidenavCard">
            <div class="card-body  text-start  p-3 w-100">
                <div class="mb-3">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" class="text-primary"
                        viewBox="0 0 24 24" fill="currentColor" id="sidenavCardIcon">
                        <path
                            d="M5.625 1.5c-1.036 0-1.875.84-1.875 1.875v17.25c0 1.035.84 1.875 1.875 1.875h12.75c1.035 0 1.875-.84 1.875-1.875V12.75A3.75 3.75 0 0016.5 9h-1.875a1.875 1.875 0 01-1.875-1.875V5.25A3.75 3.75 0 009 1.5H5.625z" />
                        <path
                            d="M12.971 1.816A5.23 5.23 0 0114.25 5.25v1.875c0 .207.168.375.375.375H16.5a5.23 5.23 0 013.434 1.279 9.768 9.768 0 00-6.963-6.963z" />
                    </svg>
                </div>
                <div class="docs-info">
                    <h6 class="font-weight-bold up mb-2">Need help?</h6>
                    <p class="text-sm font-weight-normal">Please check our docs.</p>
                    <a href="https://www.creative-tim.com/learning-lab/bootstrap/installation-guide/corporate-ui-dashboard"
                        target="_blank" class="font-weight-bold text-sm mb-0 icon-move-right mt-auto w-100 mb-0">
                        Documentation
                        <i class="fas fa-arrow-right-long text-sm ms-1" aria-hidden="true"></i>
                    </a>
                </div>
            </div>
        </div>
    </div> --}}


    
<style>
/* ===================================================
   ADMIN SIDEBAR & LAYOUT FIX
   =================================================== */

/* 1. Sidebar Container: Full viewport height, fixed at left, flex layout */
#sidenav-main {
    position: fixed !important;
    top: 0 !important;
    bottom: 0 !important;
    left: 0 !important;
    height: 100vh !important;
    max-height: 100vh !important;
    width: 15.625rem !important;
    max-width: 15.625rem !important;
    display: flex !important;
    flex-direction: column !important;
    overflow: hidden !important; /* Prevents outer scrollbar so logo never scrolls away */
    z-index: 1050 !important;
    margin: 0 !important;
    box-sizing: border-box !important;
}

/* 2. Sidenav Header: Fixed top section with logo, never moves */
#sidenav-main .sidenav-header {
    flex: 0 0 4.875rem !important;
    height: 4.875rem !important;
    min-height: 4.875rem !important;
    display: flex !important;
    align-items: center !important;
    padding: 0 1.5rem !important;
    background-color: inherit !important;
    z-index: 2 !important;
}

/* 3. Sidenav Collapse: Dedicated vertical scroll container for all menu items */
#sidenav-collapse-main {
    flex: 1 1 auto !important;
    display: block !important;
    height: calc(100vh - 4.875rem) !important;
    max-height: calc(100vh - 4.875rem) !important;
    overflow-y: auto !important;
    overflow-x: hidden !important;
    overscroll-behavior: contain !important; /* Prevents scroll chaining into page */
    padding-bottom: 5rem !important; /* Generous bottom padding keeps last menus clearly accessible */
    -webkit-overflow-scrolling: touch;
}

/* 4. Elegant custom scrollbar for the sidebar */
#sidenav-collapse-main::-webkit-scrollbar {
    width: 5px;
}
#sidenav-collapse-main::-webkit-scrollbar-track {
    background: transparent;
}
#sidenav-collapse-main::-webkit-scrollbar-thumb {
    background: rgba(255, 255, 255, 0.22);
    border-radius: 10px;
}
#sidenav-collapse-main::-webkit-scrollbar-thumb:hover {
    background: rgba(255, 255, 255, 0.45);
}
#sidenav-collapse-main {
    scrollbar-width: thin;
    scrollbar-color: rgba(255, 255, 255, 0.22) transparent;
}

/* 5. Desktop Layout: Independent scrolling between Sidebar and Main Content */
@media (min-width: 1200px) {
    html, body.g-sidenav-show {
        height: 100vh;
        overflow: hidden; /* Page body does not scroll; only main-content and sidebar scroll */
    }

    .g-sidenav-show .sidenav.fixed-start ~ .main-content,
    .g-sidenav-show .main-content {
        margin-left: 15.625rem !important;
        height: 100vh !important;
        max-height: 100vh !important;
        overflow-y: auto !important;
        overflow-x: hidden !important;
        overscroll-behavior: contain !important;
        -webkit-overflow-scrolling: touch;
        position: relative !important;
    }
}

/* 6. Responsive Mobile Drawer (< 1200px) */
@media (max-width: 1199.98px) {
    #sidenav-main {
        transform: translateX(-17.125rem);
        transition: transform 0.2s ease-in-out;
    }

    .g-sidenav-show.g-sidenav-pinned #sidenav-main {
        transform: translateX(0) !important;
    }

    .main-content {
        margin-left: 0 !important;
        height: auto !important;
        max-height: none !important;
        overflow: visible !important;
    }
}
</style>

</aside>