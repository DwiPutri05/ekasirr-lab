<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL;

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
        // Force HTTPS saat production (Railway)
        if (env('APP_ENV') === 'production') {
            URL::forceScheme('https');
        }

        // Helper function untuk format Rupiah
        require_once app_path('Helpers/helpers.php');
    }
}