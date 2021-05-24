<?php


namespace Tests\MercadoPago\Requests;


use MercadoPago\Requests\GetIdentificationTypesRequest;
use Orchestra\Testbench\TestCase;

class GetIdentificationTypesRequestTest extends TestCase
{
    public function testPathAndMethod()
    {
        $request = new GetIdentificationTypesRequest('token12345');
        self::assertEquals('/v1/identification_types', $request->getPath());
        self::assertEquals('GET', $request->getMethod());
    }

    public function testBuild()
    {
        $request = new GetIdentificationTypesRequest('token12345');
        self::assertEquals([
            'headers' => [
                'Authorization' => 'Bearer token12345',
                'Accept' => 'application/json'
            ]
        ] , $request->build());
    }
}