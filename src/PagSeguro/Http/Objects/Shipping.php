<?php

namespace PagSeguro\Http\Objects;

use Common\Utilities;
use Common\XmlDecodable;
use Common\XmlEncodable;
use SimpleXMLElement;

class Shipping implements XmlEncodable, XmlDecodable
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
        $shipping->addChild('cost', number_format($this->cost, 2));
        $shipping->addChild('addressRequired', $this->addressRequired ? 'true' : 'false');
        self::when($this->address, fn($address) => $address->encode($shipping));
    }

    public function decode(\SimpleXMLElement $root): Shipping
    {
        $this->type = (int) $root->type;
        $this->cost = (float) $root->cost;
        $this->address = self::when($root->address, fn($xml) => (new Address())->decode($xml));

        return $this;
    }
}