<?php


namespace Tests\PagSeguro\Requests\Checkout;


use Orchestra\Testbench\TestCase;
use PagSeguro\Requests\Checkout\CheckoutRequest;
use PagSeguro\Requests\Checkout\Objects\Address;
use PagSeguro\Requests\Checkout\Objects\Document;
use PagSeguro\Requests\Checkout\Objects\Item;
use PagSeguro\Requests\Checkout\Objects\Items;
use PagSeguro\Requests\Checkout\Objects\Phone;
use PagSeguro\Requests\Checkout\Objects\Sender;
use PagSeguro\Requests\Checkout\Objects\Shipping;

class CheckoutRequestTests extends TestCase
{
    private CheckoutRequest $request;

    protected function setUp(): void
    {
        parent::setUp();

        $this->request = (new CheckoutRequest('test@example.com', 'token12345'))
            ->setItems((new Items())
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
            )
            ->setShipping((new Shipping())
                ->setType(Shipping::TYPE_NORMAL)
                ->setAddress((new Address())
                    ->setPostalCode('123456789')
                    ->setStreet('Main Street')
                    ->setNumber('123')
                    ->setCity('San Francisco')
                    ->setState('CA')
                    ->setCountry('United'))
                ->setCost(30.5))
            ->setSender((new Sender())
                ->setEmail('test@example.com')
                ->setName('John Doe')
                ->setPhone(new Phone('11', '912345678'))
                ->addDocument(new Document(Document::TYPE_CPF, '111.111.111-11')))
            ->setExtraAmount(14.0)
            ->setReference('123')
            ->setRedirectUrl('http://www.example.com/redirect')
            ->setTimeout(3600)
            ->setMaxAge(60)
            ->setMaxUses(1);
    }

    function testEncode()
    {
        $xml = new \SimpleXMLElement('<checkout/>');
        $this->request->encode($xml);
        self::assertEquals('<?xml version="1.0"?>
<checkout><currency>BRL</currency><items><item><id>1</id><description>Nike Shoes</description><quantity>1</quantity><amount>150.00</amount><weight>75</weight><shippingCost>50.00</shippingCost></item><item><id>2</id><description>Adidas Shoes</description><quantity>2</quantity><amount>200.00</amount><weight>80</weight></item></items><receiver><email>test@example.com</email></receiver><shipping><type>1</type><cost>30.50</cost><addressRequired>false</addressRequired><address><street>Main Street</street><number>123</number><city>San Francisco</city><state>CA</state><country>United</country><postalCode>123456789</postalCode></address></shipping><sender><name>John Doe</name><email>test@example.com</email><phone><areaCode>11</areaCode><number>912345678</number></phone><documents><document><type>CPF</type><value>111.111.111-11</value></document></documents></sender><extraAmount>14</extraAmount><reference>123</reference><redirectUrl>http://www.example.com/redirect</redirectUrl><timeout>3600</timeout><maxAge>60</maxAge><maxUses>1</maxUses></checkout>
', $xml->asXML());
    }

    function testBuild()
    {
        self::assertEquals([
            'query' => [
                'email' => 'test@example.com',
                'token' => 'token12345',
            ],
            'body' => '<?xml version="1.0"?>
<checkout><currency>BRL</currency><items><item><id>1</id><description>Nike Shoes</description><quantity>1</quantity><amount>150.00</amount><weight>75</weight><shippingCost>50.00</shippingCost></item><item><id>2</id><description>Adidas Shoes</description><quantity>2</quantity><amount>200.00</amount><weight>80</weight></item></items><receiver><email>test@example.com</email></receiver><shipping><type>1</type><cost>30.50</cost><addressRequired>false</addressRequired><address><street>Main Street</street><number>123</number><city>San Francisco</city><state>CA</state><country>United</country><postalCode>123456789</postalCode></address></shipping><sender><name>John Doe</name><email>test@example.com</email><phone><areaCode>11</areaCode><number>912345678</number></phone><documents><document><type>CPF</type><value>111.111.111-11</value></document></documents></sender><extraAmount>14</extraAmount><reference>123</reference><redirectUrl>http://www.example.com/redirect</redirectUrl><timeout>3600</timeout><maxAge>60</maxAge><maxUses>1</maxUses></checkout>
'
        ], $this->request->build());
    }
}