<?php


namespace MercadoPago\Requests\Preference\Objects;


use Common\JsonObject;
use Common\Utilities;

class Item implements JsonObject
{
    use Utilities;

    private string $title;
    private int $quantity = 1;
    private string $currency = 'BRL';
    private float $unit_price = 0.0;
    private ?string $id = null;
    private ?string $description = null;
    private ?string $picture_url = null;
    private ?string $category_id = null;

    /**
     * @param string $title
     * @return Item
     */
    public function setTitle(string $title): Item
    {
        $this->title = $title;
        return $this;
    }

    /**
     * @param string|null $description
     * @return Item
     */
    public function setDescription(?string $description): Item
    {
        $this->description = $description;
        return $this;
    }

    /**
     * @param int $quantity
     * @return Item
     */
    public function setQuantity(int $quantity): Item
    {
        $this->quantity = $quantity;
        return $this;
    }

    /**
     * @param string $currency
     * @return Item
     */
    public function setCurrency(string $currency): Item
    {
        $this->currency = $currency;
        return $this;
    }

    /**
     * @param float $unit_price
     * @return Item
     */
    public function setUnitPrice(float $unit_price): Item
    {
        $this->unit_price = $unit_price;
        return $this;
    }

    public function toJson(): array
    {
        return self::not_null([
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'quantity' => $this->quantity,
            'currency' => $this->currency,
            'unit_price' => $this->unit_price,
            'picture_url' => $this->picture_url,
            'category_id' => $this->category_id,
        ]);
    }
}