<?php


namespace MercadoPago;


use MercadoPago\Contracts\MercadoPagoService;
use MercadoPago\Requests\GetIdentificationTypesRequest;
use MercadoPago\Requests\Payment\GetPaymentRequest;
use MercadoPago\Requests\Preference\CreatePreferenceRequest;
use MercadoPago\Responses\IdentificationTypesResponse;
use MercadoPago\Responses\PaymentResponse;
use MercadoPago\Responses\PreferenceResponse;

class MercadoPagoFakeService implements MercadoPagoService
{
    public function createPreference(CreatePreferenceRequest $request): PreferenceResponse
    {
        return new PreferenceResponse('
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
    }

    public function getIdentificationTypes(GetIdentificationTypesRequest $request): IdentificationTypesResponse
    {
        return new IdentificationTypesResponse('
          [
            {
              "id": "CPF",
              "name": "CPF",
              "type": "number",
              "min_length": 11,
              "max_length": 11
            }
          ]
        ');
    }

    public function getPayment(GetPaymentRequest $request): PaymentResponse
    {
        return new PaymentResponse('
          {
            "id": 1,
            "date_created": "2017-08-31T11:26:38.000Z",
            "date_approved": "2017-08-31T11:26:38.000Z",
            "date_last_updated": "2017-08-31T11:26:38.000Z",
            "money_release_date": "2017-09-14T11:26:38.000Z",
            "payment_method_id": "account_money",
            "payment_type_id": "credit_card",
            "status": "approved",
            "status_detail": "accredited",
            "currency_id": "BRL",
            "description": "Pago Pizza",
            "collector_id": 2,
            "payer": {
              "id": 123,
              "email": "afriend@gmail.com",
              "identification": {
                "type": "DNI",
                "number": 12345678
              },
              "type": "customer"
            },
            "metadata": {},
            "additional_info": {},
            "order": {},
            "transaction_amount": 250,
            "transaction_amount_refunded": 0,
            "coupon_amount": 0,
            "transaction_details": {
              "net_received_amount": 250,
              "total_paid_amount": 250,
              "overpaid_amount": 0,
              "installment_amount": 250
            },
            "installments": 1,
            "card": {}
          }
        ');
    }
}