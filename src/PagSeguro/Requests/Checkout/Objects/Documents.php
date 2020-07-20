<?php


namespace PagSeguro\Requests\Checkout\Objects;


use PagSeguro\Requests\XMLEncodable;
use SimpleXMLElement;

class Documents implements XMLEncodable
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