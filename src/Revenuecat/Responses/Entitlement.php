<?php


namespace Revenuecat\Responses;


use Common\Response;
use Illuminate\Support\Arr;

class Entitlement implements Response
{
    private string $expires_date;
    private string $product_identifier;
    private string $purchase_date;
    private string $id;

    /**
     * Entitlement constructor.
     * @param string $id
     * @param array $arr
     */
    public function __construct(string $id, array $arr)
    {
        $this->expires_date = Arr::get($arr, "expires_date");
        $this->product_identifier = Arr::get($arr, "product_identifier");
        $this->purchase_date = Arr::get($arr, "purchase_date");
        $this->id = $id;
    }

    /**
     * @return mixed|string
     */
    public function getExpiresDate()
    {
        return $this->expires_date;
    }

    /**
     * @return mixed|string
     */
    public function getProductIdentifier()
    {
        return $this->product_identifier;
    }

    /**
     * @return mixed|string
     */
    public function getPurchaseDate()
    {
        return $this->purchase_date;
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }
}