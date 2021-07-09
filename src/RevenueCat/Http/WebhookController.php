<?php


namespace RevenueCat\Http;


use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use RevenueCat\CancellationReason;
use RevenueCat\Events\BillingIssueEvent;
use RevenueCat\Events\CancellationEvent;
use RevenueCat\Events\InitialPurchaseEvent;
use RevenueCat\Events\NonRenewingPurchaseEvent;
use RevenueCat\Events\ProductChangeEvent;
use RevenueCat\Events\RenewalEvent;
use RevenueCat\Events\SubscriptionPausedEvent;
use RevenueCat\Events\TestEvent;
use RevenueCat\Events\UncancellationEvent;
use RevenueCat\EventType;

class WebhookController extends Controller
{
    public function handle(Request $request)
    {
        $this->dispatch(new SubscriptionEvent($request->input()));
        return response('', 200);
    }

    private function dispatch(SubscriptionEvent $event): void
    {
        switch ($event->getType()) {
            case EventType::BILLING_ISSUE: {
                BillingIssueEvent::dispatch(
                    $event->getStore(),
                    $event->getAppUserId(),
                    $event->getProductId()
                );
                break;
            }
            case EventType::CANCELLATION: {
                CancellationEvent::dispatch(
                    $event->getStore(),
                    $event->getAppUserId(),
                    $event->getProductId(),
                    $event->getCancelReason() ?? CancellationReason::UNKNOWN,
                );
                break;
            }
            case EventType::INITIAL_PURCHASE: {
                InitialPurchaseEvent::dispatch(
                    $event->getStore(),
                    $event->getAppUserId(),
                    $event->getProductId()
                );
                break;
            }
            case EventType::NON_RENEWING_PURCHASE: {
                NonRenewingPurchaseEvent::dispatch(
                    $event->getStore(),
                    $event->getAppUserId(),
                    $event->getProductId()
                );
                break;
            }
            case EventType::PRODUCT_CHANGE: {
                ProductChangeEvent::dispatch(
                    $event->getStore(),
                    $event->getAppUserId(),
                    $event->getProductId(),
                    $event->getNewProductId() ?? ''
                );
                break;
            }
            case EventType::RENEWAL: {
                RenewalEvent::dispatch(
                    $event->getStore(),
                    $event->getAppUserId(),
                    $event->getProductId()
                );
                break;
            }
            case EventType::SUBSCRIPTION_PAUSED: {
                SubscriptionPausedEvent::dispatch(
                    $event->getStore(),
                    $event->getAppUserId(),
                    $event->getProductId()
                );
                break;
            }
            case EventType::UNCANCELLATION: {
                UncancellationEvent::dispatch(
                    $event->getStore(),
                    $event->getAppUserId(),
                    $event->getProductId()
                );
                break;
            }
            case EventType::TEST: {
                TestEvent::dispatch(
                    $event->getStore(),
                    $event->getAppUserId(),
                    $event->getProductId()
                );
                break;
            }
        }
    }
}