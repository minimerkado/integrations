<?php


namespace JivoChat\Http\Objects;


use Illuminate\Support\Arr;

class Visitor
{
    private ?string $name;
    private ?string $email;
    private ?string $phone;
    private string $number;
    private string $description;
    private int $chats_count;

    public function __construct(array $json)
    {
        $this->name = Arr::get($json, 'name');
        $this->email = Arr::get($json, 'email');
        $this->phone = Arr::get($json, 'phone');
        $this->number = Arr::get($json, 'number', '0');
        $this->description = Arr::get($json, 'description', '');
        $this->chats_count = Arr::get($json, 'chats_count', 0);
    }

    /**
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @return string|null
     */
    public function getEmail(): ?string
    {
        return $this->email;
    }

    /**
     * @return string|null
     */
    public function getPhone(): ?string
    {
        return $this->phone;
    }

    /**
     * @return string
     */
    public function getNumber(): string
    {
        return $this->number;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @return int
     */
    public function getChatsCount(): int
    {
        return $this->chats_count;
    }
}