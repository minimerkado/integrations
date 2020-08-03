<?php


namespace MercadoPago\Requests\Checkout\Objects;

use Common\XmlObject;
use MercadoPago\Requests\Preference\Objects\Item;
use SimpleXMLElement;

class Items implements XmlObject
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
}