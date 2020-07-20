<?php


namespace PagSeguro\Responses;


use Carbon\Carbon;

class CheckoutResponse implements Response
{
    private string $code;
    private Carbon $date;

    public function __construct(string $body)
    {
        $this->parse($body);
    }

    public function parse(string $body)
    {
        $xml = simplexml_load_string($body);
        $this->code = $xml->checkout->code;
        $this->date = Carbon::parse($xml->checkout->date);
    }
}