<?php


namespace Tests\PagSeguro;


use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Middleware;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;
use Orchestra\Testbench\TestCase;
use PagSeguro\Configuration;
use PagSeguro\Contracts\PagSeguroService;
use PagSeguro\PagSeguroHttpService;
use PagSeguro\Requests\Checkout\CheckoutRequest;
use PagSeguro\Requests\Checkout\Objects\Address;
use PagSeguro\Requests\Checkout\Objects\Document;
use PagSeguro\Requests\Checkout\Objects\Item;
use PagSeguro\Requests\Checkout\Objects\Items;
use PagSeguro\Requests\Checkout\Objects\Phone;
use PagSeguro\Requests\Checkout\Objects\Sender;
use PagSeguro\Requests\Checkout\Objects\Shipping;

class PagSeguroHttpServiceTest extends TestCase
{
    private array $history = [];
    private MockHandler $mock;
    private PagSeguroService $service;

    protected function setUp(): void
    {
        parent::setUp();

        $this->history = [];
        $this->mock = new MockHandler();
        $handlerStack = HandlerStack::create($this->mock);
        $handlerStack->push(Middleware::history($this->history));
        $client = new Client(['handler' => $handlerStack]);
        $this->service = new PagSeguroHttpService([], $client);
    }

    function testCheckout()
    {
        $this->mock->append(new Response(200, [], '<?xml version="1.0" encoding="ISO-8859-1" standalone="yes"?>
            <checkout>
                <code>36E9E393B7B77B0FF4DA7F8C6A635181</code>
                <date>2020-07-19T23:23:10.000-03:00</date>
            </checkout>
        '));

        $request = (new CheckoutRequest('test@example.com', 'token12345'))
            ->setItems((new Items())
                ->addItem((new Item())
                    ->setId(1)
                    ->setDescription('Nike Shoes')
                    ->setQuantity(1)
                    ->setWeight(75)
                    ->setAmount(150.0)
                    ->setShippingCost(50.0)
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
                ->addDocument(new Document(Document::TYPE_CPF, '111.111.111-11')));

        $response = $this->service->checkout($request);

        /** @var Request $request */
        $request = $this->history[0]['request'];
        self::assertEquals('POST', $request->getMethod());
        self::assertEquals('ws.sandbox.pagseguro.uol.com.br', $request->getUri()->getHost());
        self::assertEquals('email=test%40example.com&token=token12345', $request->getUri()->getQuery());
        self::assertEquals('36E9E393B7B77B0FF4DA7F8C6A635181', $response->getCode());
    }

    function testCheckoutUrl()
    {
        $url = $this->service->checkoutUrl('36E9E393B7B77B0FF4DA7F8C6A635181');
        self::assertEquals('https://ws.sandbox.pagseguro.uol.com.br/v2/checkout/payment.html?code=36E9E393B7B77B0FF4DA7F8C6A635181', $url);
    }
}