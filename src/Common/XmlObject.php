<?php


namespace Common;


interface XmlObject
{
    /**
     * Encode this request object to a SimpleXMLElement
     *
     * @param \SimpleXMLElement $root
     */
    public function encode(\SimpleXMLElement $root);
}