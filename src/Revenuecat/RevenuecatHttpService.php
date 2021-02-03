<?php


namespace Revenuecat;


use Common\Request;
use Common\Response;
use GuzzleHttp\Client;
use Revenuecat\Contracts\RevenuecatService;
use Revenuecat\Exceptions\RevenuecatException;
use Revenuecat\Exceptions\UnauthorizedException;
use Revenuecat\Requests\SubscribersRequest;
use Revenuecat\Responses\SubscribersResponse;

class RevenuecatHttpService implements RevenuecatService
{
    private Client $http_client;
    private string $token;

    /**
     * PagSeguroHttpService constructor.
     *
     * @param ?Client $http_client
     */
    public function __construct(?Client $http_client = null)
    {
        $this->http_client = $http_client ?? new Client();
    }

    function get(SubscribersRequest $request): SubscribersResponse
    {
        /** @var SubscribersResponse $response */
        $response = $this->request($request, fn($body) => new SubscribersResponse($body));
        return $response;
    }

    /**
     * @param Request $request
     * @param $parser
     * @return Response
     * @throws RevenuecatException
     * @throws UnauthorizedException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    function request(Request $request, $parser): Response
    {
        $options = array_merge([
            "headers" => [
                "Authorization: Bearer $this->token",
                'Accept' => 'application/json',
            ],
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

        throw new RevenuecatException("Status code: $status_code");
    }

    private function getUri(string $path): string {
        return 'https://api.revenuecat.com'.$path;
    }
}