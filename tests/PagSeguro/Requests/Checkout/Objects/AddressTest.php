<?php


namespace Tests\PagSeguro\Requests\Checkout\Objects;


use Orchestra\Testbench\TestCase;
use PagSeguro\http\Objects\Address;

class AddressTest extends TestCase
{
    function testEncode()
    {
        $xml = new \SimpleXMLElement('<root/>');
        (new Address())
            ->setPostalCode('123456789')
            ->setStreet('Main Street')
            ->setNumber('123')
            ->setComplement('Ap 707')
            ->setDistrict('District One')
            ->setCity('San Francisco')
            ->setState('CA')
            ->setCountry('United')
            ->encode($xml);

        self::assertEquals('<?xml version="1.0"?>
<root><address><street>Main Street</street><number>123</number><district>District One</district><complement>Ap 707</complement><city>San Francisco</city><state>CA</state><country>United</country><postalCode>123456789</postalCode></address></root>
', $xml->asXML());
    }

    function testEncodeWithNullValues()
    {
        $xml = new \SimpleXMLElement('<root/>');
        (new Address())
            ->setPostalCode('123456789')
            ->setStreet('Main Street')
            ->setNumber('123')
            ->setCity('San Francisco')
            ->setState('CA')
            ->setCountry('United')
            ->encode($xml);

        self::assertEquals('<?xml version="1.0"?>
<root><address><street>Main Street</street><number>123</number><city>San Francisco</city><state>CA</state><country>United</country><postalCode>123456789</postalCode></address></root>
', $xml->asXML());
    }
}