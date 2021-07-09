<?php


namespace Tests\RevenueCat;


use Orchestra\Testbench\TestCase;

abstract class RevenueCatTest extends TestCase
{
    protected function sample(): array
    {
        return $json = json_decode('
            {
              "api_version": "1.0",
              "event": {
                "aliases": [
                  "yourCustomerAliasedID",
                  "yourCustomerAliasedID"
                ],
                "app_user_id": "yourCustomerAppUserID",
                "currency": "USD",
                "entitlement_id": "pro_cat",
                "entitlement_ids": [
                  "pro_cat"
                ],
                "environment": "PRODUCTION",
                "event_timestamp_ms": 1591121855319,
                "expiration_at_ms": 1591726653000,
                "id": "UniqueIdentifierOfEvent",
                "is_family_share": false,
                "original_app_user_id": "OriginalAppUserID",
                "original_transaction_id": "1530648507000",
                "period_type": "NORMAL",
                "presented_offering_id": "OfferingID",
                "price": 2.49,
                "price_in_purchased_currency": 2.49,
                "product_id": "onemonth_no_trial",
                "purchased_at_ms": 1591121853000,
                "store": "APP_STORE",
                "subscriber_attributes": {
                  "$Favorite Cat": {
                    "updated_at_ms": 1581121853000,
                    "value": "Garfield"
                  }
                },
                "takehome_percentage": 0.7,
                "transaction_id": "170000869511114",
                "type": "INITIAL_PURCHASE"
              }
            }
        ', true);
    }
}