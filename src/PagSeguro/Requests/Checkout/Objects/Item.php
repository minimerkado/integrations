<?php


namespace PagSeguro\Requests\Checkout\Objects;


use PagSeguro\Requests\XMLEncodable;
use PagSeguro\Utilities;
use SimpleXMLElement;

class Item implements XMLEncodable
{
    use Utilities;

    private string $id;
    private string $description;
    private float $amount;
    private int $quantity;
    private float $weight = 1.0;
    private ?float $shippingCost = null;

    /**
     * @param string $id
     * @return Item
     */
    public function setId(string $id): Item
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @param string $description
     * @return Item
     */
    public function setDescription(string $description): Item
    {
        $this->description = $description;
        return $this;
    }

    /**
     * @param float $amount
     * @return Item
     */
    public function setAmount(float $amount): Item
    {
        $this->amount = $amount;
        return $this;
    }

    /**
     * @param int $quantity
     * @return Item
     */
    public function setQuantity(int $quantity): Item
    {
        $this->quantity = $quantity;
        return $this;
    }

    /**
     * @param float $weight
     * @return Item
     */
    public function setWeight(float $weight): Item
    {
        $this->weight = $weight;
        return $this;
    }

    /**
     * @param float|null $shippingCost
     * @return Item
     */
    public function setShippingCost(?float $shippingCost): Item
    {
        $this->shippingCost = $shippingCost;
        return $this;
    }

    public function encode(SimpleXMLElement $root)
    {
        $item = $root->addChild('item');
        $item->addChild('id', $this->id);
        $item->addChild('description', $this->description);
        $item->addChild('quantity', $this->quantity);
        $item->addChild('amount', $this->amount);
        $item->addChild('weight', $this->weight);
        self::when($this->shippingCost, fn($value) => $item->addChild('shippingCost', $value));
    }
}