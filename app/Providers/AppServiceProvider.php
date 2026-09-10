<?php

namespace App\Providers;

use App\Support\SidebarNavigation;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    /**
     * Register any application services.
     */
    {
        $this->app->singleton('nav', fn () => new SidebarNavigation());
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Paksa HTTPS jika aplikasi berjalan di environment production
        if ($this->app->environment('production')) {
            URL::forceHttps();
        }
    }
}