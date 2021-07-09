<?php


namespace RevenueCat\Events;


use RevenueCat\EventType;

class UncancellationEvent extends RevenueCatEvent
{
    public function __construct(string $store, string $app_user_id, string $product_id)
    {
        parent::__construct(EventType::UNCANCELLATION, $store, $app_user_id, $product_id);
    }
}