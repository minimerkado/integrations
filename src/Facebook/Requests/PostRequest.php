<?php

namespace Facebook\Requests;

abstract class PostRequest extends Request
{
    public abstract function toJson(): array;

    public function getMethod()
    {
        return 'POST';
    }

    public function build(): array
    {
        return array_merge(parent::build(), [
            'json' => $this->toJson(),
        ]);
    }
}