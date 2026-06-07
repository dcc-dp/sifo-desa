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
    }
}