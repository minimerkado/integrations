<?php


namespace RevenueCat\Http;


use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class WebhookController extends Controller
{
    public function handle(Request $request)
    {
        $event = new SubscriptionEvent($request->all());
        return response('', 200);
    }
}