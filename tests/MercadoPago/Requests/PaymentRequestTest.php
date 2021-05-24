<?php


namespace Tests\MercadoPago\Requests;


use MercadoPago\Requests\Payment\GetPaymentRequest;
use Orchestra\Testbench\TestCase;

class PaymentRequestTest extends TestCase
{
    public function testPathAndMethod()
    {
        $request = new GetPaymentRequest('token12345', 'id12345');
        self::assertEquals('/v1/payments/id12345', $request->getPath());
        self::assertEquals('GET', $request->getMethod());
    }

    public function testBuild()
    {
        $request = new GetPaymentRequest('token12345', 'id12345');
        self::assertEquals([
            'headers' => [
                'Authorization' => 'Bearer token12345',
                'Accept' => 'application/json'
            ]
        ] , $request->build());
    }
}