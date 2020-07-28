<?php

namespace PicPay\Facades;


use Illuminate\Support\Facades\Facade;

class PicPay extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'picpay';
    }
}