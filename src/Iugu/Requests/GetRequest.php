<?php

namespace Iugu\Requests;

use Common\Utilities;

abstract  class GetRequest implements \Common\Request
{
    use Utilities;

    /**
     * Get json representation of this request
     *
     * @return array|null
     */
    public function query(): ?array
    {
        return null;
    }

    public function getMethod()
    {
        return 'GET';
    }

    public function build(): array
    {
        return self::not_null([
            'query' => $this->query(),
        ]);
    }
}