<?php


namespace RevenueCat;


abstract class CancellationReason
{
    const UNSUBSCRIBE = 'UNSUBSCRIBE';
    const BILLING_ERROR = 'BILLING_ERROR';
    const DEVELOPER_INITIATED = 'DEVELOPER_INITIATED';
    const PRICE_INCREASE = 'PRICE_INCREASE';
    const CUSTOMER_SUPPORT = 'CUSTOMER_SUPPORT';
    const UNKNOWN = 'UNKNOWN';
}