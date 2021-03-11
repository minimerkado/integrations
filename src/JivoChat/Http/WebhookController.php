<?php


namespace JivoChat\Http;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use JivoChat\Events\JivoChatEventDispatcher;

class WebhookController extends Controller
{
    use DispatchesJobs, ValidatesRequests;

    public function handle(Request $request)
    {
        JivoChatEventDispatcher::dispatch($request);
        return response();
    }
}