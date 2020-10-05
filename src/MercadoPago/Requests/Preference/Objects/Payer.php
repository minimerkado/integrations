<?php


namespace MercadoPago\Requests\Preference\Objects;


use Common\JsonEncodable;
use Common\Utilities;

class Payer implements JsonEncodable
{
    use Utilities;

    private string $name;
    private ?string $surname = null;
    private ?string $email = null;
    private ?Phone $phone = null;
    private ?Address $address = null;
    private ?Identification $identification = null;

    /**
     * @param string $name
     * @return Payer
     */
    public function setName(string $name): Payer
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @param string $surname
     * @return Payer
     */
    public function setSurname(string $surname): Payer
    {
        $this->surname = $surname;
        return $this;
    }

    /**
     * @param string|null $email
     * @return Payer
     */
    public function setEmail(?string $email): Payer
    {
        $this->email = $email;
        return $this;
    }

    /**
     * @param Phone|null $phone
     * @return Payer
     */
    public function setPhone(?Phone $phone): Payer
    {
        $this->phone = $phone;
        return $this;
    }

    /**
     * @param Address|null $address
     * @return Payer
     */
    public function setAddress(?Address $address): Payer
    {
        $this->address = $address;
        return $this;
    }

    /**
     * @param Identification|null $identification
     * @return Payer
     */
    public function setIdentification(?Identification $identification): Payer
    {
        $this->identification = $identification;
        return $this;
    }

    public function toJson(): array
    {
        return self::not_null([
            'name' => $this->name,
            'surname' => $this->surname,
            'email' => $this->email,
            'phone' => self::when($this->phone, fn($value) => $value->toJson()),
            'identification' => self::when($this->identification, fn($value) => $value->toJson()),
            'address' => self::when($this->address, fn($value) => $value->toJson()),
        ]);
    }
}