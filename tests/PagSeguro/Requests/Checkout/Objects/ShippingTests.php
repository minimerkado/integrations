<?php


namespace Tests\PagSeguro\Requests\Checkout\Objects;


use Orchestra\Testbench\TestCase;
use PagSeguro\Requests\Checkout\Objects\Address;
use PagSeguro\Requests\Checkout\Objects\Shipping;

class ShippingTests extends TestCase
{
    function testEncode()
    {
        $xml = new \SimpleXMLElement('<root/>');
        (new Shipping())
            ->setType(Shipping::TYPE_NORMAL)
            ->setAddress((new Address())
                ->setPostalCode('123456789')
                ->setStreet('Main Street')
                ->setNumber('123')
                ->setCity('San Francisco')
                ->setState('CA')
                ->setCountry('United'))
            ->setCost(30.0)
            ->encode($xml);

        self::assertEquals('<?xml version="1.0"?>
<root><shipping><type>1</type><cost>30.00</cost><addressRequired>false</addressRequired><address><street>Main Street</street><number>123</number><city>San Francisco</city><state>CA</state><country>United</country><postalCode>123456789</postalCode></address></shipping></root>
', $xml->asXML());
    }
}