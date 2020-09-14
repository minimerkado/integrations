<?php


namespace Tests\PagSeguro\Http\Objects;


use Orchestra\Testbench\TestCase;
use PagSeguro\Http\Objects\Receiver;

class ReceiverTest extends TestCase
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