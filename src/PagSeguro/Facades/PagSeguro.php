<?php

namespace PagSeguro\Facades;


use Illuminate\Support\Facades\Facade;
use Illuminate\Support\Facades\Route;

class PagSeguro extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'pagseguro';
    }

    private static function prefix()
    {
        return config('services.pagseguro.webhook.prefix', '/webhooks/pagseguro');
    }

    /**
     * Get notification url
     *
     * @param array $options
     * @return string
     */
    public static function notificationUrl($reference): string
    {
        return config('app.url') . self::prefix() . "/$reference";
    }

    /**
     * Binds PagSeguro webhook routes.
     */
    public static function routes()
    {
        Route::prefix(self::prefix())->middleware('throttle:60,1')->group(function ($router) {
            $router->post('/{ref}', [
                'uses' => config('services.pagseguro.webhook.handler', '\PagSeguro\Http\WebhookController@handle'),
                'as' => 'pagseguro.webhook.handle',
            ]);
        });
    }
}