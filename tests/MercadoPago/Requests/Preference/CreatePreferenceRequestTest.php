<?php


namespace Tests\MercadoPago\Requests\Preference;


use Carbon\Carbon;
use MercadoPago\Requests\Preference\CreatePreferenceRequest;
use MercadoPago\Requests\Preference\Objects\Item;
use MercadoPago\Requests\Preference\Objects\Payer;
use MercadoPago\Requests\Preference\Objects\PaymentMethods;
use MercadoPago\Requests\Preference\Objects\Phone;
use MercadoPago\Requests\Preference\Objects\Shipments;
use Orchestra\Testbench\TestCase;

class CreatePreferenceRequestTest extends TestCase
{
    public function testToJson()
    {
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
            ->setShipments(Shipments::custom(15.0))
            ->setPaymentMethods((new PaymentMethods())
                ->setDefaultPaymentMethodId('credit_card')
                ->setInstallments(12)
                ->setDefaultInstallments(6))
            ->setAutoReturn(CreatePreferenceRequest::AUTO_RETURN_ALL)
            ->setSuccessBackUrl('https://example.com/webhook/mercadopago/success')
            ->setFailureBackUrl('https://example.com/webhook/mercadopago/failure')
            ->setNotificationUrl('https://example.com/webhook/mercadopago/notification')
            ->setAdditionalInfo('Some info')
            ->setExpires(true)
            ->setDateOfExpiration(Carbon::parse('2021-01-10T00:00:00Z'))
            ->setExpirationDateFrom(Carbon::parse('2021-01-01T00:00:00Z'))
            ->setExpirationDateTo(Carbon::parse('2021-01-10T00:00:00Z'));

        self::assertEquals([
            'items' => [
                [
                    'title' => 'Nike Shorts',
                    'quantity' => 1,
                    'unit_price' => 350.0,
                    'currency' => 'BRL',
                ],
                [
                    'title' => 'Adidas Shoes',
                    'quantity' => 1,
                    'unit_price' => 250.0,
                    'currency' => 'BRL',
                ]
            ],
            'shipments' => [
                'mode' => 'not_specified',
                'cost' => 15.0
            ],
            'external_reference' => 'external123',
            'payer' => [
                'name' => 'John doe',
                'email' => 'johndoe@example.com',
                'phone' => [
                    'area_code' => '82',
                    'number' => '98888-0000',
                ]
            ],
            'payment_methods' => [
                'default_payment_method_id' => 'credit_card',
                'installments' => 12,
                'default_installments' => 6,
            ],
            'auto_return' => 'all',
            'back_urls' => [
                'success' => 'https://example.com/webhook/mercadopago/success',
                'failure' => 'https://example.com/webhook/mercadopago/failure',
            ],
            'notification_url' => 'https://example.com/webhook/mercadopago/notification',
            'additional_info' => 'Some info',
            'expires' => true,
            'date_of_expiration' => '2021-01-10T00:00:00+00:00',
            'expiration_date_from' => '2021-01-01T00:00:00+00:00',
            'expiration_date_to' => '2021-01-10T00:00:00+00:00',
        ], $request->toJson());
    }
}