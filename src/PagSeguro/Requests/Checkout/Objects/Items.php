<?php


namespace PagSeguro\Requests\Checkout\Objects;


use PagSeguro\Requests\XMLEncodable;
use SimpleXMLElement;

class Items implements XMLEncodable
{
    /** @var Item[]  */
    private array $items = [];

    /**
     * @param Item $item
     * @return Items
     */
    public function addItem(Item $item): Items
    {
        $this->items[] = $item;
        return $this;
    }

    public function encode(SimpleXMLElement $root)
    {
        $items = $root->addChild('items');
        foreach ($this->items as $item) {
            $item->encode($items);
        }
    }
}