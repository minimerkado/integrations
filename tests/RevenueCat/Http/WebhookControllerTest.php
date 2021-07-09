<?php


namespace Tests\RevenueCat\Http;


use Illuminate\Support\Facades\Event;
use RevenueCat\Events\InitialPurchaseEvent;
use RevenueCat\EventType;
use RevenueCat\Facades\RevenueCat;
use Tests\RevenueCat\RevenueCatTest;

class WebhookControllerTest extends RevenueCatTest
{
    protected function setUp(): void
    {
        parent::setUp();
        RevenueCat::routes();
    }

    public function testHandle()
    {
        Event::fake([
            InitialPurchaseEvent::class,
        ]);

        $data = $this->sample();

        $this->post('/webhooks/revenuecat', $data)->assertStatus(200);

        Event::assertDispatched(InitialPurchaseEvent::class,
            fn (InitialPurchaseEvent $e) =>
                $e->getProductId() === 'onemonth_no_trial'
                && $e->getAppUserId() === 'yourCustomerAppUserID'
                && $e->getType() === EventType::INITIAL_PURCHASE
        );
    }
}