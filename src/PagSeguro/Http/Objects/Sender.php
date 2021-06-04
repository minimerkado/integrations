<?php


namespace PagSeguro\Http\Objects;


use Common\Utilities;
use Common\XmlDecodable;
use Common\XmlEncodable;
use SimpleXMLElement;

class Sender implements XmlEncodable, XmlDecodable
{
    use Utilities;

    private string $name;
    private ?string $email = null;
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
     * @param string|null $email
     * @return Sender
     */
    public function setEmail(?string $email): Sender
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
        self::when($this->email, fn(string $email) => $sender->addChild('email', $email));
        self::when($this->phone, fn(Phone $phone) => $phone->encode($sender));
        self::when($this->documents, fn(Documents $value) => $value->encode($sender));
    }

    public function decode(SimpleXMLElement $root): Sender
    {
        $this->name = $root->name;
        $this->email = $root->email;
        $this->phone = self::when($root->phone, fn($phone) => (new Phone())->decode($phone));

        return $this;
    }
}