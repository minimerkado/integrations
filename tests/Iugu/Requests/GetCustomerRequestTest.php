<?php

namespace Tests\Iugu\Requests;

use Iugu\Requests\Customer\GetCustomerRequest;
use Orchestra\Testbench\TestCase;

class GetCustomerRequestTest extends TestCase
{
    public function testRequest()
    {
        $request = new GetCustomerRequest('teste_1234');

        self::assertEquals('/customers/teste_1234', $request->getPath());
        self::assertEquals('GET', $request->getMethod());
    }
}