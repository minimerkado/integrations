<?php


namespace MercadoPago;


use Common\Request;
use Common\Response;
use GuzzleHttp\Client;
use MercadoPago\Contracts\MercadoPagoService;
use MercadoPago\Exceptions\BadRequestException;
use MercadoPago\Exceptions\MercadoPagoException;
use MercadoPago\Exceptions\UnauthorizedException;
use MercadoPago\Requests\GetIdentificationTypesRequest;
use MercadoPago\Requests\Payment\GetPaymentRequest;
use MercadoPago\Requests\Preference\CreatePreferenceRequest;
use MercadoPago\Responses\IdentificationTypesResponse;
use MercadoPago\Responses\PaymentResponse;
use MercadoPago\Responses\PreferenceResponse;

class MercadoPagoHttpService implements MercadoPagoService
{
    private Client $http_client;

    /**
     * MercadoPagoHttpService constructor.
     * @param ?Client $http_client
     */
    public function __construct(?Client $http_client = null)
    {
        $this->http_client = $http_client ?? new Client();
    }

    /**
     * Veja todos os tipos de documentos disponíveis por país e obtenha uma lista
     * com a identificação e detalhes de cada um deles.
     *
     * @throws MercadoPagoException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getIdentificationTypes(GetIdentificationTypesRequest $request): IdentificationTypesResponse
    {
        /** @var IdentificationTypesResponse $response */
        $response = $this->request($request, fn($body) => new IdentificationTypesResponse($body));
        return $response;
    }

    /**
     * Obtém um pagamento através do ID
     *
     * @throws MercadoPagoException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getPayment(GetPaymentRequest $request): PaymentResponse
    {
        /** @var PaymentResponse $response */
        $response = $this->request($request, fn($body) => new PaymentResponse($body));
        return $response;
    }

    /**
     * Cria uma preferência no Mercado Pago
     *
     * @param CreatePreferenceRequest $request
     * @return PreferenceResponse
     * @throws MercadoPagoException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
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
        return 'https://api.mercadopago.com'.$path;
    }
}
