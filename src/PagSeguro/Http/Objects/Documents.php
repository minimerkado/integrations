<?php


namespace PagSeguro\Http\Objects;


use Common\XmlEncodable;
use SimpleXMLElement;

class Documents implements XmlEncodable
{
    /** @var Document[] */
    private array $documents = [];

    /**
     * @param Document $document
     * @return Documents
     */
    public function addDocument(Document $document): Documents
    {
        $this->documents[] = $document;
        return $this;
    }

    public function encode(SimpleXMLElement $root)
    {
        $documents = $root->addChild('documents');
        foreach ($this->documents as $document) {
            $document->encode($documents);
        }
    }
}