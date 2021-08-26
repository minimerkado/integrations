<?php

namespace Facebook\Requests;

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

    public function build(): array
    {
        return [
            'headers' => [
                'Accept' => 'application/json',
            ],
            'query' => [
                'access_token' => $this->access_token,
            ],
        ];
    }
}