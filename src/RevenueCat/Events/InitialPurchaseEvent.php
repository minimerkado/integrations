<?php


namespace RevenueCat\Events;


use RevenueCat\EventType;

class InitialPurchaseEvent extends RevenueCatEvent
{
    public function __construct()
    {
        parent::__construct(EventType::INITIAL_PURCHASE);
    }
}