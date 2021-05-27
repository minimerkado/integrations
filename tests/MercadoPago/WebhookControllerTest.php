<?php


namespace Tests\MercadoPago;


use Illuminate\Support\Facades\Event;
use MercadoPago\Events\PaymentCreated;
use MercadoPago\Events\PaymentUpdated;
use MercadoPago\Facades\MercadoPago;
use Orchestra\Testbench\TestCase;

class WebhookControllerTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        MercadoPago::routes();
    }

    function testHandleForPaymentCreated() {
        Event::fake([
            PaymentCreated::class,
        ]);

        $data = [
            'type' => 'payment',
            'action' => 'payment.created',
            'data' => [
                'id' => 'PAG1234'
            ]
        ];

        $this->post('/webhooks/mercadopago/REF1234', $data)->assertStatus(200);
        $this->post('/webhooks/mercadopago', $data)->assertStatus(404);
        $this->get('/webhooks/mercadopago/REF1234', $data)->assertStatus(405);

        Event::assertDispatched(PaymentCreated::class, fn ($e) => $e->reference === 'REF1234' && $e->payment_id === 'PAG1234');
    }

    function testHandleForPaymentUpdated() {
        Event::fake([
            PaymentUpdated::class,
        ]);

        $data = [
            'type' => 'payment',
            'action' => 'payment.updated',
            'data' => [
                'id' => 'PAG1234'
            ]
        ];

        $this->post('/webhooks/mercadopago/REF1234', $data)->assertStatus(200);
        $this->post('/webhooks/mercadopago', $data)->assertStatus(404);
        $this->get('/webhooks/mercadopago/REF1234', $data)->assertStatus(405);

        Event::assertDispatched(PaymentUpdated::class, fn ($e) => $e->reference === 'REF1234' && $e->payment_id === 'PAG1234');
    }

    function testNotificationUrl()
    {
        self::assertEquals('https://minimerkado.test/webhooks/mercadopago/REF1234', MercadoPago::notificationUrl('REF1234'));
    }
}