<?php

namespace PagSeguro;

use Illuminate\Support\ServiceProvider;

class PagSeguroServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton('pagseguro', function ($app) {
            $config = $app->make('config');

            $serviceConfig = new PagSeguroConfiguration($config->get('services.pagseguro'));
            return new PagSeguroHttpService($serviceConfig);
        });
    }

    public function boot()
    {

    }
}