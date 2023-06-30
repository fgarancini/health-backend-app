<?php

namespace App\Providers;

use App\Interfaces\ApiMedicAuthInterface;
use App\Interfaces\LoginServiceInterface;
use App\Interfaces\PriaidApiServiceInterface;
use App\Interfaces\RegisterServiceInterface;
use App\Services\ApiMedicAuth;
use App\Services\LoginService;
use App\Services\PriaidApiService;
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
        $this->app->singleton(LoginServiceInterface::class, LoginService::class);
        $this->app->singleton(ApiMedicAuthInterface::class, ApiMedicAuth::class);
        $this->app->singleton(PriaidApiServiceInterface::class, PriaidApiService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}