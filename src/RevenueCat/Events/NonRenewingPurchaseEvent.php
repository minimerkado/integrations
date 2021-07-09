<?php


namespace RevenueCat\Events;


use RevenueCat\EventType;

class NonRenewingPurchaseEvent extends RevenueCatEvent
{
    public function __construct(string $store, string $app_user_id, string $product_id)
    {
        parent::__construct(EventType::NON_RENEWING_PURCHASE, $store, $app_user_id, $product_id);
    }
}