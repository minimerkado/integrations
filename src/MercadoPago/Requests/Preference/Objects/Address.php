<?php


namespace MercadoPago\Requests\Preference\Objects;


use Common\JsonEncodable;
use Common\Utilities;

class Address implements JsonEncodable
{
    use Utilities;

    private string $zip_code;
    private string $street_name;
    private string $street_number;
    private ?string $state_name = null;
    private ?string $city_name = null;
    private ?string $floor = null;
    private ?string $apartment = null;

    /**
     * @param string $zip_code
     * @return Address
     */
    public function setZipCode(string $zip_code): Address
    {
        $this->zip_code = $zip_code;
        return $this;
    }

    /**
     * @param string $street_name
     * @return Address
     */
    public function setStreetName(string $street_name): Address
    {
        $this->street_name = $street_name;
        return $this;
    }

    /**
     * @param string $street_number
     * @return Address
     */
    public function setStreetNumber(string $street_number): Address
    {
        $this->street_number = $street_number;
        return $this;
    }

    /**
     * @param string|null $state_name
     * @return Address
     */
    public function setStateName(?string $state_name): Address
    {
        $this->state_name = $state_name;
        return $this;
    }

    /**
     * @param string|null $city_name
     * @return Address
     */
    public function setCityName(?string $city_name): Address
    {
        $this->city_name = $city_name;
        return $this;
    }

    /**
     * @param string|null $floor
     * @return Address
     */
    public function setFloor(?string $floor): Address
    {
        $this->floor = $floor;
        return $this;
    }

    /**
     * @param string|null $apartment
     * @return Address
     */
    public function setApartment(?string $apartment): Address
    {
        $this->apartment = $apartment;
        return $this;
    }

    public function toJson(): array
    {
        return self::not_null([
            'zip_code' => $this->zip_code,
            'street_name' => $this->street_name,
            'street_number' => $this->street_number,
            'state_name' => $this->state_name,
            'city_name' => $this->city_name,
            'floor' => $this->floor,
            'apartment' => $this->apartment,
        ]);
    }
}