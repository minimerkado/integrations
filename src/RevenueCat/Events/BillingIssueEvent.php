<?php


namespace RevenueCat\Events;


use RevenueCat\EventType;

class BillingIssueEvent extends RevenueCatEvent
{
    public function __construct(string $store, string $app_user_id, string $product_id)
    {
        parent::__construct(EventType::BILLING_ISSUE, $store, $app_user_id, $product_id);
    }
}