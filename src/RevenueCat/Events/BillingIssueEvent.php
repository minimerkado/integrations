<?php


namespace RevenueCat\Events;


use RevenueCat\EventType;

class BillingIssueEvent extends RevenueCatEvent
{
    public function __construct()
    {
        parent::__construct(EventType::BILLING_ISSUE);
    }
}