<?php


namespace Tests\PagSeguro\Http;


use Illuminate\Support\Facades\Event;
use Orchestra\Testbench\TestCase;
use PagSeguro\Events\TransactionStatusChanged;
use PagSeguro\Facades\PagSeguro;

class WebhookControllerTest extends TestCase
{

    protected function setUp(): void
    {
        parent::setUp();
        PagSeguro::routes();
    }

    function testHandle() {
        Event::fake([
            TransactionStatusChanged::class,
        ]);

        $this->post('/webhooks/pagseguro/REF1234', [
            'notificationCode' => 'CODE1234'
        ])->assertStatus(200);

        $this->post('/webhooks/pagseguro', [
            'notificationCode' => 'CODE1234'
        ])->assertStatus(404);

        $this->get('/webhooks/pagseguro/REF1234', [
            'notificationCode' => 'CODE1234'
        ])->assertStatus(405);

        Event::assertDispatched(TransactionStatusChanged::class, fn ($e) => $e->reference === 'REF1234' && $e->code === 'CODE1234');
    }

    function testNotificationUrl()
    {
        self::assertEquals('https://minimerkado.test/webhooks/pagseguro/REF1234', PagSeguro::notificationUrl('REF1234'));
    }
}