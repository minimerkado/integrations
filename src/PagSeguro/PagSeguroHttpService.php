<?php


namespace PagSeguro;


use GuzzleHttp\Client;
use PagSeguro\Contracts\PagSeguroService;
use PagSeguro\Exceptions\BadRequestException;
use PagSeguro\Exceptions\ForbiddenException;
use PagSeguro\Exceptions\InvalidContentTypeException;
use PagSeguro\Exceptions\PagSeguroException;
use PagSeguro\Exceptions\UnauthorizedException;
use PagSeguro\Requests\Checkout\CheckoutRequest;
use PagSeguro\Requests\Request;
use PagSeguro\Responses\CheckoutResponse;
use PagSeguro\Responses\Response;

class PagSeguroHttpService implements PagSeguroService
{
    private Client $http_client;
    private PagSeguroConfiguration $config;

    /**
     * PagSeguroHttpService constructor.
     * @param Client $http_client
     * @param PagSeguroConfiguration $config
     */
    public function __construct(PagSeguroConfiguration $config, ?Client $http_client = null)
    {
        $this->http_client = $http_client ?? new Client();
        $this->config = $config;
    }

    function createCheckout(CheckoutRequest $request): CheckoutResponse
    {
        /** @var CheckoutResponse $response */
        $response = $this->request($request, fn($body) => new CheckoutResponse($body));
        return $response;
    }

    function getCheckoutUrl(string $code): string
    {
        return $this->getUri("/checkout/payment.html?code=$code");
    }

    function request(Request $request, $parser): Response
    {
        $options = array_merge([
            'headers' => [
                'Content-Type' => 'application/xml',
            ]
        ], $request->build());

        $response = $this->http_client->request($request->getMethod(), $this->getUri($request->getPath()), $options);
        $status_code = $response->getStatusCode();
        $body = (string) $response->getBody();

        if ($status_code >= 200 && $status_code < 300) {
            return $parser($body);
        }
        if ($status_code === 401) {
            throw new UnauthorizedException();
        }
        if ($status_code === 403) {
            throw new ForbiddenException();
        }
        if ($status_code === 415) {
            throw new InvalidContentTypeException();
        }
        if ($status_code === 400) {
            throw new BadRequestException($body);
        }

        throw new PagSeguroException("Status code: $status_code");
    }

    private function getUri(string $path): string {
        return $this->config->isProduction()
            ? 'https://pagseguro.uol.com.br/v2'.$path
            : 'https://sandbox.pagseguro.uol.com.br/v2'.$path;
    }
}