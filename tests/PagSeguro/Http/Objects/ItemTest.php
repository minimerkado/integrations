<?php


namespace Tests\PagSeguro\Http\Objects;


use Orchestra\Testbench\TestCase;
use PagSeguro\Http\Objects\Item;

class ItemTest extends TestCase
{
    function testEncode()
    {
        $xml = new \SimpleXMLElement('<root/>');
        (new Item())
            ->setId(1)
            ->setDescription('Nike Shoes')
            ->setQuantity(1)
            ->setWeight(75)
            ->setAmount(1500.0)
            ->setShippingCost(50.0)
            ->encode($xml);

        self::assertEquals('<?xml version="1.0"?>
<root><item><id>1</id><description>Nike Shoes</description><quantity>1</quantity><amount>1500.00</amount><weight>75</weight><shippingCost>50.00</shippingCost></item></root>
', $xml->asXML());
    }

    function testEncodeWithNullValues()
    {
        $xml = new \SimpleXMLElement('<root/>');
        (new Item())
            ->setId(1)
            ->setDescription('Nike Shoes')
            ->setQuantity(1)
            ->setWeight(75)
            ->setAmount(150.0)
            ->encode($xml);

        self::assertEquals('<?xml version="1.0"?>
<root><item><id>1</id><description>Nike Shoes</description><quantity>1</quantity><amount>150.00</amount><weight>75</weight></item></root>
', $xml->asXML());
    }
}