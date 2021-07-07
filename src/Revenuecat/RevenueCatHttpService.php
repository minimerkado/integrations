<?php


namespace RevenueCat;


use Common\Request;
use Common\Response;
use GuzzleHttp\Client;
use Illuminate\Support\Arr;
use RevenueCat\Contracts\RevenueCatService;
use RevenueCat\Exceptions\BadRequestException;
use RevenueCat\Exceptions\NotFoundException;
use RevenueCat\Exceptions\RevenueCatException;
use RevenueCat\Exceptions\UnauthorizedException;
use RevenueCat\Requests\GetSubscriberRequest;
use RevenueCat\Responses\SubscriberResponse;

class RevenueCatHttpService implements RevenueCatService
{
    private Client $http_client;
    private string $token;

    /**
     * RevenueCatHttpService constructor.
     *
     * @param array $config
     * @param Client|null $http_client
     */
    public function __construct(array $config, ?Client $http_client = null)
    {
        $this->http_client = $http_client ?? new Client();
        $this->token = Arr::get($config, 'key', '');
    }

    /**
     * Gets the latest subscriber info or creates one if it doesn't exist.
     * 
     * @param string $user_id
     * @return SubscriberResponse
     * @throws RevenueCatException
     * @throws UnauthorizedException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    function getSubscriber(string $user_id): SubscriberResponse
    {
        /** @var SubscriberResponse $response */
        $response = $this->request(new GetSubscriberRequest($user_id), fn($body) => new SubscriberResponse($body));
        return $response;
    }

    /**
     * @param Request $request
     * @param $parser
     * @return Response
     * @throws RevenueCatException
     * @throws UnauthorizedException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    function request(Request $request, $parser): Response
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

        if ($status_code === 400)
            throw new BadRequestException();

        if ($status_code === 401)
            throw new UnauthorizedException();

        if ($status_code === 404)
            throw new NotFoundException();

        throw new RevenueCatException("Status code: $status_code");
    }

    private function getUri(string $path): string {
        return 'https://api.revenuecat.com'.$path;
    }
}