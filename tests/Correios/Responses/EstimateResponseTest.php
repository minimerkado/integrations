<?php


namespace Tests\Correios\Responses;


use Correios\Responses\EstimateResponse;
use Orchestra\Testbench\TestCase;

class EstimateResponseTest extends TestCase
{
    public function testParse()
    {
        $response = new EstimateResponse();
        $response->parse(<<<XML
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
XML);
        $response->parse(<<<XML
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
XML);
        $response->parse(<<<XML
<?xml version="1.0" encoding="utf-8"?>
<cResultado xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns="http://tempuri.org/">
    <Servicos>
        <cServico>
            <Codigo>4510</Codigo>
            <Valor>0,00</Valor>
            <PrazoEntrega>0</PrazoEntrega>
            <ValorMaoPropria>0,00</ValorMaoPropria>
            <ValorAvisoRecebimento>0,00</ValorAvisoRecebimento>
            <ValorValorDeclarado>0,00</ValorValorDeclarado>
            <EntregaDomiciliar />
            <EntregaSabado />
            <Erro>-888</Erro>
            <MsgErro>Não foi encontrada precificação. ERP-013: Vlr declarado nao permitido, aceito entre R$ 21,00 e R$ 3000,00(-1).</MsgErro>
            <ValorSemAdicionais>0,00</ValorSemAdicionais>
            <obsFim />
        </cServico>
    </Servicos>
</cResultado>
XML);

        $services = $response->getServicos();

        self::assertNull($services[0]->getErrorCode());
        self::assertEquals(79.50, $services[0]->getValor());
        self::assertEquals(5, $services[0]->getPrazoEntrega());

        self::assertNull($services[1]->getErrorCode());
        self::assertEquals(39.50, $services[1]->getValor());
        self::assertEquals(15, $services[1]->getPrazoEntrega());

        self::assertEquals(-888, $services[2]->getErrorCode());
    }

    public function testParseWithError()
    {
        $response = new EstimateResponse();

        $response->parse(<<<XML
<?xml version="1.0" encoding="utf-8"?>
<cResultado xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns="http://tempuri.org/">
    <Servicos>
        <cServico>
            <Codigo>4510</Codigo>
            <Valor>21,00</Valor>
            <PrazoEntrega>12</PrazoEntrega>
            <ValorMaoPropria>0,00</ValorMaoPropria>
            <ValorAvisoRecebimento>0,00</ValorAvisoRecebimento>
            <ValorValorDeclarado>0,00</ValorValorDeclarado>
            <EntregaDomiciliar>S</EntregaDomiciliar>
            <EntregaSabado>N</EntregaSabado>
            <Erro>011</Erro>
            <MsgErro>O CEP de destino está sujeito a condições especiais de entrega pela  ECT e será realizada com o acréscimo de até 5 (cinco) dias úteis ao prazo regular.</MsgErro>
            <ValorSemAdicionais>21,00</ValorSemAdicionais>
            <obsFim>O CEP de destino está sujeito a condições especiais de entrega pela  ECT e será realizada com o acréscimo de até 5 (cinco) dias úteis ao prazo regular.</obsFim>
        </cServico>
    </Servicos>
</cResultado>
XML);

        $services = $response->getServicos();

        self::assertEquals('011', $services[0]->getErrorCode());
        self::assertEquals(21.00, $services[0]->getValor());
        self::assertEquals(12, $services[0]->getPrazoEntrega());
    }
}