<?php

namespace Revenuecat\Facades;


use Illuminate\Support\Facades\Facade;

class Revenuecat extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'revenuecat';
    }
}