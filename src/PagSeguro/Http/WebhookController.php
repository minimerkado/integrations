<?php


namespace PagSeguro\Http;



use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use PagSeguro\Events\TransactionStatusChanged;

class WebhookController extends Controller
{
    use DispatchesJobs, ValidatesRequests;

    public function handle(Request $request)
    {
        if ($code = $request->input('notificationCode')) {
            TransactionStatusChanged::dispatch($code);
        }

        return response('', 200);
    }
}