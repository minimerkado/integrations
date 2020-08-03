<?php


namespace MercadoPago\Requests\Preference\Objects;


use Common\JsonObject;

class Phone implements JsonObject
{
    private string $area_code;
    private string $number;

    /**
     * Phone constructor.
     * @param string $area_code
     * @param string $number
     */
    public function __construct(string $area_code, string $number)
    {
        $this->area_code = $area_code;
        $this->number = $number;
    }

    /**
     * @param string $area_code
     * @return Phone
     */
    public function setAreaCode(string $area_code): Phone
    {
        $this->area_code = $area_code;
        return $this;
    }

    /**
     * @param string $number
     * @return Phone
     */
    public function setNumber(string $number): Phone
    {
        $this->number = $number;
        return $this;
    }

    public function toJson(): array
    {
        return [
            'area_code' => $this->area_code,
            'number' => $this->number,
        ];
    }
}