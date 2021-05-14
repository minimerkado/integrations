<?php


namespace MercadoPago\Requests\Payment;


use MercadoPago\Requests\Request;

class GetPaymentRequest extends Request
{
    private string $id;

    /**
     * GetPaymentRequest constructor.
     *
     * @param string $access_token
     * @param string $id
     */
    public function __construct(string $access_token, string $id)
    {
        parent::__construct($access_token);
        $this->id = $id;
    }

    public function getMethod()
    {
        return 'GET';
    }

    public function getPath()
    {
        return "/v1/payments/{$this->id}";
    }
}