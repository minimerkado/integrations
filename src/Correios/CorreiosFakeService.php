<?php


namespace Correios;


use Correios\Contracts\CorreiosService;
use Correios\Requests\EstimatePayload;
use Correios\Responses\EstimateResponse;

class CorreiosFakeService implements CorreiosService
{
    function estimate(EstimatePayload $payload, array $services): EstimateResponse
    {
        $response = new EstimateResponse();

        foreach ($services as $service)
        {
            $response->parse($this->build($service));
        }

        return $response;
    }

    private function build(string $service): string
    {
        return match ($service) {
            ServiceType::PAC => <<<XML
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
XML,
            default => <<<XML
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
XML
        };
    }
}