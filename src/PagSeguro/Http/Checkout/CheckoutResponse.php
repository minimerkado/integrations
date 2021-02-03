<?php


namespace PagSeguro\Http\Checkout;


use Carbon\Carbon;
use Common\Response;

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
        $this->code = $xml->code;
        $this->date = Carbon::parse($xml->date);
    }

    /**
     * @return string
     */
    public function getCode(): string
    {
        return $this->code;
    }

    /**
     * @return Carbon
     */
    public function getDate(): Carbon
    {
        return $this->date;
    }
}