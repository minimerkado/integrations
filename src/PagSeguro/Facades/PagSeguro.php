<?php

namespace PagSeguro\Facades;


use Illuminate\Support\Facades\Facade;
use Illuminate\Support\Facades\Route;
use PagSeguro\PagSeguroFakeService;

class PagSeguro extends Facade
{
    public static function fake()
    {
        static::swap($fake = new PagSeguroFakeService());
        return $fake;
    }

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
    public static function notificationUrl($reference, bool $force_https = true): string
    {
        $url = route('webhook.pagseguro', ['ref' => $reference]);

        if ($force_https)
            return str_replace('http://', 'https://', $url);

        return $url;
    }

    /**
     * Binds PagSeguro webhook routes.
     *
     * @param array $middleware middleware config for this route
     */
    public static function routes($middleware = [])
    {
        Route::prefix(self::prefix())->middleware($middleware)->group(function ($router) {
            $router->post('/{ref}', [
                'uses' => config('services.pagseguro.webhook.handler', '\PagSeguro\Http\WebhookController@handle'),
                'as' => 'webhook.pagseguro',
            ]);
        });
    }
}