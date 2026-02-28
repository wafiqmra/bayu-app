<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL; // Baris ini jangan sampai ketinggalan!

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
        /**
         * Memaksa Laravel menggunakan skema HTTPS saat berjalan di Vercel.
         * Ini akan menghilangkan peringatan "Not Secure" dan error 419 Page Expired
         * karena form akan dikirimkan melalui jalur yang aman.
         */
        if (config('app.env') === 'production') {
            URL::forceScheme('https');
        }
    }
}