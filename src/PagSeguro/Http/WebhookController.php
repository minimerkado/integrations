<?php


namespace PagSeguro\Http;



use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use PagSeguro\Contracts\PagSeguroService;

class WebhookController extends Controller
{
    use DispatchesJobs, ValidatesRequests;

    /** @var PagSeguroService */
    private $service;

    /**
     * WebhookController constructor.
     * @param PagSeguroService $service
     */
    public function __construct(PagSeguroService $service)
    {
        $this->service = $service;
    }

    public function handle(Request $request)
    {

    }
}