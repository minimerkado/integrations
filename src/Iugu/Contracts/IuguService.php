<?php

namespace Iugu\Contracts;

use Iugu\Exceptions\IuguException;
use Iugu\Requests\Customer\CreateCustomerRequest;
use Iugu\Requests\Customer\UpdateCustomerRequest;
use Iugu\Responses\CustomerResponse;

interface IuguService
{
    /**
     * Create Customer
     *
     * @param CreateCustomerRequest $request
     * @return CustomerResponse
     * @throws IuguException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function createCustomer(CreateCustomerRequest $request): CustomerResponse;

    /**
     * Update customer
     *
     * @param UpdateCustomerRequest $request
     * @return CustomerResponse
     * @throws IuguException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function UpdateCustomer(UpdateCustomerRequest $request): CustomerResponse;

    /**
     * Get customer
     *
     * @param string $id
     * @return CustomerResponse
     * @throws IuguException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getCustomer(string $id): CustomerResponse;
}