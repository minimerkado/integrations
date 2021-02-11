<?php


namespace Revenuecat\Requests;


abstract class Request implements \Common\Request
{
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