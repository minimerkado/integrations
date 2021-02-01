<?php

namespace PicPay;

use Illuminate\Support\ServiceProvider;

class RevenuecatServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton('revenuecat', function ($app) {
            $config = $app->make('config');
            return new RevenuecatHttpService($config->get('services.revenuecat', []));
        });
    }
    public function boot()
    {

    }
}