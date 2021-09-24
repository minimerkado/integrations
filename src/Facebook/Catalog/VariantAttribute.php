<?php

namespace Facebook\Catalog;

use Common\XmlEncodable;

class VariantAttribute implements XmlEncodable
{
    private string $label;
    private string $value;

    public function __construct(string $label, string $value)
    {
        $this->label = $label;
        $this->value = $value;
    }

    public function encode(\SimpleXMLElement $root)
    {
        $variant = $root->addChild('additional_variant_attribute');
        $variant->addChild('label', htmlspecialchars($this->label));
        $variant->addChild('value', htmlspecialchars($this->value));
    }
}