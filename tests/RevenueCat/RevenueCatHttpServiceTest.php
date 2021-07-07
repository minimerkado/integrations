<?php


namespace Tests\RevenueCat;


use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Middleware;
use GuzzleHttp\Psr7\Response;
use Orchestra\Testbench\TestCase;
use RevenueCat\RevenueCatHttpService;

class RevenueCatHttpServiceTest extends TestCase
{
    private array $history = [];
    private MockHandler $mock;
    private RevenueCatHttpService $service;

    public function setUp(): void
    {
        parent::setUp();
        $this->history = [];
        $this->mock = new MockHandler();
        $handlerStack = HandlerStack::create($this->mock);
        $handlerStack->push(Middleware::history($this->history));
        $client = new Client(['handler' => $handlerStack]);
        $this->service = new RevenueCatHttpService(['api_key' => 'teste'], $client);
    }


    function testGet()
    {
        $this->mock->append(new Response(200, [], '
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
        '));

        $response = $this->service->getSubscriber('token12345');

        $request = $this->history[0]['request'];
        self::assertEquals('GET', $request->getMethod());
        self::assertEquals('https://api.revenuecat.com/v1/subscribers/token12345', (string) $request->getUri());
        self::assertNotNull( $response->getEntitlements());
        self::assertNotNull( $response->getSubscriptions());
    }
}