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
     * @return \PicPay\Responses\SubscribersResponse
     */
    function cancel(\PicPay\Requests\CancelRequest $request): \PicPay\Responses\SubscribersResponse;

    /**
     * Obtem status de uma requisição de pagamento
     *
     * @param \PicPay\Requests\SubscribersRequest $request dados da requisição
     * @return \PicPay\Responses\StatusResponse
     */
    function status(\PicPay\Requests\SubscribersRequest $request): \PicPay\Responses\StatusResponse;
}