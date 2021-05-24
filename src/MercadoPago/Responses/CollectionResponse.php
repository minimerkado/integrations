<?php


namespace MercadoPago\Responses;


use Common\Response;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;

abstract class CollectionResponse implements Response
{
    private Collection $items;

    /**
     * @return Collection
     */
    public function getItems(): Collection
    {
        return $this->items;
    }

    public function parse(string $body)
    {
        $array = json_decode($body, true);

        if (is_array($array) && !Arr::isAssoc($array)) {
            $this->items = collect($array)->map(fn ($item) => $this->make($item));
        }
    }

    abstract function make(mixed $json): mixed;
}