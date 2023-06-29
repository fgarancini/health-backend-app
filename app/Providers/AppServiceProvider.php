<?php

namespace App\Providers;

use App\Interfaces\RegisterServiceInterface;
use App\Services\RegisterService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(RegisterServiceInterface::class, RegisterService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}