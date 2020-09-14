<?php


namespace PagSeguro\Http\Objects;


use Common\XmlDecodable;
use Common\XmlEncodable;
use SimpleXMLElement;

class Items implements XmlEncodable, XmlDecodable
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

    public function decode(\SimpleXMLElement $root): Items
    {
        foreach ($root->children() as $item) {
            $this->items[] = (new Item())->decode($item);
        }

        return $this;
    }
}