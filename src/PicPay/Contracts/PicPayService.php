<?php

namespace PicPay\Contracts;

interface PicPayService
{
    /**
     * Cria uma requisição de pagamento
     *
     * @param \PicPay\Requests\Checkout\CheckoutRequest $request dados da requisição
     * @return \PicPay\Responses\CheckoutResponse
     */
    function checkout(\PicPay\Requests\Checkout\CheckoutRequest $request): \PicPay\Responses\CheckoutResponse;

    /**
     * Cancela uma requisiçao de pagamento
     *
     * @param \PicPay\Requests\CancelRequest $request dados da requisição
     * @return \PicPay\Responses\CancelResponse
     */
    function cancel(\PicPay\Requests\CancelRequest $request): \PicPay\Responses\CancelResponse;

    /**
     * Obtem status de uma requisição de pagamento
     *
     * @param \PicPay\Requests\StatusRequest $request dados da requisição
     * @return \PicPay\Responses\StatusResponse
     */
    function status(\PicPay\Requests\StatusRequest $request): \PicPay\Responses\StatusResponse;
}