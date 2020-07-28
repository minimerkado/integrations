<?php


namespace Tests\PicPay\Requests\Checkout;


use Orchestra\Testbench\TestCase;
use PicPay\Requests\Checkout\CheckoutRequest;
use PicPay\Requests\Checkout\Objects\Buyer;

class CheckoutRequestTest extends TestCase
{
    private CheckoutRequest $request;

    protected function setUp(): void
    {
        parent::setUp();

        $buyer = (new Buyer())
            ->setEmail("vinicius.parise@hotmail.com")
            ->setDocument("95543465220")
            ->setFirstName("Vinícius")
            ->setLastName("Gabriel")
            ->setPhone("34991890838");

        $this->request = (new CheckoutRequest('token12345'))
            ->setValue(100.0)
            ->setCallbackUrl("https")
            ->setExpiresAt(null)
            ->setReferenceId("23423")
            ->setReturnUrl("http")
            ->setBuyer($buyer);
    }

    function testBuild()
    {
        self::assertEquals([
            'headers' => [
                'Content-Type' => 'application/xml',
                'x-picpay-token' => 'token12345',
            ],
            'json' => [
                "referenceId" => "23423",
                "callbackUrl" => "https",
                "returnUrl" => "http",
                "value" => 100.0,
                "expiresAt" => null,
                "buyer" => [
                    "firstName" => "Vinícius",
                    "lastName" => "Gabriel",
                    "document" => "95543465220",
                    "email" => "vinicius.parise@hotmail.com",
                    "phone" => "34991890838",
                ],
            ],
        ], $this->request->build());
    }
}