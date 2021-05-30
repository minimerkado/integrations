<?php


namespace MercadoPago\Events;


use Illuminate\Foundation\Events\Dispatchable;

class PaymentNotification
{
    use Dispatchable;

    /** @var string */
    public $reference;
    /** @var string */
    public $payment_id;

    /**
     * TransactionStatusChanged constructor.
     *
     * @param string $reference
     * @param string $payment_id
     */
    public function __construct(string $reference, string $payment_id)
    {
        $this->reference = $reference;
        $this->payment_id = $payment_id;
    }
}