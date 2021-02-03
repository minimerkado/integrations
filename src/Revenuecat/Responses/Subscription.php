<?php


namespace Revenuecat\Responses;

use Illuminate\Support\Arr;

class Subscription
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

    /**
     * @return mixed|string
     */
    public function getBillingIssuesDetectedAt()
    {
        return $this->billing_issues_detected_at;
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
    public function getIsSandbox()
    {
        return $this->is_sandbox;
    }

    /**
     * @return mixed|string
     */
    public function getOriginalPurchaseDate()
    {
        return $this->original_purchase_date;
    }

    /**
     * @return mixed|string
     */
    public function getPeriodType()
    {
        return $this->period_type;
    }

    /**
     * @return mixed|string
     */
    public function getPurchaseDate()
    {
        return $this->purchase_date;
    }

    /**
     * @return mixed|string
     */
    public function getStore()
    {
        return $this->store;
    }

    /**
     * @return mixed|string
     */
    public function getUnsubscribeDetectedAt()
    {
        return $this->unsubscribe_detected_at;
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }
}