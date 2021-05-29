<?php


namespace MercadoPago\Http;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use MercadoPago\Events\PaymentUpdated;

class WebhookController extends Controller
{
    const ACTION_CREATED = 'payment.created';
    const ACTION_UPDATED = 'payment.updated';

    public function handle(string $reference, Request $request)
    {
        if (($action = $request->input('action')) && ($id = $request->input('data.id'))) {
            $this->dispatch($action, $reference, $id);
        }

        return response('', 200);
    }

    private function dispatch(string $action, string $reference, string $id)
    {
        switch ($action) {
            case self::ACTION_CREATED:
            case self::ACTION_UPDATED:
                PaymentUpdated::dispatch($reference, $id);
                break;
            default:
                break;
        }
    }
}