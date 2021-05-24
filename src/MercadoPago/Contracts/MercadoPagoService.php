<?php


namespace MercadoPago\Contracts;


use MercadoPago\Exceptions\MercadoPagoException;
use MercadoPago\Requests\GetIdentificationTypesRequest;
use MercadoPago\Requests\Payment\GetPaymentRequest;
use MercadoPago\Requests\Preference\CreatePreferenceRequest;
use MercadoPago\Responses\IdentificationTypesResponse;
use MercadoPago\Responses\PaymentResponse;
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

    /**
     * Veja todos os tipos de documentos disponíveis por país e obtenha uma lista
     * com a identificação e detalhes de cada um deles.
     *
     * @throws MercadoPagoException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getIdentificationTypes(GetIdentificationTypesRequest $request): IdentificationTypesResponse;

    /**
     * Obtém um pagamento através do ID
     *
     * @throws MercadoPagoException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getPayment(GetPaymentRequest $request): PaymentResponse;
}