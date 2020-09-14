<?php

namespace PagSeguro\Http\Transaction;

use Common\Response;
use PagSeguro\Http\Objects\Transaction;

class NotificationResponse implements Response
{
    private Transaction $transaction;

    public function __construct(string $body)
    {
        $this->parse($body);
    }

    public function parse(string $body)
    {
        $xml = simplexml_load_string($body);
        $this->transaction = (new Transaction())->decode($xml);
    }
}
