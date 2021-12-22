<?php

namespace Iugu\Requests\Customer;

use Iugu\Requests\GetRequest;

class GetCustomerRequest extends GetRequest
{
    protected string $id;

    public function __construct(string $id)
    {
        $this->id = $id;
    }

    public function getPath()
    {
        return "/customers/$this->id";
    }
}