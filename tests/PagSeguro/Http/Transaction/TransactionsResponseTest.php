<?php


namespace Tests\PagSeguro\Http\Transaction;


use Orchestra\Testbench\TestCase;
use PagSeguro\Http\Transaction\TransactionsResponse;

class TransactionsResponseTest extends TestCase
{
    function testParse()
    {
        $response = new TransactionsResponse('<transactionSearchResult>
            <date>2011-02-16T20:14:35.000-02:00</date>
            <currentPage>1</currentPage>
            <resultsInThisPage>10</resultsInThisPage>
            <totalPages>1</totalPages>
            <transactions>
                <transaction>
                    <date>2011-02-05T15:46:12.000-02:00</date>
                    <lastEventDate>2011-02-15T17:39:14.000-03:00</lastEventDate>
                    <code>9E884542-81B3-4419-9A75-BCC6FB495EF1</code>
                    <reference>REF123456</reference>
                    <type>1</type>
                    <status>3</status>
                    <paymentMethod>
                        <type>1</type>
                    </paymentMethod>
                    <grossAmount>49900.00</grossAmount>
                    <discountAmount>0.00</discountAmount>
                    <feeAmount>0.00</feeAmount>
                    <netAmount>49900.00</netAmount>
                    <extraAmount>0.00</extraAmount>
                </transaction>
                <transaction>
                    <date>2011-02-07T18:57:52.000-02:00</date>
                    <lastEventDate>2011-02-14T21:37:24.000-03:00</lastEventDate>
                    <code>2FB07A22-68FF-4F83-A356-24153A0C05E1</code>
                    <reference>REF123456</reference>
                    <type>3</type>
                    <status>4</status>
                    <paymentMethod>
                        <type>3</type>
                    </paymentMethod>
                    <grossAmount>26900.00</grossAmount>
                    <discountAmount>0.00</discountAmount>
                    <feeAmount>0.00</feeAmount>
                    <netAmount>26900.00</netAmount>
                    <extraAmount>0.00</extraAmount>
                </transaction>
            </transactions>
        </transactionSearchResult>');

        $transactions = $response->getTransactions();
        self::assertEquals(1, $response->getCurrentPage());
        self::assertEquals(1, $response->getTotalPages());
        self::assertEquals(10, $response->getResultsInThisPage());
        self::assertEquals(2, collect($transactions)->count());
    }

    function testParseEmpty()
    {
        $response = new TransactionsResponse('<transactionSearchResult>
            <date>2021-05-24T02:48:01.000-03:00</date>
            <resultsInThisPage>0</resultsInThisPage>
            <currentPage>1</currentPage>
            <totalPages>0</totalPages>
        </transactionSearchResult>');

        $transactions = $response->getTransactions();
        self::assertEquals(1, $response->getCurrentPage());
        self::assertEquals(0, $response->getTotalPages());
        self::assertEquals(0, $response->getResultsInThisPage());
        self::assertEquals(0, collect($transactions)->count());
    }
}