<?php


namespace MercadoPago;


use Illuminate\Support\ServiceProvider;

class MercadoPagoServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton('mercadopago', function ($app) {
            return new MercadoPagoHttpService();
        });
    }

    public function boot()
    {

    }
}