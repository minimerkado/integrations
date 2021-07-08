<?php


namespace RevenueCat\Events;


use RevenueCat\EventType;

class NonRenewingPurchaseEvent extends RevenueCatEvent
{
    public function __construct()
    {
        parent::__construct(EventType::NON_RENEWING_PURCHASE);
    }
}