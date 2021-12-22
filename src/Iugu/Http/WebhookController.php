<?php

namespace Iugu\Http;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class WebhookController extends Controller
{
    public function handle(Request $request)
    {
        $this->dispatch($request->input());
        return response('', 200);
    }

    private function dispatch(array $input)
    {

    }
}