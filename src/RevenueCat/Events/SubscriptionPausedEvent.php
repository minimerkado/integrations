<?php


namespace RevenueCat\Events;


use RevenueCat\EventType;

class SubscriptionPausedEvent extends RevenueCatEvent
{
    public function __construct(string $store, string $app_user_id, string $product_id)
    {
        parent::__construct(EventType::SUBSCRIPTION_PAUSED, $store, $app_user_id, $product_id);
    }
}