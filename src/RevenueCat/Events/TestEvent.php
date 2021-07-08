<?php


namespace RevenueCat\Events;


use RevenueCat\EventType;

class TestEvent extends RevenueCatEvent
{
    public function __construct()
    {
        parent::__construct(EventType::TEST);
    }
}