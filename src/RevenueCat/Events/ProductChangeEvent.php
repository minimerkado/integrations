<?php


namespace RevenueCat\Events;


use RevenueCat\EventType;

class ProductChangeEvent extends RevenueCatEvent
{
    public function __construct(string $store, string $app_user_id, string $product_id, string $new_product_id)
    {
        parent::__construct(EventType::PRODUCT_CHANGE, $store, $app_user_id, $product_id, [ 'new_product_id' => $new_product_id]);
    }
}