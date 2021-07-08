<?php


namespace RevenueCat\Events;


use RevenueCat\EventType;

class RenewalEvent extends RevenueCatEvent
{
    public function __construct()
    {
        parent::__construct(EventType::RENEWAL);
    }
}