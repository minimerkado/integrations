<?php


namespace Tests\Correios;


use Correios\CorreiosHttpService;
use Correios\PackageType;
use Correios\Requests\EstimatePayload;
use Correios\ServiceType;
use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Middleware;
use Orchestra\Testbench\TestCase;

class CorreiosHttpServiceTest extends TestCase
{
    private array $history = [];
    private MockHandler $mock;
    private CorreiosHttpService $service;

    protected function setUp(): void
    {
        parent::setUp();
        $this->history = [];
        $this->mock = new MockHandler();
        $handlerStack = HandlerStack::create($this->mock);
        $handlerStack->push(Middleware::history($this->history));
        $client = new Client(['handler' => $handlerStack]);

        $this->service = new CorreiosHttpService($client);
    }


    public function testEstimate()
    {
        $payload = EstimatePayload::make()
            ->setPackage(PackageType::CAIXA)
            ->setOrigin('57030170')
            ->setDestination('70800200')
            ->setWidth(20.2)
            ->setHeight(20.2)
            ->setLength(20.2)
            ->setWeight(2.1)
            ->setDeclaredValue(150.50)
            ->setCompany('Company Test')
            ->setPassword('password');

        $this->service->estimate($payload, [
            ServiceType::PAC,
            ServiceType::SEDEX,
        ]);
    }
}