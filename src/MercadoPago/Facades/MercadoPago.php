<?php


namespace MercadoPago\Facades;


use Illuminate\Support\Facades\Facade;
use Illuminate\Support\Facades\Route;
use MercadoPago\MercadoPagoFakeService;

class MercadoPago extends Facade
{
    public static function fake()
    {
        static::swap($fake = new MercadoPagoFakeService());
        return $fake;
    }

    protected static function getFacadeAccessor()
    {
        return 'mercadopago';
    }

    private static function prefix()
    {
        return config('services.mercadopago.webhook.prefix', '/webhooks/mercadopago');
    }

    /**
     * Get notification url
     *
     * @param string $reference
     * @return string
     */
    public static function notificationUrl($reference): string
    {
        return config('app.url') . self::prefix() . "/$reference";
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
                'uses' => config('services.mercadopago.webhook.handler', '\MercadoPago\Http\WebhookController@handle'),
                'as' => 'mercadopago.webhook.handle',
            ]);
        });
    }
}