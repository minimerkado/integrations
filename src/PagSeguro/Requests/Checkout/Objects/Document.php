<?php


namespace PagSeguro\Requests\Checkout\Objects;


use Common\XmlObject;
use SimpleXMLElement;

class Document implements XmlObject
{
    const TYPE_CPF = 'CPF';
    const TYPE_CNPJ = 'CNPJ';

    private string $type;
    private string $value;

    /**
     * Document constructor.
     * @param string $type
     * @param string $value
     */
    public function __construct(string $type, string $value)
    {
        $this->type = $type;
        $this->value = $value;
    }

    /**
     * @param string $type
     * @return Document
     */
    public function setType(string $type): Document
    {
        $this->type = $type;
        return $this;
    }

    /**
     * @param string $value
     * @return Document
     */
    public function setValue(string $value): Document
    {
        $this->value = $value;
        return $this;
    }

    public function encode(SimpleXMLElement $root)
    {
        $document = $root->addChild('document');
        $document->addChild('type', $this->type);
        $document->addChild('value', $this->value);
    }
}