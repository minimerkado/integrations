<?php


namespace PagSeguro\Requests\Checkout\Objects;


use Common\XmlObject;
use SimpleXMLElement;

class Receiver implements XmlObject
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