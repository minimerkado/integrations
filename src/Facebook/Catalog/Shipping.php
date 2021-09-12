<?php

namespace Facebook\Catalog;

use Common\Utilities;
use Common\XmlEncodable;
use Money\Money;

class Shipping implements XmlEncodable
{
    use Utilities;

    const WEIGHT_G  = 'g';
    const WEIGHT_KG = 'kg';
    const WEIGHT_LB = 'lb';
    const WEIGHT_OZ = 'oz';

    private string $country;
    private string $region;
    private string $service;
    private float $weight;
    private string $weight_unit;
    private Money $price;

    public function __construct()
    {
        $this->weight_unit = self::WEIGHT_G;
    }

    public function encode(\SimpleXMLElement $root)
    {
        $price = self::formatByDecimal($this->price, show_currency: true);

        $root->addChild('shipping', "$this->country:$this->region:$this->service:$price");
        $root->addChild('shipping_weight', "$this->weight $this->weight_unit");
    }
}