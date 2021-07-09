<?php


namespace Tests\RevenueCat\Http;


use Carbon\Carbon;
use RevenueCat\Http\SubscriptionEvent;
use Tests\RevenueCat\RevenueCatTest;

class SubscriptionEventTest extends RevenueCatTest
{
    public function testParse()
    {
        $json = $this->sample();
        $event = new SubscriptionEvent($json);

        $this->assertEquals('APP_STORE', $event->getStore());
        $this->assertEquals('yourCustomerAppUserID', $event->getAppUserId());
        $this->assertEquals('onemonth_no_trial', $event->getProductId());
        $this->assertEquals('INITIAL_PURCHASE', $event->getType());
        $this->assertEquals(new Carbon('2020-06-02T18:17:33.000000+0000'), $event->getPurchasedAt());
        $this->assertEquals(new Carbon('2020-06-09T18:17:33.000000+0000'), $event->getExpirationAt());
    }
}