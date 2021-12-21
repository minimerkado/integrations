<?php

namespace Iugu\Requests\Customer;

class UpdateCustomerRequest extends CreateCustomerRequest
{
    private string $id;

    /**
     * @param string $id
     */
    public function __construct(string $id)
    {
        $this->id = $id;
    }

    /**
     * @param string $id
     * @return UpdateCustomerRequest
     */
    public function setId(string $id): UpdateCustomerRequest
    {
        $this->id = $id;
        return $this;
    }

    public function getMethod()
    {
        return 'PUT';
    }

    public function getPath()
    {
        return "/customers/$this->id";
    }
}