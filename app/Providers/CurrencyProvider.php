<?php

namespace App\Providers;

use App\Services\Currency\CurrencyService;
use App\Services\ExternalApi\CurrencyApi;
use Illuminate\Support\ServiceProvider;

class CurrencyProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(CurrencyService::class, function ($app) {
            return new CurrencyService($app->make(CurrencyApi::class));
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
