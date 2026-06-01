<?php

namespace App\Providers;

use App\Models\Kategori;
use App\Models\Setting;
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
        View::share('menuKategoris', Kategori::orderBy('nama_kategori')->get());

        View::composer('layouts.user', function ($view) {
            $view->with('setting', Setting::first());
        });
    }
}