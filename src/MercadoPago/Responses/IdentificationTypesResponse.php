<?php


namespace MercadoPago\Responses;


class IdentificationTypesResponse extends CollectionResponse
{
    public function __construct(string $body)
    {
        $this->parse($body);
    }

    function make(mixed $json): mixed
    {
        return new IdentificationType($json);
    }
}