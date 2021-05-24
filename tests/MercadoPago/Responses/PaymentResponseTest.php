<?php


namespace Tests\MercadoPago\Responses;


use MercadoPago\Responses\PaymentResponse;
use Orchestra\Testbench\TestCase;

class PaymentResponseTest extends TestCase
{
    public function testParse()
    {
        $response = new PaymentResponse('
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

        self::assertEquals('1', $response->getId());
        self::assertEquals('approved', $response->getStatus());
        self::assertEquals('2017-08-31 11:26:38', $response->getDateCreated()->toDateTimeString());
        self::assertEquals('2017-08-31 11:26:38', $response->getDateApproved()->toDateTimeString());
    }
}