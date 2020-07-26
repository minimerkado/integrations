<?php


namespace Tests\PagSeguro\Responses;


use Carbon\Carbon;
use Orchestra\Testbench\TestCase;
use PagSeguro\Responses\CheckoutResponse;

class CheckoutResponseTest extends TestCase
{
    function testParse()
    {
        $response = new CheckoutResponse('<?xml version="1.0" encoding="ISO-8859-1" standalone="yes"?>
            <checkout>
            <code>36E9E393B7B77B0FF4DA7F8C6A635181</code>
            <date>2020-07-19T23:23:10.000-03:00</date>
        </checkout>');

        self::assertEquals('36E9E393B7B77B0FF4DA7F8C6A635181', $response->getCode());
        self::assertEquals(Carbon::parse('2020-07-19T23:23:10.000-03:00'), $response->getDate());
    }
}