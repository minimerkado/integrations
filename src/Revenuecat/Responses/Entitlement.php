<?php


namespace Revenuecat\Responses;


use Carbon\Carbon;
use Illuminate\Support\Arr;

class Entitlement
{
    private ?Carbon $expires_date;
    private string $product_identifier;
    private Carbon $purchase_date;
    private string $id;

    /**
     * Entitlement constructor.
     * @param string $id
     * @param array $arr
     */
    public function __construct(string $id, array $arr)
    {
        $expires_date = Arr::get($arr, "expires_date");
        $this->expires_date = $expires_date !== null
            ? Carbon::parse($expires_date)
            : null;
        $this->product_identifier = Arr::get($arr, "product_identifier");
        $this->purchase_date = Carbon::parse(Arr::get($arr, "purchase_date"));
        $this->id = $id;
    }

    /**
     * @return Carbon|null
     */
    public function getExpiresDate(): ?Carbon
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
     * @return Carbon
     */
    public function getPurchaseDate(): Carbon
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