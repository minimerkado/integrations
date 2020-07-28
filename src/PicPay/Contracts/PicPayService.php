<?php

namespace PicPay\Contracts;

use PicPay\Requests\Checkout\CheckoutRequest;
use PicPay\Responses\CheckoutResponse;

interface PicPayService
{
    /**
     * @param CheckoutRequest $request
     * @return string
     */
    function checkout(CheckoutRequest $request): CheckoutResponse;
}