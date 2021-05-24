<?php


namespace PagSeguro;


use PagSeguro\Contracts\PagSeguroService;
use PagSeguro\Http\Checkout\CheckoutRequest;
use PagSeguro\Http\Checkout\CheckoutResponse;
use PagSeguro\Http\Transaction\NotificationRequest;
use PagSeguro\Http\Transaction\NotificationResponse;
use PagSeguro\Http\Transaction\TransactionRequest;
use PagSeguro\Http\Transaction\TransactionResponse;
use PagSeguro\Http\Transaction\TransactionsRequest;
use PagSeguro\Http\Transaction\TransactionsResponse;

class PagSeguroFakeService implements PagSeguroService
{
    function checkout(CheckoutRequest $request): CheckoutResponse
    {
        return new CheckoutResponse('<?xml version="1.0" encoding="ISO-8859-1" standalone="yes"?>
            <checkout>
                <code>36E9E393B7B77B0FF4DA7F8C6A635181</code>
                <date>2020-07-19T23:23:10.000-03:00</date>
            </checkout>');
    }

    function searchTransactions(TransactionsRequest $request): TransactionsResponse
    {
        return new TransactionsResponse('<transactionSearchResult>
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
    }

    function getTransaction(TransactionRequest $request): TransactionResponse
    {
        return new TransactionResponse('<?xml version="1.0" encoding="ISO-8859-1" standalone="yes"?>  
            <transaction>  
                <date>2011-02-10T16:13:41.000-03:00</date>  
                <code>9E884542-81B3-4419-9A75-BCC6FB495EF1</code>  
                <reference>REF1234</reference>
                <type>1</type>  
                <status>3</status>  
                <paymentMethod>  
                    <type>2</type>  
                    <code>202</code>  
                </paymentMethod>  
                <grossAmount>300021.45</grossAmount>
                <discountAmount>0.00</discountAmount>
                <creditorFees>
                    <intermediationRateAmount>0.40</intermediationRateAmount>
                    <intermediationFeeAmount>11970.86</intermediationFeeAmount>
                </creditorFees>
                <netAmount>288050.19</netAmount>
                <extraAmount>0.00</extraAmount>  
                <installmentCount>1</installmentCount>  
                <itemCount>3</itemCount>  
                <items>  
                    <item>  
                        <id>0001</id>  
                        <description>Produto PagSeguroI</description>  
                        <quantity>1</quantity>  
                        <amount>99999.99</amount>  
                    </item>  
                    <item>  
                        <id>0002</id>  
                        <description>Produto PagSeguroII</description>  
                        <quantity>2</quantity>  
                        <amount>99999.98</amount>  
                    </item>  
                </items>  
                <sender>  
                    <name>José Comprador</name>  
                    <email>comprador@uol.com.br</email>  
                    <phone>  
                        <areaCode>99</areaCode>  
                        <number>99999999</number>  
                    </phone>  
                </sender>  
                <shipping>  
                    <address>  
                        <street>Av. PagSeguro</street>  
                        <number>9999</number>  
                        <complement>99o andar</complement>  
                        <district>Jardim Internet</district>  
                        <postalCode>99999999</postalCode>  
                        <city>Cidade Exemplo</city>  
                        <state>SP</state>  
                        <country>ATA</country>  
                    </address>  
                    <type>1</type>  
                    <cost>21.50</cost>  
                </shipping>
            </transaction>');
    }

    function getNotification(NotificationRequest $request): NotificationResponse
    {
        return new NotificationResponse('<?xml version="1.0" encoding="ISO-8859-1" standalone="yes"?>  
            <transaction>  
                <date>2011-02-10T16:13:41.000-03:00</date>  
                <code>9E884542-81B3-4419-9A75-BCC6FB495EF1</code>  
                <reference>REF1234</reference>
                <type>1</type>  
                <status>3</status>  
                <paymentMethod>  
                    <type>2</type>  
                    <code>202</code>  
                </paymentMethod>  
                <grossAmount>300021.45</grossAmount>
                <discountAmount>0.00</discountAmount>
                <creditorFees>
                    <intermediationRateAmount>0.40</intermediationRateAmount>
                    <intermediationFeeAmount>11970.86</intermediationFeeAmount>
                </creditorFees>
                <netAmount>288050.19</netAmount>
                <extraAmount>0.00</extraAmount>  
                <installmentCount>1</installmentCount>  
                <itemCount>3</itemCount>  
                <items>  
                    <item>  
                        <id>0001</id>  
                        <description>Produto PagSeguroI</description>  
                        <quantity>1</quantity>  
                        <amount>99999.99</amount>  
                    </item>  
                    <item>  
                        <id>0002</id>  
                        <description>Produto PagSeguroII</description>  
                        <quantity>2</quantity>  
                        <amount>99999.98</amount>  
                    </item>  
                </items>  
                <sender>  
                    <name>José Comprador</name>  
                    <email>comprador@uol.com.br</email>  
                    <phone>  
                        <areaCode>99</areaCode>  
                        <number>99999999</number>  
                    </phone>  
                </sender>  
                <shipping>  
                    <address>  
                        <street>Av. PagSeguro</street>  
                        <number>9999</number>  
                        <complement>99o andar</complement>  
                        <district>Jardim Internet</district>  
                        <postalCode>99999999</postalCode>  
                        <city>Cidade Exemplo</city>  
                        <state>SP</state>  
                        <country>ATA</country>  
                    </address>  
                    <type>1</type>  
                    <cost>21.50</cost>  
                </shipping>
            </transaction>');
    }

    function checkoutUrl(string $code): string
    {
        return $this->getUri("/v2/checkout/payment.html?code=$code");
    }

    private function getUri(string $path): string {
        return 'https://pagseguro.uol.com.br'.$path;
    }
}