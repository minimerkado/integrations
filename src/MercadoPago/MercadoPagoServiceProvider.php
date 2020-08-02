<?php


namespace MercadoPago;


use Illuminate\Support\ServiceProvider;

class MercadoPagoServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton('mercadopago', function ($app) {
            $config = $app->make('config');
            return new MercadoPagoHttpService($config->get('services.mercadopago', []));
        });
    }

    public function boot()
    {

    }
}