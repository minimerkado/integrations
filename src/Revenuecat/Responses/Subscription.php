<?php


namespace Revenuecat\Responses;

use Carbon\Carbon;
use Illuminate\Support\Arr;

class Subscription
{
    const PERIOD_TRIAL = 'trial';
    const PERIOD_NORMAL = 'normal';
    const PERIOD_INTRO = 'intro';

    const APP_STORE = 'app_store';
    const MAC_APP_STORE = 'mac_app_store';
    const PLAY_STORE = 'play_store';
    const STRIPE = 'stripe';

    private ?Carbon $billing_issues_detected_at;
    private Carbon $expires_date;
    private bool $is_sandbox;
    private Carbon $original_purchase_date;
    private string $period_type;
    private Carbon $purchase_date;
    private string $store;
    private ?Carbon $unsubscribe_detected_at;
    private string $id;

    /**
     * Subscriptions constructor.
     * @param string $id
     * @param array $arr
     */
    public function __construct(string $id, array $arr)
    {
        $this->id = $id;
        $billing_issues_detected_at = Arr::get($arr, "billing_issues_detected_at");

        $this->billing_issues_detected_at = $billing_issues_detected_at !== null
            ? Carbon::parse($billing_issues_detected_at)
            : null;

        $this->expires_date = Carbon::parse(Arr::get($arr, "expires_date"));
        $this->is_sandbox = Arr::get($arr, "is_sandbox");
        $this->original_purchase_date = Carbon::parse(Arr::get($arr, "original_purchase_date"));
        $this->period_type = Arr::get($arr, "period_type");
        $this->purchase_date =Carbon::parse(Arr::get($arr, "purchase_date"));
        $this->store = Arr::get($arr, "store");

        $unsubscribe_detected_at = Arr::get($arr, "unsubscribe_detected_at");
        $this->unsubscribe_detected_at = $unsubscribe_detected_at !== null
            ? Carbon::parse($unsubscribe_detected_at)
            : null;
    }

    public function isExpired(): bool
    {
        return $this->expires_date->isBefore(now());
    }

    public function isCanceled(): bool
    {
        return $this->unsubscribe_detected_at != null;
    }

    public function isTrial(): bool
    {
        return $this->period_type == self::PERIOD_TRIAL;
    }

    public function isBillingFailed(): bool
    {
        return $this->billing_issues_detected_at != null;
    }

    /**
     * @return Carbon|null
     */
    public function getBillingIssuesDetectedAt(): ?Carbon
    {
        return $this->billing_issues_detected_at;
    }

    /**
     * @return Carbon
     */
    public function getExpiresDate(): Carbon
    {
        return $this->expires_date;
    }

    /**
     * @return bool|mixed
     */
    public function getIsSandbox()
    {
        return $this->is_sandbox;
    }

    /**
     * @return Carbon|null
     */
    public function getOriginalPurchaseDate(): ?Carbon
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
     * @return Carbon
     */
    public function getPurchaseDate(): Carbon
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
     * @return Carbon|null
     */
    public function getUnsubscribeDetectedAt(): ?Carbon
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