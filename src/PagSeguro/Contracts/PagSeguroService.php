<?php

namespace PagSeguro\Contracts;

use PagSeguro\Exceptions\PagSeguroException;
use PagSeguro\Http\Checkout\CheckoutRequest;
use PagSeguro\Http\Checkout\CheckoutResponse;
use PagSeguro\Http\Transaction\NotificationRequest;
use PagSeguro\Http\Transaction\NotificationResponse;
use PagSeguro\Http\Transaction\TransactionRequest;
use PagSeguro\Http\Transaction\TransactionResponse;
use PagSeguro\Http\Transaction\TransactionsRequest;
use PagSeguro\Http\Transaction\TransactionsResponse;

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

    /**
     * Search for transactions
     *
     * @param TransactionsRequest $request
     * @return TransactionsResponse
     */
    function searchTransactions(TransactionsRequest $request): TransactionsResponse;

    /**
     * Get transaction details
     *
     * @param TransactionRequest $request
     * @return TransactionResponse
     */
    function getTransaction(TransactionRequest $request): TransactionResponse;

    /**
     * Get notification
     *
     * @param NotificationRequest $request
     * @return NotificationResponse
     */
    function getNotification(NotificationRequest $request): NotificationResponse;
}