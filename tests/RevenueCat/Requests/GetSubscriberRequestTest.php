<?php


namespace Tests\RevenueCat\Requests;


use Orchestra\Testbench\TestCase;
use RevenueCat\Requests\GetSubscriberRequest;

class GetSubscriberRequestTest extends TestCase
{
    function testSubscriberRequest()
    {
        $request1 = new GetSubscriberRequest('app_user_id');

        self::assertEquals('GET', $request1->getMethod());
        self::assertEquals('/v1/subscribers/app_user_id', $request1->getPath());
    }
}