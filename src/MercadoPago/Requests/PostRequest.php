<?php


namespace MercadoPago\Requests;


abstract class PostRequest extends Request
{
    /**
     * Get json representation of this request
     *
     * @return array
     */
    abstract public function toJson(): array;

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