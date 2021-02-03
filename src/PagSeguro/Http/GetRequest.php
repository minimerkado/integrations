<?php

namespace PagSeguro\Http;


use PagSeguro\Http\PagSeguroRequest;

abstract class GetRequest extends PagSeguroRequest
{
    public abstract function getQuery(): array;

    public function getMethod()
    {
        return 'GET';
    }

    public function build(): array
    {
        return [
            'query' => array_merge($this->getQuery(),[
                'email' => $this->email,
                'token' => $this->token,
            ]),
        ];
    }
}