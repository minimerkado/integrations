<?php


namespace Tests\PicPay\Requests;


use Orchestra\Testbench\TestCase;
use PicPay\Requests\StatusRequest;

class StatusRequestTest extends TestCase
{
    function testStatusRequest()
    {
        $request = new StatusRequest('token12345', 'order12345');

        self::assertEquals('GET', $request->getMethod());
        self::assertEquals('/payments/order12345/status', $request->getPath());
        self::assertEquals([
            'headers' => [
                'x-picpay-token' => 'token12345',
            ]
        ], $request->build());
    }
}