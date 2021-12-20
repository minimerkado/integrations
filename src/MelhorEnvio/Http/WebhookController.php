<?php


namespace MelhorEnvio\Http;


use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class WebhookController extends Controller
{
    public function handle(Request $request)
    {
        return response('', 200);
    }
}