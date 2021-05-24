<?php


namespace PagSeguro;


use Common\Request;
use Common\Response;
use GuzzleHttp\Client;
use PagSeguro\Contracts\PagSeguroService;
use PagSeguro\Exceptions\BadRequestException;
use PagSeguro\Exceptions\ForbiddenException;
use PagSeguro\Exceptions\InvalidContentTypeException;
use PagSeguro\Exceptions\PagSeguroException;
use PagSeguro\Exceptions\UnauthorizedException;
use PagSeguro\Http\Checkout\CheckoutRequest;
use PagSeguro\Http\Checkout\CheckoutResponse;
use PagSeguro\Http\Transaction\NotificationRequest;
use PagSeguro\Http\Transaction\NotificationResponse;
use PagSeguro\Http\Transaction\TransactionRequest;
use PagSeguro\Http\Transaction\TransactionResponse;
use PagSeguro\Http\Transaction\TransactionsRequest;
use PagSeguro\Http\Transaction\TransactionsResponse;

class PagSeguroHttpService implements PagSeguroService
{
    private Client $http_client;
    private Configuration $config;

    /**
     * PagSeguroHttpService constructor.
     *
     * @param array $config
     * @param Client|null $http_client
     */
    public function __construct(array $config = [], ?Client $http_client = null)
    {
        $this->http_client = $http_client ?? new Client();
        $this->config = new Configuration($config);
    }

    function checkout(CheckoutRequest $request): CheckoutResponse
    {
        /** @var CheckoutResponse $response */
        $response = $this->request($request, fn($body) => new CheckoutResponse($body));
        return $response;
    }

    function checkoutUrl(string $code): string
    {
        return $this->getUri("/v2/checkout/payment.html?code=$code");
    }

    function searchTransactions(TransactionsRequest $request): TransactionsResponse
    {
        /** @var TransactionsResponse $response */
        $response = $this->request($request, fn($body) => new TransactionsResponse($body));
        return $response;
    }

    function getTransaction(TransactionRequest $request): TransactionResponse
    {
        /** @var TransactionResponse $response */
        $response = $this->request($request, fn($body) => new TransactionResponse($body));
        return $response;
    }

    function getNotification(NotificationRequest $request): NotificationResponse
    {
        /** @var NotificationResponse $response */
        $response = $this->request($request, fn($body) => new NotificationResponse($body));
        return $response;
    }

    /**
     * Make a request to the API
     *
     * @param Request $request
     * @param callback $parser
     * @return Response
     * @throws PagSeguroException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    function request(Request $request, $parser): Response
    {
        $options = array_merge([
            'headers' => [
                'Content-Type' => 'application/xml',
            ]
        ], $request->build());

        $response = $this->http_client->request($request->getMethod(), $this->getEndpointUri($request->getPath()), $options);
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
            ? 'https://pagseguro.uol.com.br'.$path
            : 'https://sandbox.pagseguro.uol.com.br'.$path;
    }

    private function getEndpointUri(string $path): string {
        return $this->config->isProduction()
            ? 'https://ws.pagseguro.uol.com.br'.$path
            : 'https://ws.sandbox.pagseguro.uol.com.br'.$path;
    }
}