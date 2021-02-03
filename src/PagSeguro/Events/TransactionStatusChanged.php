<?php


namespace PagSeguro\Events;


use Illuminate\Foundation\Events\Dispatchable;

class TransactionStatusChanged
{
    use Dispatchable;

    /** @var string */
    public $reference;
    /** @var string */
    public $code;

    /**
     * TransactionStatusChanged constructor.
     *
     * @param string $reference
     * @param string $code
     */
    public function __construct(string $reference, string $code)
    {
        $this->reference = $reference;
        $this->code = $code;
    }
}