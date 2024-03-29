<?php

namespace Facebook\Catalog;

use Common\Utilities;
use Common\XmlEncodable;
use DOMDocument;
use SimpleXMLElement;

class Catalog implements XmlEncodable
{
    use Utilities;

    const GOOGLE_NS = 'http://base.google.com/ns/1.0';

    private string $title;
    private string $link;
    private ?string $description;
    private array $items = [];

    public function asXml(): string
    {
        $namespace = self::GOOGLE_NS;
        $root = new SimpleXMLElement("<?xml version=\"1.0\" encoding=\"UTF-8\"?><rss xmlns:g=\"$namespace\" version=\"2.0\" />");
        $channel = $root->addChild("channel");

        $this->encode($channel);

        $xml = $root->asXML();
        $xml = preg_replace('/[^\x{0009}\x{000a}\x{000d}\x{0020}-\x{D7FF}\x{E000}-\x{FFFD}]+/u', ' ', $xml);

        $document = new DOMDocument('1.0','UTF-8');
        $document->preserveWhiteSpace = false;
        $document->formatOutput = true;
        $document->loadXML($xml);

        return $document->saveXML();
    }

    public function encode(\SimpleXMLElement $root)
    {
        $root->addChild('title', htmlspecialchars($this->title));
        $root->addChild('link', htmlspecialchars($this->link));
        $root->addChild('description', htmlspecialchars($this->description ?? ''));

        foreach ($this->items as $item) {
            $item->encode($root);
        }
    }

    /**
     * @param string $title
     * @return Catalog
     */
    public function setTitle(string $title): Catalog
    {
        $this->title = $title;
        return $this;
    }

    /**
     * @param string $link
     * @return Catalog
     */
    public function setLink(string $link): Catalog
    {
        $this->link = $link;
        return $this;
    }

    /**
     * @param string|null $description
     * @return Catalog
     */
    public function setDescription(?string $description): Catalog
    {
        $this->description = $description;
        return $this;
    }

    /**
     * @param array $items
     * @return Catalog
     */
    public function setItems(array $items): Catalog
    {
        $this->items = $items;
        return $this;
    }

    /**
     * @param Item $item
     * @return $this
     */
    public function addItem(Item $item): Catalog
    {
        $this->items[] = $item;
        return $this;
    }
}