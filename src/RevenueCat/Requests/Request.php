<?php


namespace RevenueCat\Requests;


use Common\Utilities;

abstract class Request implements \Common\Request
{
    use Utilities;

    /**
     * Get json representation of this request
     *
     * @return array|null
     */
    abstract public function toJson(): ?array;

    public function build(): array
    {
        return self::not_null([
            'json' => $this->toJson(),
        ]);
    }
}