<?php


namespace RevenueCat\Events;


use RevenueCat\EventType;

class CancellationEvent extends RevenueCatEvent
{
    public function __construct(string $store, string $app_user_id, string $product_id, string $reason)
    {
        parent::__construct(EventType::CANCELLATION, $store, $app_user_id, $product_id, ['reason' => $reason]);
    }

}