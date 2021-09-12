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
        $root = new SimpleXMLElement("<rss xmlns:g=\"$namespace\" version=\"2.0\" />");
        $channel = $root->addChild("channel");

        $this->encode($channel);

        $document = new DOMDocument();
        $document->preserveWhiteSpace = false;
        $document->formatOutput = true;
        $document->loadXML($root->asXML());

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