<?php


namespace Tests\MercadoPago\Responses;


use MercadoPago\Responses\IdentificationType;
use MercadoPago\Responses\IdentificationTypesResponse;
use Orchestra\Testbench\TestCase;

class IdentificationTypesResponseTest extends TestCase
{
    public function testParse()
    {
        $response = new IdentificationTypesResponse('
            [
              {
                "id": "CPF",
                "name": "CPF",
                "type": "number",
                "min_length": 11,
                "max_length": 11
              }
            ]
        ');

        self::assertEquals(1, $response->getItems()->count());

        /** @var IdentificationType $item */
        $item = $response->getItems()[0];
        self::assertEquals('CPF', $item->getId());
        self::assertEquals('CPF', $item->getName());
        self::assertEquals('number', $item->getType());
    }
}