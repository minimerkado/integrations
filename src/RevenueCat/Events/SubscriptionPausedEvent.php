<?php


namespace RevenueCat\Events;


use RevenueCat\EventType;

class SubscriptionPausedEvent extends RevenueCatEvent
{
    public function __construct()
    {
        parent::__construct(EventType::SUBSCRIPTION_PAUSED);
    }
}