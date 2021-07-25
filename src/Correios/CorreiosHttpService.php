<?php


namespace Correios;


use Common\Request;
use Common\Response;
use Correios\Contracts\CorreiosService;
use Correios\Exceptions\CorreiosException;
use Correios\Requests\EstimatePayload;
use Correios\Responses\EstimateResponse;
use GuzzleHttp\Client;

class CorreiosHttpService implements CorreiosService
{
    private Client $http_client;

    /**
     * CorreiosHttpService constructor.
     *
     * @param ?Client $http_client
     */
    public function __construct(?Client $http_client = null)
    {
        $this->http_client = $http_client ?? new Client();
    }

    function estimate(EstimatePayload $payload, array $services): EstimateResponse
    {
        $response = new EstimateResponse();

        foreach ($services as $service)
        {
            $this->request(
                method: $payload->getMethod(),
                path: $payload->getPath(),
                payload: $payload->build($service),
                parser: fn ($body) => $response->parse($body)
            );
        }

        return $response;
    }

    /**
     * Executa uma requisição na API dos correios
     *
     * @param string $method
     * @param string $path
     * @param array $payload
     * @param $parser
     * @return Response
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    function request(string $method, string $path, array $payload, $parser): Response
    {
        $options = array_merge($payload, [
            'http_errors' => false
        ]);

        $response = $this->http_client->request(
            method: $method,
            uri: $this->getUri($path),
            options: $options
        );

        $status_code = $response->getStatusCode();
        $body = (string) $response->getBody();

        if ($status_code >= 200 && $status_code < 300) {
            return $parser($body);
        }

        throw new CorreiosException("Invalid status code $status_code: $body");
    }

    private function getUri(string $path): string
    {
        return 'http://ws.correios.com.br'.$path;
    }
}