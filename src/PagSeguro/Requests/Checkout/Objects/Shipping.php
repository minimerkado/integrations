<?php

namespace PagSeguro\Requests\Checkout\Objects;

use PagSeguro\Utilities;
use PagSeguro\Requests\XMLEncodable;
use SimpleXMLElement;

class Shipping implements XMLEncodable
{
    use Utilities;

    const TYPE_NORMAL = 1;
    const TYPE_SEDEX = 2;
    const TYPE_OUTRO = 3;

    private bool $addressRequired = false;
    private int $type = self::TYPE_NORMAL;
    private float $cost = 0.0;
    private ?Address $address = null;

    /**
     * @param Address|null $address
     * @return Shipping
     */
    public function setAddress(?Address $address): Shipping
    {
        $this->address = $address;
        return $this;
    }

    /**
     * @param bool $addressRequired
     * @return Shipping
     */
    public function setAddressRequired(bool $addressRequired): Shipping
    {
        $this->addressRequired = $addressRequired;
        return $this;
    }

    /**
     * @param int $type
     * @return Shipping
     */
    public function setType(int $type): Shipping
    {
        $this->type = $type;
        return $this;
    }

    /**
     * @param float $cost
     * @return Shipping
     */
    public function setCost(float $cost): Shipping
    {
        $this->cost = $cost;
        return $this;
    }

    public function encode(SimpleXMLElement $root)
    {
        $shipping = $root->addChild('shipping');
        $shipping->addChild('type', $this->type);
        $shipping->addChild('cost', $this->cost);
        $shipping->addChild('addressRequired', $this->addressRequired);
        self::when($this->address, fn($address) => $address->encode($shipping));
    }
}