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
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;
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
        $this->mock->append(new Response(body: <<<XML
<?xml version="1.0" encoding="utf-8"?>
<cResultado xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns="http://tempuri.org/">
    <Servicos>
        <cServico>
            <Codigo>4510</Codigo>
            <Valor>39,50</Valor>
            <PrazoEntrega>15</PrazoEntrega>
            <ValorMaoPropria>0,00</ValorMaoPropria>
            <ValorAvisoRecebimento>0,00</ValorAvisoRecebimento>
            <ValorValorDeclarado>0,00</ValorValorDeclarado>
            <EntregaDomiciliar>S</EntregaDomiciliar>
            <EntregaSabado>N</EntregaSabado>
            <Erro>0</Erro>
            <MsgErro />
            <ValorSemAdicionais>39,50</ValorSemAdicionais>
            <obsFim />
        </cServico>        
    </Servicos>
</cResultado>
XML));
        $this->mock->append(new Response(body: <<<XML
<?xml version="1.0" encoding="utf-8"?>
<cResultado xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns="http://tempuri.org/">
    <Servicos>
        <cServico>
            <Codigo>4014</Codigo>
            <Valor>79,50</Valor>
            <PrazoEntrega>5</PrazoEntrega>
            <ValorMaoPropria>0,00</ValorMaoPropria>
            <ValorAvisoRecebimento>0,00</ValorAvisoRecebimento>
            <ValorValorDeclarado>0,00</ValorValorDeclarado>
            <EntregaDomiciliar>S</EntregaDomiciliar>
            <EntregaSabado>N</EntregaSabado>
            <Erro>0</Erro>
            <MsgErro />
            <ValorSemAdicionais>79,50</ValorSemAdicionais>
            <obsFim />
        </cServico>
    </Servicos>
</cResultado>
XML));
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

        $estimate = $this->service->estimate($payload, [
            ServiceType::PAC,
            ServiceType::SEDEX,
        ]);

        /** @var Request $request1 */
        $request1 = $this->history[0]['request'];
        /** @var Request $request2 */
        $request2 = $this->history[1]['request'];

        self::assertEquals('/calculador/CalcPrecoPrazo.asmx/CalcPrecoPrazo', $request1->getUri()->getPath());
        self::assertEquals('ws.correios.com.br', $request1->getUri()->getHost());
        self::assertEquals('nCdServico=4510&nCdEmpresa=Company%20Test&sDsSenha=password&sCepOrigem=57030170&sCepDestino=70800200&nVlPeso=2.1&nCdFormato=1&nVlComprimento=20&nVlAltura=20&nVlLargura=20&nVlDiametro=0&nVlValorDeclarado=150.5&sCdMaoPropria=N&sCdAvisoRecebimento=N', $request1->getUri()->getQuery());
        self::assertEquals('nCdServico=4014&nCdEmpresa=Company%20Test&sDsSenha=password&sCepOrigem=57030170&sCepDestino=70800200&nVlPeso=2.1&nCdFormato=1&nVlComprimento=20&nVlAltura=20&nVlLargura=20&nVlDiametro=0&nVlValorDeclarado=150.5&sCdMaoPropria=N&sCdAvisoRecebimento=N', $request2->getUri()->getQuery());
        self::assertCount(2, $estimate->getServicos());
        self::assertEquals(39.5, $estimate->getServicos()[0]->getValor());
        self::assertEquals(79.5, $estimate->getServicos()[1]->getValor());
    }
}