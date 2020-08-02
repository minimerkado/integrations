<?php


namespace MercadoPago\Requests\Preference\Objects;


use Common\JsonObject;

class Identification implements JsonObject
{
    private string $type;
    private string $number;

    /**
     * @param string $type
     * @return Identification
     */
    public function setType(string $type): Identification
    {
        $this->type = $type;
        return $this;
    }

    /**
     * @param string $number
     * @return Identification
     */
    public function setNumber(string $number): Identification
    {
        $this->number = $number;
        return $this;
    }

    public function toJson(): array
    {
        return [
            'type' => $this->type,
            'number' => $this->number,
        ];
    }
}