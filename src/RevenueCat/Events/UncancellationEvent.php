<?php


namespace RevenueCat\Events;


use RevenueCat\EventType;

class UncancellationEvent extends RevenueCatEvent
{
    public function __construct()
    {
        parent::__construct(EventType::UNCANCELLATION);
    }
}