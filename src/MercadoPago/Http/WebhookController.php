<?php


namespace MercadoPago\Http;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use MercadoPago\Events\MercadoPagoPaymentNotification;

class WebhookController extends Controller
{
    const TOPIC_PAYMENT = 'payment';
    const ACTION_CREATED = 'payment.created';
    const ACTION_UPDATED = 'payment.updated';

    public function handle(string $reference, Request $request)
    {
        if (($topic = $request->query('topic')) && ($id = $request->query('id'))) {
            $this->dispatchIPN($topic, $reference, $id);
        } else if (($action = $request->input('action')) && ($id = $request->input('data.id'))) {
            $this->dispatchWebhook($action, $reference, $id);
        }

        return response('', 200);
    }

    private function dispatchIPN(string $topic, string $reference, string $id)
    {
        switch ($topic) {
            case self::TOPIC_PAYMENT:
                MercadoPagoPaymentNotification::dispatch($reference, $id);
                break;
            default:
                break;
        }
    }

    private function dispatchWebhook(string $action, string $reference, string $id)
    {
        switch ($action) {
            case self::ACTION_CREATED:
            case self::ACTION_UPDATED:
                MercadoPagoPaymentNotification::dispatch($reference, $id);
                break;
            default:
                break;
        }
    }
}