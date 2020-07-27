<?php

namespace PicPay\Contracts;

use PicPay\Requests\Checkout\CheckoutRequest;

interface PicPayService
{
    /**
     * @param CheckoutRequest $request
     * @return string
     */
    function checkoutUrl(CheckoutRequest $request): string;
}