<?php


namespace Tests\PicPay\Responses;


use Orchestra\Testbench\TestCase;
use PicPay\Responses\SubscribersResponse;

class CancelResponseTest extends TestCase
{
    function testParse()
    {
        $response = new SubscribersResponse('
            {
              "referenceId": "102030",
              "cancellationId": "5b008cef7f321d00ef236444"
            }
        ');

        self::assertEquals('102030', $response->getReferenceId());
        self::assertEquals('5b008cef7f321d00ef236444', $response->getCancellationId());
    }
}