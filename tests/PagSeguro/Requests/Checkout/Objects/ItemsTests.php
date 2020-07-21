<?php


namespace Tests\PagSeguro\Requests\Checkout\Objects;


use Orchestra\Testbench\TestCase;
use PagSeguro\Requests\Checkout\Objects\Item;
use PagSeguro\Requests\Checkout\Objects\Items;

class ItemsTests extends TestCase
{
    function testEncode()
    {
        $xml = new \SimpleXMLElement('<root/>');
        (new Items())
            ->addItem((new Item())
                ->setId(1)
                ->setDescription('Nike Shoes')
                ->setQuantity(1)
                ->setWeight(75)
                ->setAmount(150.0)
                ->setShippingCost(50.0)
            )
            ->addItem((new Item())
                ->setId(2)
                ->setDescription('Adidas Shoes')
                ->setQuantity(2)
                ->setWeight(80)
                ->setAmount(200.0)
            )
            ->encode($xml);

        self::assertEquals('<?xml version="1.0"?>
<root><items><item><id>1</id><description>Nike Shoes</description><quantity>1</quantity><amount>150</amount><weight>75</weight><shippingCost>50</shippingCost></item><item><id>2</id><description>Adidas Shoes</description><quantity>2</quantity><amount>200</amount><weight>80</weight></item></items></root>
', $xml->asXML());
    }
}