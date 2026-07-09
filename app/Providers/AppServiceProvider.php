<?php

namespace App\Providers;

use App\Repositories\EloquentPembayaranRepository;
use App\Repositories\PembayaranRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(PembayaranRepository::class, EloquentPembayaranRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
