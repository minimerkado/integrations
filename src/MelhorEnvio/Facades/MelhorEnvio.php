<?php

namespace MelhorEnvio\Facades;

use Illuminate\Support\Facades\Facade;
use Illuminate\Support\Facades\Route;
use MelhorEnvio\Contracts\MelhorEnvioService;

class MelhorEnvio extends Facade
{
    protected static function getFacadeAccessor()
    {
        return MelhorEnvioService::class;
    }

    /**
     * Binds PagSeguro webhook routes.
     *
     * @param array $middleware middleware config for this route
     */
    public static function routes(array $middleware = [])
    {
        $handler = config('services.melhorEnvio.webhook.handler', '\MelhorEnvio\Http\WebhookController@handle');

        Route::prefix(self::prefix())
            ->middleware($middleware)
            ->group(fn ($router) =>
                $router->post('/', [
                    'uses' => $handler,
                    'as' => 'webhook.melhorenvio',
                ])
            );
    }
}