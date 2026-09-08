<?php

namespace App\Providers;

use Illuminate\Support\Facades\URL;
use App\Models\Kategori;
use App\Models\Setting;
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
        // 1. Memaksa Laravel menggunakan HTTPS jika berjalan di server Railway (Production)
        if (config('app.env') === 'production' || env('APP_ENV') === 'production') {
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
                // If user is super admin, get all active menus
                // Otherwise, get menus that are assigned to user's roles
                if ($user->hasRole('Super Admin')) {
                    $allMenus = \App\Models\Menu::where('is_active', true)
                        ->orderBy('order_num')
                        ->get();
                } else {
                    $allMenus = \App\Models\Menu::where('is_active', true)
                        ->whereHas('roles', function($q) use ($user) {
                            $q->whereIn('roles.id', $user->roles->pluck('id'));
                        })
                        ->orderBy('order_num')
                        ->get();
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