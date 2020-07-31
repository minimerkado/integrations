<?php


namespace Tests\PicPay;


use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Middleware;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;
use Orchestra\Testbench\TestCase;
use PicPay\Contracts\PicPayService;
use PicPay\PicPayHttpService;
use PicPay\Requests\Checkout\CheckoutRequest;
use PicPay\Requests\Checkout\Objects\Buyer;

class PicPayHttpServiceTest extends TestCase
{
    private PicPayService $service;
    private HandlerStack $handlerStack;

    protected function setUp(): void
    {
        parent::setUp();

        $mock = new MockHandler([
            new Response(200, [], '
                {
                  "referenceId": "102030",
                  "paymentUrl": "https://app.picpay.com/checkout/NWFmMGRjNmViZDc0Y2EwMDMwNzZlYzEw",
                  "expiresAt": "2022-05-01T16:00:00-03:00",
                  "qrcode": {
                    "content": "https://app.picpay.com/checkout/NWNlYzMxOTM1MDg1NGEwMDIwMzUxODcy",
                    "base64": "data:image/png;base64,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"
                  }
                }
            '
            ),
        ]);

        $this->handlerStack = HandlerStack::create($mock);
        $client = new Client(['handler' => $this->handlerStack]);
        $this->service = new PicPayHttpService($client);
    }

    function testCheckout()
    {
        $container = [];
        $history = Middleware::history($container);
        $this->handlerStack->push($history);

        $buyer = (new Buyer())
            ->setEmail("vinicius.parise@hotmail.com")
            ->setDocument("95543465220")
            ->setFirstName("Vinícius")
            ->setLastName("Gabriel")
            ->setPhone("34991890838");

        $request = (new CheckoutRequest('token12345'))
            ->setValue(100.0)
            ->setCallbackUrl("https")
            ->setExpiresAt(null)
            ->setReferenceId("23423")
            ->setReturnUrl("http")
            ->setBuyer($buyer);

        $response = $this->service->checkout($request);

        /** @var Request $request */
        $request = $container[0]['request'];
        self::assertEquals('POST', $request->getMethod());
        self::assertEquals('appws.picpay.com', $request->getUri()->getHost());
        self::assertEquals('token12345', $request->getHeaderLine('x-picpay-token'));
        self::assertEquals('https://app.picpay.com/checkout/NWFmMGRjNmViZDc0Y2EwMDMwNzZlYzEw', $response->getPaymentUrl());
    }
}