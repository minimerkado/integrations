<?php

namespace RevenueCat;

use Illuminate\Support\ServiceProvider;
use RevenueCat\Contracts\RevenueCatService;

class RevenueCatServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton(RevenueCatService::class, function ($app) {
            $config = $app->make('config');
            return new RevenueCatHttpService($config->get('services.revenueCat', []));
        });
    }

    public function boot()
    {

    }
}
