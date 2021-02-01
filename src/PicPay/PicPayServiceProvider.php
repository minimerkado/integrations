<?php

namespace PicPay;

use Illuminate\Support\ServiceProvider;

class PicPayServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton('picpay', function ($app) {
            return new RevenuecatHttpService();
        });
    }

    public function boot()
    {

    }
}