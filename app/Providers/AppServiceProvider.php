<?php

namespace App\Providers;

use Illuminate\Support\Facades\URL;
use App\Models\Kategori;
use App\Models\Setting;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Gate Super Admin (Grant all permissions automatically to Super Admin)
        Gate::before(function ($user, $ability) {
            return $user->hasRole('Super Admin') ? true : null;
        });

        // 1. Memaksa Laravel menggunakan HTTPS jika berjalan di HTTPS / Production
        if (config('app.env') === 'production' || request()->isSecure() || request()->header('x-forwarded-proto') === 'https') {
            URL::forceScheme('https');
        }

        // 2. Mencegah query database berjalan jika Laravel sedang berjalan via terminal/CLI (misal saat php artisan migrate)
        if (app()->runningInConsole()) {
            return;
        }

        // 3. Query share view untuk halaman web biasa
        if (Schema::hasTable('kategoris')) {
            View::share(
                'menuKategoris',
                Kategori::orderBy('nama_kategori')->get()
            );
        } else {
            View::share('menuKategoris', collect());
        }

        // 4. Cek apakah tabel settings sudah ada untuk layouts user
        View::composer('layouts.user', function ($view) {
            $setting = null;

            if (Schema::hasTable('settings')) {
                $setting = Setting::first();
            }

            $view->with('setting', $setting);
        });

        // 5. Inject Dynamic Menus for Admin Sidebar
        View::composer('components.app.sidebar', function ($view) {
            $user = auth()->user();
            $dynamicMenus = collect();

            if ($user && Schema::hasTable('menus')) {
                $allMenus = \App\Models\Menu::where('is_active', true)
                    ->orderBy('order_num')
                    ->get();

                // Self-heal / normalize broken or truncated SVG icons for Profil Desa
                $buildingSvg = '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="white" class="bi bi-building" viewBox="0 0 16 16"><path d="M4 2.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5zm3 0a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5zm3.5-.5a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5zM4 5.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5zM7.5 5a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5zm2.5.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5zM4.5 8a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5zm2.5.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5zm3.5-.5a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5z"/><path d="M2 1a1 1 0 0 1 1-1h10a1 1 0 0 1 1 1v14a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1zm11 0H3v14h3v-2.5a.5.5 0 0 1 .5-.5h3a.5.5 0 0 1 .5.5V15h3z"/></svg>';
                foreach ($allMenus as $menuItem) {
                    if (($menuItem->title === 'Profil Desa' || $menuItem->route_name === 'admin.setting-desa.edit') && (empty($menuItem->icon) || str_contains($menuItem->icon, 'M8 4.754') || str_contains($menuItem->icon, 'bi-gear'))) {
                        $menuItem->icon = $buildingSvg;
                        try {
                            \DB::table('menus')->where('id', $menuItem->id)->update(['icon' => $buildingSvg]);
                        } catch (\Throwable $e) {}
                    }
                }

                if (!$user->hasRole('Super Admin')) {
                    $allowedMenuIds = [];
                    foreach ($allMenus as $m) {
                        if ($m->is_header) continue;
                        $slugKey = \Illuminate\Support\Str::slug($m->title, '_');
                        $firstWordSlug = explode('_', $slugKey)[0];
                        $urlSlugClean = str_replace(['-index', '-create', '-edit'], '', trim(str_replace('/admin/', '', $m->url ?? ''), '/'));
                        $urlSlugClean = str_replace('-', '_', $urlSlugClean);
                        
                        // Check if user has view permission for this menu OR if menu roles match user's roles
                        $hasPerm = $user->can('view_' . $slugKey) 
                                || $user->can('view_' . $firstWordSlug)
                                || ($urlSlugClean && $user->can('view_' . $urlSlugClean))
                                || ($m->route_name && $user->can('view_' . str_replace('-', '_', $m->route_name)));
                        $hasRole = $m->roles->pluck('id')->intersect($user->roles->pluck('id'))->count() > 0;

                        if ($hasPerm || $hasRole) {
                            $allowedMenuIds[] = $m->id;
                        }
                    }

                    // Keep item menus that are allowed, and headers that have at least 1 allowed child item
                    $allMenus = $allMenus->filter(function($menu) use ($allowedMenuIds, $allMenus) {
                        if ($menu->is_header) {
                            $childIds = $allMenus->where('parent_id', $menu->id)->pluck('id')->toArray();
                            return count(array_intersect($childIds, $allowedMenuIds)) > 0;
                        }
                        return in_array($menu->id, $allowedMenuIds);
                    });
                }

                // Organize menus hierarchically
                $headers = $allMenus->where('is_header', true);
                
                foreach ($headers as $header) {
                    $children = $allMenus->where('parent_id', $header->id);
                    $header->children = $children;
                    $dynamicMenus->push($header);
                }

                // Add parentless top-level items that are not headers
                $parentless = $allMenus->where('is_header', false)->whereNull('parent_id');
                foreach ($parentless as $item) {
                    $dynamicMenus->push($item);
                }
                
                // Re-sort by order_num
                $dynamicMenus = $dynamicMenus->sortBy('order_num')->values();
            }

            $view->with('dynamicMenus', $dynamicMenus);
        });
    }
}