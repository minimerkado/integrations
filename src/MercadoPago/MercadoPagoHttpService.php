<?php


namespace MercadoPago;


use Common\Request;
use Common\Response;
use GuzzleHttp\Client;
use MercadoPago\Contracts\MercadoPagoService;
use MercadoPago\Exceptions\BadRequestException;
use MercadoPago\Exceptions\MercadoPagoException;
use MercadoPago\Exceptions\UnauthorizedException;
use MercadoPago\Requests\Preference\CreatePreferenceRequest;
use MercadoPago\Responses\PreferenceResponse;

class MercadoPagoHttpService implements MercadoPagoService
{
    private Client $http_client;
    private Configuration $config;

    /**
     * MercadoPagoHttpService constructor.
     * @param array $config
     * @param ?Client $http_client
     */
    public function __construct($config = [], ?Client $http_client = null)
    {
        $this->http_client = $http_client ?? new Client();
        $this->config = new Configuration($config);
    }

    public function createPreference(CreatePreferenceRequest $request): PreferenceResponse
    {
        /** @var PreferenceResponse $response */
        $response = $this->request($request, fn($body) => new PreferenceResponse($body));
        return $response;
    }

    /**
     * Executa uma request na API do Mercado Pago
     *
     * @param Request $request dados da requisição
     * @param callback $parser tradutor da resposta
     * @return Response
     * @throws MercadoPagoException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    function request(Request $request, $parser): Response
    {
        $response = $this->http_client->request($request->getMethod(), $this->getUri($request->getPath()), $request->build());
        $status_code = $response->getStatusCode();
        $body = (string) $response->getBody();

        if ($status_code >= 200 && $status_code < 300) {
            return $parser($body);
        }

        if ($status_code === 401) {
            throw new UnauthorizedException();
        }
        if ($status_code === 400) {
            throw new BadRequestException($body);
        }

        throw new MercadoPagoException("Invalid status code $status_code: $body");
    }

    private function getUri(string $path): string
    {
        return $this->config->isProduction()
            ? 'https://www.mercadopago.com/mla'.$path
            : 'https://sandbox.mercadopago.com/mla'.$path;
    }
}