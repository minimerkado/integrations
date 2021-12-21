<?php

namespace Iugu\Exceptions;

class BadRequestException extends IuguException {
    protected array $body = [];

    public function __construct(array $body)
    {
        $this->body = $body;
        parent::__construct("Unable to process this request", 422);
    }

    public function getBody(): array
    {
        return $this->body;
    }

    public function getErrors(): array
    {
        return $this->body['errors'] ?? [];
    }
}