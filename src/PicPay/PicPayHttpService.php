<?php


namespace PicPay;


use Common\Request;
use Common\Response;
use GuzzleHttp\Client;
use PicPay\Contracts\PicPayService;
use PicPay\Exceptions\BadRequestException;
use PicPay\Exceptions\PicPayException;
use PicPay\Exceptions\UnauthorizedException;
use PicPay\Requests\Checkout\CheckoutRequest;
use PicPay\Responses\CancelResponse;
use PicPay\Responses\CheckoutResponse;
use PicPay\Responses\StatusResponse;

class PicPayHttpService implements PicPayService
{
    private Client $http_client;

    /**
     * PagSeguroHttpService constructor.
     *
     * @param ?Client $http_client
     */
    public function __construct(?Client $http_client = null)
    {
        $this->http_client = $http_client ?? new Client();
    }

    function checkout(CheckoutRequest $request): CheckoutResponse
    {
        /** @var CheckoutResponse $response */
        $response = $this->request($request, fn($body) => new CheckoutResponse($body));
        return $response;
    }

    function cancel(\PicPay\Requests\CancelRequest $request): \PicPay\Responses\CancelResponse
    {
        /** @var CancelResponse $response */
        $response = $this->request($request, fn($body) => new CancelResponse($body));
        return $response;
    }

    function status(\PicPay\Requests\StatusRequest $request): \PicPay\Responses\StatusResponse
    {
        /** @var StatusResponse $response */
        $response = $this->request($request, fn($body) => new StatusResponse($body));
        return $response;
    }

    /**
     * Método genérico para realizar requisições na API do PicPay
     *
     * @param Request $request objeto da requisição
     * @param callback $parser tradutor da resposta do API responsável por criar os objetos de retorno
     * @return Response
     * @throws BadRequestException
     * @throws PicPayException
     * @throws UnauthorizedException
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
        if ($status_code === 422) {
            throw new BadRequestException($body);
        }

        throw new PicPayException("Status code: $status_code");
    }

    private function getUri(string $path): string {
        return 'https://appws.picpay.com/ecommerce/public'.$path;
    }
}