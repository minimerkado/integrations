<?php


namespace Tests\MercadoPago\Responses;


use Carbon\Carbon;
use MercadoPago\Responses\PreferenceResponse;
use Orchestra\Testbench\TestCase;

class PreferenceResponseTest extends TestCase
{
    public function testParse()
    {
        $response = new PreferenceResponse('
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
        ');

        self::assertEquals('202809963-920c288b-4ebb-40be-966f-700250fa5370', $response->getId());
        self::assertEquals('https://www.mercadopago.com/mla/checkout/start?pref_id=202809963-920c288b-4ebb-40be-966f-700250fa5370', $response->getInitPoint());
        self::assertEquals(Carbon::parse('2018-02-02T15:22:23.535-04:00'), $response->getDateCreated());
    }
}