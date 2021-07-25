<?php


namespace Correios\Contracts;


use Correios\Requests\EstimatePayload;
use Correios\Responses\EstimateResponse;

interface CorreiosService
{
    /**
     * Calcula preço e prazo na API dos correios
     *
     * @param EstimatePayload $payload
     * @param array $services
     * @return EstimateResponse
     */
    function estimate(EstimatePayload $payload, array $services): EstimateResponse;
}