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

    /**
     * Binds the Iugu webhook routes.
     *
     * @param  array  $options
     * @return void
     */
    public static function routes(array $options = [])
    {
        $defaultOptions = [
            'prefix' => '/webhooks/pagseguro',
            'namespace' => '\PagSeguro\Http',
        ];

        $options = array_merge($defaultOptions, $options);

        Route::group($options, function ($router) {
            $router->any('/', [
                'uses' => 'WebhookController@handle',
                'as' => 'pagseguro.webhook.handle',
            ]);
        });
    }
}