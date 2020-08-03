<?php


namespace MercadoPago\Contracts;


use MercadoPago\Exceptions\MercadoPagoException;
use MercadoPago\Requests\Preference\CreatePreferenceRequest;
use MercadoPago\Responses\PreferenceResponse;

interface MercadoPagoService
{
    /**
     * Cria uma Preferência
     *
     * @param CreatePreferenceRequest $request
     * @return PreferenceResponse
     * @throws MercadoPagoException
     */
    public function createPreference(CreatePreferenceRequest $request): PreferenceResponse;
}