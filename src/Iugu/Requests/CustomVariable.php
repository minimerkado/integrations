<?php

namespace Iugu\Requests;

use Common\Utilities;

class CustomVariable
{
    use Utilities;

    private string $name;
    private string $value;
    private ?bool $destroy;

    public function __construct(string $name, string $value, ?bool $destroy = null)
    {
        $this->name = $name;
        $this->value = $value;
        $this->destroy = $destroy;
    }

    public function toJson(): array {
        return self::not_null([
            'name' => $this->name,
            'value' => $this->value,
            '_destroy' => $this->destroy,
        ]);
    }
}