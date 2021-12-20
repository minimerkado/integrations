<?php

namespace MelhorEnvio;

use Illuminate\Support\ServiceProvider;
use MelhorEnvio\Contracts\MelhorEnvioService;
use MercadoPago\MercadoPagoHttpService;

class MelhorEnvioServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton(MelhorEnvioService::class, function ($app) {
            $config = $app->make('config');
            return new MercadoPagoHttpService($config->get('services.melhorEnvio', []));
        });
    }

    public function boot()
    {

    }
}