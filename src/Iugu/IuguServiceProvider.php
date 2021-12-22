<?php

namespace Iugu;

use Illuminate\Support\ServiceProvider;
use Iugu\Contracts\IuguService;

class IuguServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(IuguService::class, function ($app) {
            $config = $app->make('config');
            return new IuguHttpService($config->get('services.iugu', []));
        });
    }

    public function boot()
    {

    }
}