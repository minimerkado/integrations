<?php


namespace Revenuecat\Responses;


use Common\Response;

class Entitlement implements Response
{
    private string $expires_date;
    private string $product_identifier;
    private string $purchase_date;

    /**
     * Entitlement constructor.
     * @param string $expires_date
     * @param string $product_identifier
     * @param string $purchase_date
     */
    public function __construct(string $expires_date, string $product_identifier, string $purchase_date)
    {
        $this->expires_date = $expires_date;
        $this->product_identifier = $product_identifier;
        $this->purchase_date = $purchase_date;
    }


    public function build(){
        return [
            "pro_cat" => [
                "expires_date" => $this->expires_date,
                "product_identifier" => $this->product_identifier,
                "purchase_date" => $this->purchase_date,
            ]
        ];
    }

}