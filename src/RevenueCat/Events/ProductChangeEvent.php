<?php


namespace RevenueCat\Events;


use RevenueCat\EventType;

class ProductChangeEvent extends RevenueCatEvent
{
    public function __construct()
    {
        parent::__construct(EventType::PRODUCT_CHANGE);
    }
}