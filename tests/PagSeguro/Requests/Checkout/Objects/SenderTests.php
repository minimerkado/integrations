<?php


namespace Tests\PagSeguro\Requests\Checkout\Objects;


use Orchestra\Testbench\TestCase;
use PagSeguro\Requests\Checkout\Objects\Document;
use PagSeguro\Requests\Checkout\Objects\Phone;
use PagSeguro\Requests\Checkout\Objects\Sender;

class SenderTests extends TestCase
{
    function testEncode()
    {
        $xml = new \SimpleXMLElement('<root/>');
        (new Sender())
            ->setEmail('test@example.com')
            ->setName('John Doe')
            ->setPhone(new Phone('11', '912345678'))
            ->addDocument(new Document(Document::TYPE_CPF, '111.111.111-11'))
            ->encode($xml);

        self::assertEquals('<?xml version="1.0"?>
<root><sender><name>John Doe</name><email>test@example.com</email><phone><areaCode>11</areaCode><number>912345678</number></phone><documents><document><type>CPF</type><value>111.111.111-11</value></document></documents></sender></root>
', $xml->asXML());
    }

    function testEncodeWithNullValues()
    {
        $xml = new \SimpleXMLElement('<root/>');
        (new Sender())
            ->setEmail('test@example.com')
            ->setName('John Doe')
            ->encode($xml);

        self::assertEquals('<?xml version="1.0"?>
<root><sender><name>John Doe</name><email>test@example.com</email></sender></root>
', $xml->asXML());
    }
}