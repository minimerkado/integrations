<?php

namespace RevenueCat;

use Illuminate\Support\ServiceProvider;

class RevenueCatServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton('revenueCat', function ($app) {
            $config = $app->make('config');
            return new RevenueCatHttpService($config->get('services.revenueCat', []));
        });
    }

    public function boot()
    {

    }
}
