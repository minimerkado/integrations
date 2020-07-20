<?php

namespace PagSeguro\Contracts;

use PagSeguro\Exceptions\PagSeguroException;
use PagSeguro\Requests\Checkout\CheckoutRequest;
use PagSeguro\Responses\CheckoutResponse;

interface PagSeguroService
{
    /**
     * Create a new checkout
     *
     * @param CheckoutRequest $request
     * @throws PagSeguroException
     * @return CheckoutResponse
     */
    function checkout(CheckoutRequest $request): CheckoutResponse;

    /**
     * Get checkout url
     *
     * @param string $code
     * @return string
     */
    function checkoutUrl(string $code): string;
}