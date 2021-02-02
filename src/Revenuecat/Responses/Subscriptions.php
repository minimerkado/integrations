<?php


namespace Revenuecat\Responses;


use Common\Response;
use Illuminate\Support\Arr;

class Subscriptions implements Response
{
    private string $billing_issues_detected_at;
    private string $expires_date;
    private string $is_sandbox;
    private string $original_purchase_date;
    private string $period_type;
    private string $purchase_date;
    private string $store;
    private string $unsubscribe_detected_at;
    private string $id;

    /**
     * Subscriptions constructor.
     * @param string $id
     * @param array $arr
     */
    public function __construct(string $id, array $arr)
    {
        $this->id = $id;
        $this->billing_issues_detected_at = Arr::get($arr, "billing_issues_detected_at");
        $this->expires_date = Arr::get($arr, "expires_date");
        $this->is_sandbox = Arr::get($arr, "is_sandbox");
        $this->original_purchase_date = Arr::get($arr, "original_purchase_date");
        $this->period_type = Arr::get($arr, "period_type");
        $this->purchase_date = Arr::get($arr, "purchase_date");
        $this->store = Arr::get($arr, "store");
        $this->unsubscribe_detected_at = Arr::get($arr, "unsubscribe_detected_at");
    }

}