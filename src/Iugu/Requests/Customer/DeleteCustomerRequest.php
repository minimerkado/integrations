<?php

namespace Iugu\Requests\Customer;

use Iugu\Requests\GetRequest;

class DeleteCustomerRequest extends GetCustomerRequest
{
    public function getMethod()
    {
        return 'DELETE';
    }
}