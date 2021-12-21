<?php

namespace Tests\Iugu;

use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Middleware;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;
use Iugu\Contracts\IuguService;
use Iugu\IuguHttpService;
use Iugu\Requests\Customer\CreateCustomerRequest;
use Orchestra\Testbench\TestCase;

class IuguHttpServiceTest extends TestCase
{
    private array $history = [];
    private MockHandler $mock;
    private IuguService $service;

    public function setUp(): void
    {
        parent::setUp();
        $this->history = [];
        $this->mock = new MockHandler();
        $handlerStack = HandlerStack::create($this->mock);
        $handlerStack->push(Middleware::history($this->history));
        $client = new Client(['handler' => $handlerStack]);

        $this->service = new IuguHttpService('token12345', $client);
    }

    public function testCreateCustomer()
    {
        $this->mock->append(new Response(200, [], '{
            "id": "77C2565F6F064A26ABED4255894224F0",
            "email": "email@email.com",
            "name": "Nome do Cliente",
            "notes": "Anotações Gerais",
            "created_at": "2013-11-18T14:58:30-02:00",
            "updated_at": "2013-11-18T14:58:30-02:00",
            "custom_variables": []
        }'));

        $request = (new CreateCustomerRequest())
            ->setName('Nome do cliente')
            ->setEmail('email@email.com');

        $response = $this->service->createCustomer($request);

        /** @var Request $request */
        $request = $this->history[0]['request'];

        self::assertEquals('https://api.iugu.com/v1/customers', (string) $request->getUri());
        self::assertEquals('Bearer token12345', $request->getHeader('Authorization')[0]);
        self::assertEquals('POST', $request->getMethod());
        self::assertEquals('77C2565F6F064A26ABED4255894224F0', $response->getId());
    }
}