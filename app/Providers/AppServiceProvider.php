<?php

namespace App\Providers;

use App\Models\Kategori;
use App\Models\Setting;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        if (Schema::hasTable('kategoris')) {
            View::share(
                'menuKategoris',
                Kategori::orderBy('nama_kategori')->get()
            );
        } else {
            View::share('menuKategoris', collect());
        }

        View::composer('layouts.user', function ($view) {
            $setting = null;

            if (Schema::hasTable('settings')) {
                $setting = Setting::first();
            }

            $view->with('setting', $setting);
        });
    }
}