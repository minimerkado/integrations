<?php

namespace Iugu;

use Common\Request;
use Common\Response;
use GuzzleHttp\Client;
use Iugu\Contracts\IuguService;
use Iugu\Exceptions\BadRequestException;
use Iugu\Exceptions\IuguException;
use Iugu\Exceptions\UnauthorizedException;
use Iugu\Requests\Customer\CreateCustomerRequest;
use Iugu\Requests\Customer\DeleteCustomerRequest;
use Iugu\Requests\Customer\GetCustomerRequest;
use Iugu\Requests\Customer\UpdateCustomerRequest;
use Iugu\Responses\CustomerResponse;
use Iugu\Responses\EmptyResponse;

class IuguHttpService implements IuguService
{
    private Client $http_client;
    private string $token;

    /**
     * @param Client|null $http_client
     * @param string $token
     */
    public function __construct(string $token, ?Client $http_client = null)
    {
        $this->http_client = $http_client ?? new Client();
        $this->token = $token;
    }

    public function createCustomer(CreateCustomerRequest $request): CustomerResponse
    {
        /** @var CustomerResponse $customer */
        $customer = $this->request($request, fn ($body) => new CustomerResponse($body));
        return $customer;
    }

    public function UpdateCustomer(UpdateCustomerRequest $request): CustomerResponse
    {
        /** @var CustomerResponse $customer */
        $customer = $this->request($request, fn ($body) => new CustomerResponse($body));
        return $customer;
    }

    public function getCustomer(string $id): CustomerResponse
    {
        /** @var CustomerResponse $customer */
        $customer = $this->request(new GetCustomerRequest($id), fn ($body) => new CustomerResponse($body));
        return $customer;
    }

    public function deleteCustomer(string $id): EmptyResponse
    {
        /** @var EmptyResponse $response */
        $response = $this->request(new DeleteCustomerRequest($id), fn ($body) => new EmptyResponse());
        return $response;
    }

    /**
     * @throws IuguException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    function request(Request $request, callable $parser): Response
    {
        $options = array_merge([
            'headers' => [
                'Authorization' => "Bearer $this->token",
                'Accept' => 'application/json',
            ],
        ], $request->build());

        $response = $this->http_client->request($request->getMethod(), $this->getUri($request->getPath()), $options);
        $status_code = $response->getStatusCode();
        $body = (string) $response->getBody();

        if ($status_code >= 200 && $status_code < 300)
            return $parser($body);

        if ($status_code === 422)
            throw new BadRequestException(json_decode($body, true));

        if ($status_code >= 400 && $status_code <= 404)
            throw new UnauthorizedException();

        throw new IuguException("Status code: $status_code");
    }

    private function getUri(string $path): string
    {
        return 'https://api.iugu.com/v1'.$path;
    }
}