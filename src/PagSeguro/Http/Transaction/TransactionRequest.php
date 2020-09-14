<?php


namespace PagSeguro\Http\Transaction;


use PagSeguro\Http\GetRequest;

class TransactionRequest extends GetRequest
{
    private string $code;

    /**
     * @param string $code
     * @return TransactionRequest
     */
    public function setCode(string $code): TransactionRequest
    {
        $this->code = $code;
        return $this;
    }

    public function getQuery(): array
    {
        return [];
    }

    public function getPath()
    {
        return "/v3/transactions/$this->code";
    }
}