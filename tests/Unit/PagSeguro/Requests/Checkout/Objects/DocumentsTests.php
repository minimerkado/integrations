<?php


namespace Tests\Unit\PagSeguro\Requests\Checkout\Objects;


use Orchestra\Testbench\TestCase;
use PagSeguro\Requests\Checkout\Objects\Document;
use PagSeguro\Requests\Checkout\Objects\Documents;
use SimpleXMLElement;

class DocumentsTests extends TestCase
{
    function testEncode() {
        $xml = new SimpleXMLElement('<root/>');
        (new Documents())
            ->addDocument(new Document(Document::TYPE_CPF, '111.111.111-11'))
            ->addDocument(new Document(Document::TYPE_CNPJ, '11.111.111/1111-11'))
            ->encode($xml);

        self::assertEquals( '<?xml version="1.0"?>
<root><documents><document><type>CPF</type><value>111.111.111-11</value></document><document><type>CNPJ</type><value>11.111.111/1111-11</value></document></documents></root>
', $xml->asXML());
    }
}