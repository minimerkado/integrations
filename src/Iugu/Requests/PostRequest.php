<?php

namespace Iugu\Requests;

use Common\Utilities;

abstract class PostRequest implements \Common\Request
{
    use Utilities;

    /**
     * Get json representation of this request
     *
     * @return array|null
     */
    abstract public function toJson(): ?array;

    public function getMethod()
    {
        return 'POST';
    }

    public function build(): array
    {
        return self::not_null([
            'json' => $this->toJson(),
        ]);
    }
}