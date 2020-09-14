<?php


namespace PagSeguro\Http\Objects;


use Common\XmlEncodable;
use SimpleXMLElement;

class Receiver implements XmlEncodable
{
    private string $email;

    /**
     * Receiver constructor.
     * @param string $email
     */
    public function __construct(string $email)
    {
        $this->email = $email;
    }

    public function encode(SimpleXMLElement $root)
    {
        $receiver = $root->addChild('receiver');
        $receiver->addChild('email', $this->email);
    }
}