<?php

namespace PicPay\Contracts;

interface PicPayService
{
    /**
     * Do a Checkout request to PicPay API
     *
     * @param \PicPay\Requests\Checkout\CheckoutRequest $request request data to make the checkout
     * @return \PicPay\Responses\CheckoutResponse checkout response
     */
    function checkout(\PicPay\Requests\Checkout\CheckoutRequest $request): \PicPay\Responses\CheckoutResponse;
}