<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL;
use Illuminate\Pagination\Paginator; // Tambahkan ini

class AppServiceProvider extends ServiceProvider
{
    public function register(): void { }

    public function boot(): void
    {
        // Gunakan Tailwind untuk pagination
        Paginator::useTailwind();

        if (config('app.env') === 'production') {
            URL::forceScheme('https');
        }
    }
}