<?php


namespace RevenueCat\Events;


use RevenueCat\EventType;

class TestEvent extends RevenueCatEvent
{
    public function __construct(string $store, string $app_user_id, string $product_id)
    {
        parent::__construct(EventType::TEST, $store, $app_user_id, $product_id);
    }
}