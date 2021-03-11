<?php


namespace JivoChat\Http\Objects;


use Illuminate\Support\Arr;

class Agent
{
    private int $id;
    private string $name;
    private string $email;
    private ?string $prone;

    public function __construct(array $json)
    {
        $this->id = $json['id'];
        $this->name = $json['name'];
        $this->email = $json['email'];
        $this->prone = Arr::get($json, 'phone');
    }

    /**
     * @return int|mixed
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return mixed|string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return mixed|string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @return array|\ArrayAccess|mixed|string|null
     */
    public function getProne()
    {
        return $this->prone;
    }
}