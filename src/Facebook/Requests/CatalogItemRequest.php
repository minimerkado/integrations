<?php

namespace Facebook\Requests;

class CatalogItemRequest
{
    private string $retailer_id;
    private string $method = BatchMethod::UPDATE;

    public function setRetailerId(string $retailer_id): CatalogItemRequest
    {
        $this->retailer_id = $retailer_id;
        return $this;
    }

    public function setMethod(string $method): CatalogItemRequest
    {
        $this->method = $method;
        return $this;
    }

    public function toJson(): array
    {
        return [
            'retailer_id' => $this->retailer_id,
            'method' => $this->method,
        ];
    }
}