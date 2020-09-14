<?php


namespace PagSeguro\Http\Transaction;


use PagSeguro\Http\GetRequest;

class NotificationRequest extends GetRequest
{
    private string $code;

    /**
     * @param string $code
     * @return NotificationRequest
     */
    public function setCode(string $code): NotificationRequest
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
        return "/v3/transactions/notifications/$this->code";
    }
}