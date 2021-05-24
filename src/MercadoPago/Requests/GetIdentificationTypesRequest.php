<?php


namespace MercadoPago\Requests;


class GetIdentificationTypesRequest extends Request
{
    /**
     * GetPaymentRequest constructor.
     *
     * @param string $access_token
     */
    public function __construct(string $access_token)
    {
        parent::__construct($access_token);
    }

    public function getMethod()
    {
        return 'GET';
    }

    public function getPath()
    {
        return "/v1/identification_types";
    }
}