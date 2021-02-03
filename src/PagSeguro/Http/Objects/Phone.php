<?php


namespace PagSeguro\Http\Objects;


use Common\XmlDecodable;
use Common\XmlEncodable;
use SimpleXMLElement;

class Phone implements XmlEncodable, XmlDecodable
{
    private string $areaCode;
    private string $number;

    /**
     * Phone constructor.
     * @param string $areaCode
     * @param string $number
     */
    public function __construct(string $areaCode = '', string $number = '')
    {
        $this->areaCode = $areaCode;
        $this->number = $number;
    }

    /**
     * @param string $areaCode
     * @return Phone
     */
    public function setAreaCode(string $areaCode): Phone
    {
        $this->areaCode = $areaCode;
        return $this;
    }

    /**
     * @param string $number
     * @return Phone
     */
    public function setNumber(string $number): Phone
    {
        $this->number = $number;
        return $this;
    }

    public function encode(SimpleXMLElement $root)
    {
         $phone = $root->addChild('phone');
         $phone->addChild('areaCode', $this->areaCode);
         $phone->addChild('number', $this->number);
    }

    public function decode(\SimpleXMLElement $root): XmlDecodable
    {
        $this->areaCode = $root->areaCode;
        $this->number = $root->number;
        return $this;
    }
}