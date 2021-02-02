<?php

namespace PicPay\Requests\Checkout\Objects;

use Common\JsonEncodable;

class Buyer implements JsonEncodable
{
    private string $firstName;
    private string $lastName;
    private string $document;
    private string $email;
    private string $phone;

    /**
     * @param string $firstName
     * @return Buyer
     */
    public function setFirstName(string $firstName): Buyer
    {
        $this->firstName = $firstName;
        return $this;
    }

    /**
     * @param string $lastName
     * @return Buyer
     */
    public function setLastName(string $lastName): Buyer
    {
        $this->lastName = $lastName;
        return $this;
    }

    /**
     * @param string $document
     * @return Buyer
     */
    public function setDocument(string $document): Buyer
    {
        $this->document = $document;
        return $this;
    }

    /**
     * @param string $email
     * @return Buyer
     */
    public function setEmail(string $email): Buyer
    {
        $this->email = $email;
        return $this;
    }

    /**
     * @param string $phone
     * @return Buyer
     */
    public function setPhone(string $phone): Buyer
    {
        $this->phone = $phone;
        return $this;
    }

    public function toJson(): array
    {
        return [
            "firstName" => $this->firstName,
            "lastName" => $this->lastName,
            "document" => $this->document,
            "email" => $this->email,
            "phone" => $this->phone,
        ];
    }
}