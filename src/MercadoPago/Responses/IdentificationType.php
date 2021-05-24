<?php


namespace MercadoPago\Responses;


class IdentificationType
{
    private string $id;
    private string $name;
    private string $type;

    public function __construct(array $json)
    {
        $this->id = $json['id'];
        $this->name = $json['name'];
        $this->type = $json['type'];
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getType(): string
    {
        return $this->type;
    }
}