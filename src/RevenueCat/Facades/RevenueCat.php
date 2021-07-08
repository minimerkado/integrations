<?php

namespace RevenueCat\Facades;


use Illuminate\Support\Facades\Facade;
use Illuminate\Support\Facades\Route;
use RevenueCat\Contracts\RevenueCatService;

class RevenueCat extends Facade
{
    protected static function getFacadeAccessor()
    {
        return RevenueCatService::class;
    }

    private static function prefix()
    {
        return config('services.revenueCat.webhook.prefix', '/webhooks/revenuecat');
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
                    'uses' => config('services.revenuecat.webhook.handler', '\RevenueCat\Http\WebhookController@handle'),
                    'as' => 'webhook.revenuecat',
                ]);
            });
    }
}
