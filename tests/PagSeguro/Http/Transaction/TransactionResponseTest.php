<?php


namespace Tests\PagSeguro\Http\Transaction;


use Orchestra\Testbench\TestCase;
use PagSeguro\Http\Objects\Item;
use PagSeguro\Http\Objects\Items;
use PagSeguro\Http\Objects\PaymentMethod;
use PagSeguro\Http\Transaction\TransactionResponse;

class TransactionResponseTest extends TestCase
{
    function testParse()
    {
        $response = new TransactionResponse('<?xml version="1.0" encoding="ISO-8859-1" standalone="yes"?>  
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

        $transaction = $response->getTransaction();
        self::assertEquals('9E884542-81B3-4419-9A75-BCC6FB495EF1', $transaction->getCode());
        self::assertEquals('REF1234', $transaction->getReference());
        self::assertEquals((new Items())
            ->addItem((new Item())
                ->setId('0001')
                ->setDescription('Produto PagSeguroI')
                ->setQuantity(1)
                ->setAmount(99999.99))
            ->addItem((new Item())
                ->setId('0002')
                ->setDescription('Produto PagSeguroII')
                ->setQuantity(2)
                ->setAmount(99999.98))
            , $transaction->getItems());
        self::assertEquals((new PaymentMethod())
            ->setType(2)
            ->setCode(202)
            , $transaction->getPaymentMethod());
    }
}