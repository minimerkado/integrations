<?php

namespace Tests\Iugu\Responses;

use Iugu\Responses\CustomerResponse;
use Orchestra\Testbench\TestCase;

class CustomerResponseTest extends TestCase
{
    public function testParse()
    {
        $response = new CustomerResponse('{
          "id": "77C2565F6F064A26ABED4255894224F0",
          "email": "email@email.com",
          "name": "Nome do Cliente",
          "notes": "Anotações Gerais",
          "created_at": "2013-11-18T14:58:30-02:00",
          "updated_at": "2013-11-18T14:58:30-02:00",
          "custom_variables": []
        }');

        self::assertEquals('77C2565F6F064A26ABED4255894224F0' , $response->getId());
        self::assertEquals('email@email.com' , $response->getEmail());
        self::assertEquals('Nome do Cliente' , $response->getName());
    }
}