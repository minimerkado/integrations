<?php


namespace Correios\Facades;


use Correios\Contracts\CorreiosService;
use Correios\CorreiosFakeService;
use Illuminate\Support\Facades\Facade;

class Correios extends Facade
{
    protected static function getFacadeAccessor()
    {
        return CorreiosService::class;
    }

    public static function fake()
    {
        static::swap($fake = new CorreiosFakeService());
        return $fake;
    }
}