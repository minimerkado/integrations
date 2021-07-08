<?php


namespace RevenueCat\Events;


use RevenueCat\EventType;
use RevenueCat\Exceptions\RevenueCatException;

class CancellationEvent extends RevenueCatException
{
    public function __construct()
    {
        parent::__construct(EventType::CANCELLATION);
    }
}