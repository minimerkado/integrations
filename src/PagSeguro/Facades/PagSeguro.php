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

    private static function getOptions()
    {
        return [
            'prefix' => config('services.pagseguro.webhook.prefix', '/webhooks/pagseguro'),
        ];
    }

    /**
     * Get notification url
     *
     * @param array $options
     * @return string
     */
    function notificationUrl(array $options = []): string
    {
        $options = self::getOptions();
        return config('app.url') . $options['prefix'];
    }

    /**
     * Binds PagSeguro webhook routes.
     */
    public static function routes()
    {
        Route::group(self::getOptions(), function ($router) {
            $router->post('/', [
                'uses' => config('services.pagseguro.webhook.handler', '\PagSeguro\Http\WebhookController@handle'),
                'as' => 'pagseguro.webhook.handle',
            ]);
        });
    }
}