<?php


namespace Tests\Revenuecat\Responses;


use Carbon\Carbon;
use Orchestra\Testbench\TestCase;
use Revenuecat\Responses\SubscribersResponse;

class SubscribersResponseTest extends TestCase
{
    function testParse()
    {
        $response = new SubscribersResponse('
            {
                "request_date": "2019-07-26T17:40:10Z",
                "request_date_ms": 1564162810884,
                "subscriber": {
                    "entitlements": {
                        "pro_cat": {
                            "expires_date": null,
                            "product_identifier": "onetime",
                            "purchase_date": "2019-04-05T21:52:45Z"
                        }
                    },
                    "first_seen": "2019-02-21T00:08:41Z",
                    "non_subscriptions": {
                        "onetime": [
                            {
                                "id": "cadba0c81b",
                                "is_sandbox": true,
                                "purchase_date": "2019-04-05T21:52:45Z",
                                "store": "app_store"
                            }
                        ]
                    },
                    "original_app_user_id": "XXX-XXXXX-XXXXX-XX",
                    "original_application_version": "1.0",
                    "other_purchases": {
                        "onetime": {
                            "purchase_date": "2019-04-05T21:52:45Z"
                        }
                    },
                    "subscriptions": {
                        "annual": {
                            "billing_issues_detected_at": null,
                            "expires_date": "2019-06-14T21:07:40Z",
                            "is_sandbox": true,
                            "original_purchase_date": "2019-02-21T00:42:05Z",
                            "period_type": "normal",
                            "purchase_date": "2019-06-14T20:07:40Z",
                            "store": "app_store",
                            "unsubscribe_detected_at": "2019-06-17T22:48:38Z"
                        },
                        "onemonth": {
                            "billing_issues_detected_at": null,
                            "expires_date": "2019-06-17T22:47:55Z",
                            "is_sandbox": true,
                            "original_purchase_date": "2019-02-21T00:42:05Z",
                            "period_type": "normal",
                            "purchase_date": "2019-06-17T22:42:55Z",
                            "store": "app_store",
                            "unsubscribe_detected_at": "2019-06-17T22:48:38Z"
                        },
                        "rc_promo_pro_cat_monthly": {
                            "billing_issues_detected_at": null,
                            "expires_date": "2019-08-26T01:02:16Z",
                            "is_sandbox": false,
                            "original_purchase_date": "2019-07-26T01:02:16Z",
                            "period_type": "normal",
                            "purchase_date": "2019-07-26T01:02:16Z",
                            "store": "promotional",
                            "unsubscribe_detected_at": null
                        }
                    }
                }
            }
        ');

        $entitlements = $response->getEntitlements()[0];
        self::assertEquals('pro_cat', $entitlements->getId());
        self::assertEquals(null, $entitlements->getExpiresDate());
        self::assertEquals('onetime', $entitlements->getProductIdentifier());
        self::assertEquals(Carbon::parse("2019-04-05T21:52:45Z"), $entitlements->getPurchaseDate());

        $subscriptions = $response->getSubscriptions()[0];
        self::assertEquals('annual', $subscriptions->getId());
        self::assertEquals(null, $subscriptions->getBillingIssuesDetectedAt());
        self::assertEquals(Carbon::parse("2019-06-14T21:07:40Z"), $subscriptions->getExpiresDate());
        self::assertEquals(true, $subscriptions->getIsSandbox());
        self::assertEquals(Carbon::parse("2019-02-21T00:42:05Z"), $subscriptions->getOriginalPurchaseDate());
        self::assertEquals("normal", $subscriptions->getPeriodType());
        self::assertEquals(Carbon::parse("2019-06-14T20:07:40Z"), $subscriptions->getPurchaseDate());
        self::assertEquals("app_store", $subscriptions->getStore());
        self::assertEquals(Carbon::parse("2019-06-17T22:48:38Z"), $subscriptions->getUnsubscribeDetectedAt());

        $subscriptions2 = $response->getSubscriptions()[1];
        self::assertEquals('onemonth', $subscriptions2->getId());
        self::assertEquals(null, $subscriptions2->getBillingIssuesDetectedAt());
        self::assertEquals(Carbon::parse("2019-06-17T22:47:55Z"), $subscriptions2->getExpiresDate());
        self::assertEquals(true, $subscriptions2->getIsSandbox());
        self::assertEquals(Carbon::parse("2019-02-21T00:42:05Z"), $subscriptions2->getOriginalPurchaseDate());
        self::assertEquals("normal", $subscriptions2->getPeriodType());
        self::assertEquals(Carbon::parse("2019-06-17T22:42:55Z"), $subscriptions2->getPurchaseDate());
        self::assertEquals("app_store", $subscriptions2->getStore());
        self::assertEquals(Carbon::parse("2019-06-17T22:48:38Z"), $subscriptions2->getUnsubscribeDetectedAt());

    }
}