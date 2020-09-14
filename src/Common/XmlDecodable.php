<?php


namespace Common;


interface XmlDecodable
{
    /**
     * Decode this object from a SimpleXMLElement
     *
     * @param \SimpleXMLElement $root
     * @return $this
     */
    public function decode(\SimpleXMLElement $root): self;
}