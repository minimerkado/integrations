<?php

namespace RevenueCat\Facades;


use Illuminate\Support\Facades\Facade;

class RevenueCat extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'revenuecat';
    }
}
