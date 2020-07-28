<?php


namespace PicPay;


use GuzzleHttp\Client;
use PicPay\Requests\Request;
use PicPay\Contracts\PicPayService;
use PicPay\Exceptions\BadRequestException;
use PicPay\Exceptions\PicPayException;
use PicPay\Exceptions\UnauthorizedException;
use PicPay\Requests\Checkout\CheckoutRequest;
use PicPay\Responses\CheckoutResponse;
use PicPay\Responses\Response;

class PicPayHttpService implements PicPayService
{
    private Client $http_client;
    private Configuration $config;

    /**
     * PagSeguroHttpService constructor.
     * @param Client $http_client
     * @param Configuration $config
     */
    public function __construct(Configuration $config, ?Client $http_client = null)
    {
        $this->http_client = $http_client ?? new Client();
        $this->config = $config;
    }

    /**
     * @param CheckoutRequest $request
     * @return CheckoutResponse
     * @throws BadRequestException
     * @throws PicPayException
     * @throws UnauthorizedException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    function checkout(CheckoutRequest $request): CheckoutResponse
    {
        /** @var CheckoutResponse $response */
        $response = $this->request($request, fn($body) => new CheckoutResponse($body));
        return $response;
    }

    /**
     * @param Request $request
     * @param $parser
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
        return $this->config->isProduction()
            ? 'https://appws.picpay.com/ecommerce/public'.$path
            : 'https://dev.picpay.com/ecommerce/public'.$path;
    }

    private function getToken(){
        return "";
    }
}