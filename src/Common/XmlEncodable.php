<?php


namespace Common;


interface XmlEncodable
{
    /**
     * Encode this object to a SimpleXMLElement
     *
     * @param \SimpleXMLElement $root
     */
    public function encode(\SimpleXMLElement $root);
}