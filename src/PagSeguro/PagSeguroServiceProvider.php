<?php

namespace PagSeguro;

use Illuminate\Support\ServiceProvider;

class PagSeguroServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton('pagseguro', function ($app) {
            $config = $app->make('config');
            return new PagSeguroHttpService($config->get('services.pagseguro', []));
        });
    }

    public function boot()
    {

    }
}