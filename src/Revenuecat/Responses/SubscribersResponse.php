<?php


namespace Revenuecat\Responses;


use Common\Response;

class SubscribersResponse implements Response
{
    private Entitlement $entitlements;
    private Subscriptions $subscriptions;

    public function __construct(string $body)
    {
        $this->parse($body);
    }

    private string $billing_issues_detected_at;
    private string $expires_date;
    private string $is_sandbox;
    private string $original_purchase_date;
    private string $period_type;
    private string $purchase_date;
    private string $store;
    private string $unsubscribe_detected_at;

    public function parse(string $body)
    {
        $json = json_decode($body);
        $entitlement = $json->subscriber->entitlements->pro_cat;
        $subscription = $json->subscriptions->annual->pro_cat;

        $this->entitlements = (new Entitlement(
            $entitlement->expires_date,
            $entitlement->product_identifier,
            $entitlement->purchase_date
        ))->build();

        $this->subscriptions = (new Subscriptions(
            $subscription->billing_issues_detected_at,
            $subscription->expires_date,
            $subscription->is_sandbox,
            $subscription->original_purchase_date,
            $subscription->period_type,
            $subscription->purchase_date,
            $subscription->store,
            $subscription->unsubscribe_detected_at
        ))->build();
    }

    /**
     * @return Entitlement
     */
    public function getEntitlements(): Entitlement
    {
        return $this->entitlements;
    }

    /**
     * @return Subscriptions
     */
    public function getSubscriptions(): Subscriptions
    {
        return $this->subscriptions;
    }

    /**
     * @return string
     */
    public function getBillingIssuesDetectedAt(): string
    {
        return $this->billing_issues_detected_at;
    }

    /**
     * @return string
     */
    public function getExpiresDate(): string
    {
        return $this->expires_date;
    }

    /**
     * @return string
     */
    public function getIsSandbox(): string
    {
        return $this->is_sandbox;
    }

    /**
     * @return string
     */
    public function getOriginalPurchaseDate(): string
    {
        return $this->original_purchase_date;
    }

    /**
     * @return string
     */
    public function getPeriodType(): string
    {
        return $this->period_type;
    }

    /**
     * @return string
     */
    public function getPurchaseDate(): string
    {
        return $this->purchase_date;
    }

    /**
     * @return string
     */
    public function getStore(): string
    {
        return $this->store;
    }

    /**
     * @return string
     */
    public function getUnsubscribeDetectedAt(): string
    {
        return $this->unsubscribe_detected_at;
    }
}