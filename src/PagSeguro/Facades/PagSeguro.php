<?php

namespace PagSeguro\Facades;


use Illuminate\Support\Facades\Facade;

class PagSeguro extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'pagseguro';
    }
}