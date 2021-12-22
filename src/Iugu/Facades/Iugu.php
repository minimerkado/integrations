<?php

namespace Iugu\Facades;

use Illuminate\Support\Facades\Facade;
use Illuminate\Support\Facades\Route;
use Iugu\Contracts\IuguService;

class Iugu extends Facade
{
    protected static function getFacadeAccessor()
    {
        return IuguService::class;
    }

    private static function prefix()
    {
        return config('services.iugu.webhook.prefix', '/webhooks/iugu');
    }

    /**
     * Binds PagSeguro webhook routes.
     *
     * @param array $middleware middleware config for this route
     */
    public static function routes(array $middleware = [])
    {
        Route::prefix(self::prefix())
            ->middleware($middleware)
            ->group(function ($router) {
                $router->post('/', [
                    'uses' => config('services.iugu.webhook.handler', '\Iugu\Http\WebhookController@handle'),
                    'as' => 'webhook.iugu',
                ]);
            });
    }
}