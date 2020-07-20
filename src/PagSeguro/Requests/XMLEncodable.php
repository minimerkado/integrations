<?php


namespace PagSeguro\Requests;


use SimpleXMLElement;

interface XMLEncodable
{
    /**
     * Encode this request object to a SimpleXMLElement
     *
     * @param SimpleXMLElement $root
     */
    public function encode(SimpleXMLElement $root);
}