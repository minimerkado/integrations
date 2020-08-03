<?php


namespace Tests\MercadoPago;


use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Middleware;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;
use MercadoPago\Contracts\MercadoPagoService;
use MercadoPago\MercadoPagoHttpService;
use MercadoPago\Requests\Preference\CreatePreferenceRequest;
use MercadoPago\Requests\Preference\Objects\Item;
use MercadoPago\Requests\Preference\Objects\Payer;
use MercadoPago\Requests\Preference\Objects\Phone;
use MercadoPago\Requests\Preference\Objects\Shipments;
use Orchestra\Testbench\TestCase;

class MercadoPagoHttpServiceTest extends TestCase
{
    private array $history = [];
    private MockHandler $mock;
    private MercadoPagoService $service;

    public function setUp(): void
    {
        parent::setUp();
        $this->history = [];
        $this->mock = new MockHandler();
        $handlerStack = HandlerStack::create($this->mock);
        $handlerStack->push(Middleware::history($this->history));
        $client = new Client(['handler' => $handlerStack]);
        $this->service = new MercadoPagoHttpService($client);
    }

    function testCreatePreference()
    {
        $this->mock->append(new Response(200, [], '
            {
                "collector_id": 202809963,
                "operation_type": "regular_payment",
                "items": [
                    {
                        "id": "",
                        "picture_url": "",
                        "title": "Dummy Item",
                        "description": "Multicolor Item",
                        "category_id": "",
                        "currency_id": "[FAKER][CURRENCY][ACRONYM]",
                        "quantity": 1,
                        "unit_price": 10
                    }
                ],
                "payer": {
                    "name": "",
                    "surname": "",
                    "email": "",
                    "date_created": "",
                    "phone": {
                        "area_code": "",
                        "number": ""
                    },
                    "identification": {
                        "type": "",
                        "number": ""
                    },
                    "address": {
                        "street_name": "",
                        "street_number": null,
                        "zip_code": ""
                    }
                },
                "back_urls": {
                    "success": "",
                    "pending": "",
                    "failure": ""
                },
                "auto_return": "",
                "payment_methods": {
                    "excluded_payment_methods": [
                        {
                            "id": ""
                        }
                    ],
                    "excluded_payment_types": [
                        {
                            "id": ""
                        }
                    ],
                    "installments": null,
                    "default_payment_method_id": null,
                    "default_installments": null
                },
                "client_id": "6295877106812064",
                "marketplace": "MP-MKT-6295877106812064",
                "marketplace_fee": 0,
                "shipments": {
                    "receiver_address": {
                        "zip_code": "",
                        "street_number": null,
                        "street_name": "",
                        "floor": "",
                        "apartment": ""
                    }
                },
                "notification_url": null,
                "external_reference": "",
                "additional_info": "",
                "expires": false,
                "expiration_date_from": null,
                "expiration_date_to": null,
                "date_created": "2018-02-02T15:22:23.535-04:00",
                "id": "202809963-920c288b-4ebb-40be-966f-700250fa5370",
                "init_point": "https://www.mercadopago.com/mla/checkout/start?pref_id=202809963-920c288b-4ebb-40be-966f-700250fa5370",
                "sandbox_init_point": "https://sandbox.mercadopago.com/mla/checkout/pay?pref_id=202809963-920c288b-4ebb-40be-966f-700250fa5370"
            }
        '));

        $request = (new CreatePreferenceRequest('token12345'))
            ->setExternalReference('external123')
            ->addItem((new Item())
                ->setTitle('Nike Shorts')
                ->setQuantity(1)
                ->setUnitPrice(350.0))
            ->addItem((new Item())
                ->setTitle('Adidas Shoes')
                ->setQuantity(1)
                ->setUnitPrice(250.0))
            ->setPayer((new Payer())
                ->setName('John doe')
                ->setEmail('johndoe@example.com')
                ->setPhone(new Phone('82', '98888-0000')))
            ->setShipments(Shipments::custom(15.0, false))
            ->setNotificationUrl('https://example.com/webhook/mercadopago/notification');

        $response = $this->service->createPreference($request);

        /** @var Request $request */
        $request = $this->history[0]['request'];

        self::assertEquals('https://api.mercadopago.com//checkout/preferences?access_token=token12345', (string) $request->getUri());
        self::assertEquals('POST', $request->getMethod());
        self::assertEquals('202809963-920c288b-4ebb-40be-966f-700250fa5370', $response->getId());
        self::assertEquals('https://www.mercadopago.com/mla/checkout/start?pref_id=202809963-920c288b-4ebb-40be-966f-700250fa5370', $response->getInitPoint());
    }
}