<?php


namespace Correios\Responses;


use Common\Response;

class EstimateResponse implements Response
{
    private array $servicos = [];

    public function getServicos(): array
    {
        return $this->servicos;
    }

    public function parse(string $body): void
    {
        $this->servicos[] = new Servico($body);
    }
}