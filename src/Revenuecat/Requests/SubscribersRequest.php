<?php


namespace Revenuecat\Requests;

use Common\Utilities;

class SubscribersRequest extends Request
{
    use Utilities;
    private string $app_user_id;

    /**
     * SubscribersRequest constructor.
     * @param string $app_user_id
     */
    public function __construct(string $app_user_id)
    {
        $this->app_user_id = $app_user_id;
    }

    public function getMethod()
    {
        return 'GET';
    }

    public function getPath()
    {
        return "/v1/subscribers/$this->app_user_id";
    }

    public function toJson(): array
    {
        return self::not_null([
            'app_user_id' => $this->app_user_id,
            'fetch_token' => "",
        ]);
    }
}