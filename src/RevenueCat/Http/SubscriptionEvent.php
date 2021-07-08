<?php


namespace RevenueCat\Http;


use Illuminate\Http\Request;

class SubscriptionEvent
{
    private array $id;
    private string $type;
    private string $app_user_id;
    private string $original_app_user_id;
    private array $aliases = [];
    private int $event_timestamp_ms;
    private float $price;
    private ?string $currency = null;

    private string $product_id;
    private array $entitlement_ids = [];
    private string $period_type;
    private string $store;
    private string $environment;
    private bool $is_trial_conversion = false;
    private bool $is_family_share = false;

    private ?int $purchased_at_ms = null;
    private ?int $grace_period_expiration_at_ms = null;
    private ?int $expiration_at_ms = null;
    private ?int $auto_resume_at_ms = null;
    private ?string $cancel_reason;
    private ?string $new_product_id = null;
    private ?float $price_in_purchased_currency = null;
    private ?float $takehome_percentage = null;
    private ?string $transaction_id = null;
    private ?string $original_transaction_id = null;
    private ?string $transferred_from = null;
    private ?string $transferred_to = null;

    public function __construct(array $data)
    {
        $this->parse($data);
    }

    public function parse(array $data)
    {

    }

    /**
     * @return array
     */
    public function getId(): array
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @return string
     */
    public function getAppUserId(): string
    {
        return $this->app_user_id;
    }

    /**
     * @return string
     */
    public function getOriginalAppUserId(): string
    {
        return $this->original_app_user_id;
    }

    /**
     * @return array
     */
    public function getAliases(): array
    {
        return $this->aliases;
    }

    /**
     * @return int
     */
    public function getEventTimestampMs(): int
    {
        return $this->event_timestamp_ms;
    }

    /**
     * @return float
     */
    public function getPrice(): float
    {
        return $this->price;
    }

    /**
     * @return string|null
     */
    public function getCurrency(): ?string
    {
        return $this->currency;
    }

    /**
     * @return string
     */
    public function getProductId(): string
    {
        return $this->product_id;
    }

    /**
     * @return array
     */
    public function getEntitlementIds(): array
    {
        return $this->entitlement_ids;
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
    public function getStore(): string
    {
        return $this->store;
    }

    /**
     * @return string
     */
    public function getEnvironment(): string
    {
        return $this->environment;
    }

    /**
     * @return bool
     */
    public function isIsTrialConversion(): bool
    {
        return $this->is_trial_conversion;
    }

    /**
     * @return bool
     */
    public function isIsFamilyShare(): bool
    {
        return $this->is_family_share;
    }

    /**
     * @return int|null
     */
    public function getPurchasedAtMs(): ?int
    {
        return $this->purchased_at_ms;
    }

    /**
     * @return int|null
     */
    public function getGracePeriodExpirationAtMs(): ?int
    {
        return $this->grace_period_expiration_at_ms;
    }

    /**
     * @return int|null
     */
    public function getExpirationAtMs(): ?int
    {
        return $this->expiration_at_ms;
    }

    /**
     * @return int|null
     */
    public function getAutoResumeAtMs(): ?int
    {
        return $this->auto_resume_at_ms;
    }

    /**
     * @return string|null
     */
    public function getCancelReason(): ?string
    {
        return $this->cancel_reason;
    }

    /**
     * @return string|null
     */
    public function getNewProductId(): ?string
    {
        return $this->new_product_id;
    }

    /**
     * @return float|null
     */
    public function getPriceInPurchasedCurrency(): ?float
    {
        return $this->price_in_purchased_currency;
    }

    /**
     * @return float|null
     */
    public function getTakehomePercentage(): ?float
    {
        return $this->takehome_percentage;
    }

    /**
     * @return string|null
     */
    public function getTransactionId(): ?string
    {
        return $this->transaction_id;
    }

    /**
     * @return string|null
     */
    public function getOriginalTransactionId(): ?string
    {
        return $this->original_transaction_id;
    }

    /**
     * @return string|null
     */
    public function getTransferredFrom(): ?string
    {
        return $this->transferred_from;
    }

    /**
     * @return string|null
     */
    public function getTransferredTo(): ?string
    {
        return $this->transferred_to;
    }
}