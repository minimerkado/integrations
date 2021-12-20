<?php

namespace MelhorEnvio;

use Common\Request;
use Common\Response;
use GuzzleHttp\Client;
use MelhorEnvio\Exceptions\MelhorEnvioException;


class MelhorEnvioHttpService
{
    protected Client $http_client;
    protected array $config;

    /**
     * @param Client $http_client
     * @param array $config
     */
    public function __construct(Client $http_client, array $config)
    {
        $this->http_client = $http_client;
        $this->config = $config;
    }

    /**
     *
     * @param Request $request
     * @param $parser
     * @return Response
     * @throws MelhorEnvioException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    function request(Request $request, $parser): Response
    {
        $options = array_merge([
            'headers' => [
                'Accept' => 'application/json',
            ],
        ], $request->build());

        $response = $this->http_client->request($request->getMethod(), $this->getUri($request->getPath()), $options);
        $status_code = $response->getStatusCode();
        $body = (string) $response->getBody();

        if ($status_code >= 200 && $status_code < 300)
            return $parser($body);

        throw new MelhorEnvioException("Status code: $status_code");
    }

    private function getUri(string $path): string {
        return Environment::isSandbox($this->config['environment'])
            ? 'https://sandbox.melhorenvio.com.br'.$path
            : 'https://www.melhorenvio.com.br'.$path;
    }
}