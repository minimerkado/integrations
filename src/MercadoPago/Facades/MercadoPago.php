<?php


namespace MercadoPago\Facades;


use Illuminate\Support\Facades\Facade;

class MercadoPago extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'mercadopago';
    }
}