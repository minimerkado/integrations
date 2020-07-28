<?php

namespace PicPay;

use Illuminate\Support\ServiceProvider;

class PicPayServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton('picpay', function ($app) {
            $config = $app->make('config');

            $serviceConfig = new Configuration($config->get('services.picpay', []));
            return new PicPayHttpService($serviceConfig);
        });
    }

    public function boot()
    {

    }
}