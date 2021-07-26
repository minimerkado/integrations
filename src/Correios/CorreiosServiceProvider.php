<?php


namespace Correios;


use Correios\Contracts\CorreiosService;
use Illuminate\Support\ServiceProvider;

class CorreiosServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton(CorreiosService::class, function ($app) {
            return new CorreiosHttpService();
        });
    }

    public function boot()
    {

    }
}