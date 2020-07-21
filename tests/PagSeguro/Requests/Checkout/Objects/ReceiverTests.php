<?php


namespace Tests\PagSeguro\Requests\Checkout\Objects;


use Orchestra\Testbench\TestCase;
use PagSeguro\Requests\Checkout\Objects\Receiver;

class ReceiverTests extends TestCase
{
    function testEncode()
    {
        $xml = new \SimpleXMLElement('<root/>');
        (new Receiver('test@minimerkado.com'))->encode($xml);

        self::assertEquals('<?xml version="1.0"?>
<root><receiver><email>test@minimerkado.com</email></receiver></root>
', $xml->asXML());
    }
}