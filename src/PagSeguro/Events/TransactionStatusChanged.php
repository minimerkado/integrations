<?php


namespace PagSeguro\Events;


use Illuminate\Foundation\Events\Dispatchable;

class TransactionStatusChanged
{
    use Dispatchable;

    /** @var string */
    public $code;

    /**
     * TransactionStatusChanged constructor.
     *
     * @param string $code
     */
    public function __construct(string $code)
    {
        $this->code = $code;
    }
}