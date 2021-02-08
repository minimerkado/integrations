<?php


namespace Revenuecat\Requests;


abstract class Request implements \Common\Request
{

    protected string $access_token = '';

    /**
     * Request constructor.
     * @param string $access_token
     */
    public function __construct(string $access_token)
    {
        $this->access_token = $access_token;
    }

    /**
     * Get json representation of this request
     *
     * @return array
     */
    abstract public function toJson(): array;

    public function build(): array
    {
        return [
            'json' => $this->toJson(),
        ];
    }
}