<?php


namespace Tests\PicPay\Requests\Checkout\Objects;


use Orchestra\Testbench\TestCase;
use PicPay\Requests\Checkout\Objects\Buyer;

class BuyerTest extends TestCase
{
    function testBuild()
    {
        $buyer = (new Buyer())
            ->setEmail("vinicius.parise@hotmail.com")
            ->setDocument("95543465220")
            ->setFirstName("Vinícius")
            ->setLastName("Gabriel")
            ->setPhone("34991890838")
            ->build();

        self::assertEquals([
            "firstName" => "Vinícius",
            "lastName" => "Gabriel",
            "document" => "95543465220",
            "email" => "vinicius.parise@hotmail.com",
            "phone" => "34991890838",
        ], $buyer);
    }

}