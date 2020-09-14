<?php


namespace Tests\PagSeguro\Http;


use Illuminate\Support\Facades\Event;
use Orchestra\Testbench\TestCase;
use PagSeguro\Events\TransactionStatusChanged;
use PagSeguro\Facades\PagSeguro;

class WebhookcontrollerTest extends TestCase
{
    function testHandle() {
        PagSeguro::routes();

        Event::fake([
            TransactionStatusChanged::class,
        ]);

        $this->post('/webhooks/pagseguro', [
            'notificationCode' => 'CODE1234'
        ])->assertStatus(200);

        $this->get('/webhooks/pagseguro', [
            'notificationCode' => 'CODE1234'
        ])->assertStatus(405);

        Event::assertDispatched(TransactionStatusChanged::class, fn ($e) => $e->code === 'CODE1234');
    }
}