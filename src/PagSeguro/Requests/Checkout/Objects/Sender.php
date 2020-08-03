<?php


namespace PagSeguro\Requests\Checkout\Objects;


use Common\Utilities;
use Common\XmlObject;
use SimpleXMLElement;

class Sender implements XmlObject
{
    use Utilities;

    private string $name;
    private string $email;
    private ?Phone $phone = null;
    private ?Documents $documents = null;

    /**
     * @param string $name
     * @return Sender
     */
    public function setName(string $name): Sender
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @param string $email
     * @return Sender
     */
    public function setEmail(string $email): Sender
    {
        $this->email = $email;
        return $this;
    }

    /**
     * @param Phone|null $phone
     * @return Sender
     */
    public function setPhone(?Phone $phone): Sender
    {
        $this->phone = $phone;
        return $this;
    }

    /**
     * @param Documents|null $documents
     * @return Sender
     */
    public function setDocuments(?Documents $documents): Sender
    {
        $this->documents = $documents;
        return $this;
    }

    /**
     * @param Document $document
     * @return $this
     */
    public function addDocument(Document $document): Sender
    {
        $this->documents ??= new Documents();
        $this->documents->addDocument($document);
        return $this;
    }

    public function encode(SimpleXMLElement $root)
    {
        $sender = $root->addChild('sender');
        $sender->addChild('name', $this->name);
        $sender->addChild('email', $this->email);
        self::when($this->phone, fn(Phone $phone) => $phone->encode($sender));
        self::when($this->documents, fn(Documents $value) => $value->encode($sender));
    }
}