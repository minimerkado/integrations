<?php


namespace Tests\PicPay\Responses;


use Orchestra\Testbench\TestCase;
use PicPay\Responses\StatusResponse;

class StatusResponseTest extends TestCase
{
    function testParse()
    {
        $response = new StatusResponse('
            {
                "authorizationId": "555008cef7f321d00ef236333",
                "referenceId": "102030",
                "status": "paid"
            }
        ');

        self::assertEquals('102030', $response->getReferenceId());
        self::assertEquals('paid', $response->getStatus());
        self::assertEquals('555008cef7f321d00ef236333', $response->getAuthorizationId());
    }
}