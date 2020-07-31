<?php


namespace PagSeguro\Requests\Checkout\Objects;


use Common\Utilities;
use PagSeguro\Requests\XMLEncodable;
use SimpleXMLElement;

class Address implements XMLEncodable
{
    use Utilities;

    private ?string $street = null;
    private ?string $number = null;
    private ?string $complement = null;
    private ?string $district = null;
    private ?string $city = null;
    private ?string $state = null;
    private ?string $country = null;
    private ?string $postalCode = null;

    /**
     * @param string|null $street
     * @return Address
     */
    public function setStreet(?string $street): Address
    {
        $this->street = $street;
        return $this;
    }

    /**
     * @param string|null $number
     * @return Address
     */
    public function setNumber(?string $number): Address
    {
        $this->number = $number;
        return $this;
    }

    /**
     * @param string|null $complement
     * @return Address
     */
    public function setComplement(?string $complement): Address
    {
        $this->complement = $complement;
        return $this;
    }

    /**
     * @param string|null $district
     * @return Address
     */
    public function setDistrict(?string $district): Address
    {
        $this->district = $district;
        return $this;
    }

    /**
     * @param string|null $city
     * @return Address
     */
    public function setCity(?string $city): Address
    {
        $this->city = $city;
        return $this;
    }

    /**
     * @param string|null $state
     * @return Address
     */
    public function setState(?string $state): Address
    {
        $this->state = $state;
        return $this;
    }

    /**
     * @param string|null $country
     * @return Address
     */
    public function setCountry(?string $country): Address
    {
        $this->country = $country;
        return $this;
    }

    /**
     * @param string|null $postalCode
     * @return Address
     */
    public function setPostalCode(?string $postalCode): Address
    {
        $this->postalCode = $postalCode;
        return $this;
    }

    public function encode(SimpleXMLElement $root)
    {
        $address = $root->addChild('address');
        self::when($this->street, fn($value) => $address->addChild('street', $value));
        self::when($this->number, fn($value) => $address->addChild('number', $value));
        self::when($this->district, fn($value) => $address->addChild('district', $value));
        self::when($this->complement, fn($value) => $address->addChild('complement', $value));
        self::when($this->city, fn($value) => $address->addChild('city', $value));
        self::when($this->state, fn($value) => $address->addChild('state', $value));
        self::when($this->country, fn($value) => $address->addChild('country', $value));
        self::when($this->postalCode, fn($value) => $address->addChild('postalCode', $value));
    }
}