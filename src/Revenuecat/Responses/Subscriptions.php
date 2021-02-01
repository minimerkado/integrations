<?php


namespace Revenuecat\Responses;


use Common\Response;

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

    /**
     * Subscriptions constructor.
     * @param string $billing_issues_detected_at
     * @param string $expires_date
     * @param string $is_sandbox
     * @param string $original_purchase_date
     * @param string $period_type
     * @param string $purchase_date
     * @param string $store
     * @param string $unsubscribe_detected_at
     */
    public function __construct(string $billing_issues_detected_at, string $expires_date, string $is_sandbox, string $original_purchase_date, string $period_type, string $purchase_date, string $store, string $unsubscribe_detected_at)
    {
        $this->billing_issues_detected_at = $billing_issues_detected_at;
        $this->expires_date = $expires_date;
        $this->is_sandbox = $is_sandbox;
        $this->original_purchase_date = $original_purchase_date;
        $this->period_type = $period_type;
        $this->purchase_date = $purchase_date;
        $this->store = $store;
        $this->unsubscribe_detected_at = $unsubscribe_detected_at;
    }

    public function build(){
        return [
            "annual" => [
                "billing_issues_detected_at" => $this->billing_issues_detected_at,
                "expires_date" => $this->expires_date,
                "is_sandbox" => $this->is_sandbox,
                "original_purchase_date" => $this->original_purchase_date,
                "period_type" => $this->period_type,
                "purchase_date" => $this->purchase_date,
                "store" => $this->store,
                "unsubscribe_detected_at" => $this->unsubscribe_detected_at,
            ]
        ];
    }

}