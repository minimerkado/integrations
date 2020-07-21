<?php


namespace PagSeguro\Requests\Checkout\Objects;


use PagSeguro\Requests\XMLEncodable;
use SimpleXMLElement;

class Phone implements XMLEncodable
{
    private string $areaCode;
    private string $number;

    /**
     * Phone constructor.
     * @param string $areaCode
     * @param string $number
     */
    public function __construct(string $areaCode, string $number)
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
}