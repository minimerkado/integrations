<?php


namespace RevenueCat\Events;


use RevenueCat\EventType;

class RenewalEvent extends RevenueCatEvent
{
    public function __construct(string $store, string $app_user_id, string $product_id)
    {
        parent::__construct(EventType::RENEWAL, $store, $app_user_id, $product_id);
    }
}