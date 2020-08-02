<?php


namespace MercadoPago\Requests;


abstract class Request implements \Common\Request
{

    protected string $access_token = '';

    /**
     * Request constructor.
     * @param string $access_token
     */
    public function __construct(string $access_token)
    {
        $this->access_token = $access_token;
    }

    abstract public function toJson();

    public function build(): array
    {
        return [
            'query' => [
                'access_token' => $this->access_token
            ],
            'json' => $this->toJson(),
        ];
    }
}