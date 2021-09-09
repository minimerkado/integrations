<?php


namespace Correios\Responses;


use Common\Response;
use Correios\ServiceType;
use NumberFormatter;

class Servico implements Response
{
    private string $servico;
    private int $prazo_entrega;
    private float $valor;
    private ?int $error_code = null;
    private ?string $error_message = null;

    public function getNomeServico(): string
    {
        return ServiceType::name($this->servico);
    }

    public function getServico(): string
    {
        return $this->servico;
    }

    public function getPrazoEntrega(): int
    {
        return $this->prazo_entrega;
    }

    public function getValor(): float
    {
        return $this->valor;
    }

    public function getValorInCents(): int
    {
        return intval($this->valor * 100);
    }

    public function getErrorCode(): ?int
    {
        return $this->error_code;
    }

    public function getErrorMessage(): ?string
    {
        return $this->error_message;
    }

    public function __construct(string $body)
    {
        $this->parse($body);
    }

    public function parse(string $body)
    {
        $formatter = new NumberFormatter('pt_BR', NumberFormatter::DECIMAL);
        $xml = simplexml_load_string($body);

        foreach ($xml->Servicos as $servico) {
            if ($cServico = $servico->cServico) {
                if ($error_code = intval($cServico->Erro)) {
                    $this->error_code = $error_code;
                    $this->error_message = (string) $cServico->MsgErro;
                }

                $this->servico = (string) $cServico->Codigo;
                $this->prazo_entrega = intval($cServico->PrazoEntrega);
                $this->valor = $formatter->parse($cServico->Valor);
                return;
            }
        }
    }
}