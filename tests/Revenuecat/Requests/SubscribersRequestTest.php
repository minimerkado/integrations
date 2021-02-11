<?php


namespace Tests\Revenuecat\Requests;


use Orchestra\Testbench\TestCase;
use Revenuecat\Requests\SubscribersRequest;

class SubscribersRequestTest extends TestCase
{
    function testSubscriberRequest()
    {
        $request1 = new SubscribersRequest('app_user_id');

        self::assertEquals('GET', $request1->getMethod());
        self::assertEquals('/v1/subscribers/app_user_id', $request1->getPath());
    }
}