<?php

namespace App\Providers;

use App\Support\SidebarNavigation;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton('nav', fn () => new SidebarNavigation());
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        
    }
}
