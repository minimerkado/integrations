<?php


namespace Tests\PicPay\Requests;


use Orchestra\Testbench\TestCase;
use PicPay\Requests\CancelRequest;

class CancelRequestTest extends TestCase
{
    function testCancelRequest()
    {
        $request1 = new CancelRequest('token12345', 'order12345');

        self::assertEquals('POST', $request1->getMethod());
        self::assertEquals('/payments/order12345/cancellations', $request1->getPath());
        self::assertEquals([
            'headers' => [
                'x-picpay-token' => 'token12345',
            ]
        ], $request1->build());

        $request2 = (new CancelRequest('token12345', 'order12345'))
            ->setAuthorizationId('auth12345');

        self::assertEquals('/payments/order12345/cancellations', $request2->getPath());
        self::assertEquals([
            'headers' => [
                'x-picpay-token' => 'token12345',
            ],
            'json' => [
                'authorizationId' => 'auth12345',
            ],
        ], $request2->build());
    }
}