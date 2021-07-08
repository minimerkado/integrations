<?php


namespace RevenueCat\Http;


use Carbon\Carbon;
use Illuminate\Support\Arr;
use Money\Currency;
use Money\Money;

class SubscriptionEvent
{
    private array $id;
    private string $type;
    private string $app_user_id;
    private string $original_app_user_id;
    private array $aliases = [];
    private int $event_timestamp_ms;
    private float $price;
    private string $currency;
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
    private ?string $cancel_reason = null;
    private ?string $new_product_id = null;
    private ?float $price_in_purchased_currency = null;
    private ?float $takehome_percentage = null;
    private ?string $transaction_id = null;
    private ?string $original_transaction_id = null;
    private ?string $transferred_from = null;
    private ?string $transferred_to = null;

    public function __construct(array $data)
    {
        $this->parse(Arr::get($data, 'event'));
    }

    private function parse(array $data)
    {
        $this->id = $data['id'];
        $this->type = $data['type'];
        $this->app_user_id = $data['app_user_id'];
        $this->original_app_user_id = $data['original_app_user_id'];
        $this->aliases = $data['aliases'] ?? [];
        $this->event_timestamp_ms = $data['event_timestamp_ms'];
        $this->price = $data['price'];
        $this->currency = $data['currency'] ?? 'BRL';
        $this->product_id = $data['product_id'];
        $this->entitlement_ids = $data['entitlement_ids'] ?? [];
        $this->period_type = $data['period_type'];
        $this->store = $data['store'];
        $this->environment = $data['environment'];
        $this->is_trial_conversion = Arr::get($data, '$is_trial_conversion', false);
        $this->is_family_share = Arr::get($data, 'is_family_share', false);
        $this->purchased_at_ms = Arr::get($data, 'purchased_at_ms');
        $this->grace_period_expiration_at_ms = Arr::get($data, 'grace_period_expiration_at_ms');
        $this->expiration_at_ms = Arr::get($data, 'expiration_at_ms');
        $this->auto_resume_at_ms = Arr::get($data, 'auto_resume_at_ms');
        $this->cancel_reason = Arr::get($data, 'cancel_reason');
        $this->new_product_id = Arr::get($data, 'new_product_id');
        $this->price_in_purchased_currency = Arr::get($data, 'price_in_purchased_currency');
        $this->takehome_percentage = Arr::get($data, 'takehome_percentage');
        $this->transaction_id = Arr::get($data, 'transaction_id');
        $this->original_transaction_id = Arr::get($data, 'original_transaction_id');
        $this->transferred_from = Arr::get($data, 'transferred_from');
        $this->transferred_to = Arr::get($data, 'transferred_to');
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
     * @return Carbon
     */
    public function getEventTimestamp(): Carbon
    {
        return Carbon::createFromTimestamp($this->event_timestamp_ms);
    }

    /**
     * @return float
     */
    public function getPrice(): Money
    {
        $price = (int) $this->price * 100;
        return new Money($price, new Currency($this->currency));
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
     * @return Carbon|null
     */
    public function getPurchasedAt(): ?Carbon
    {
        if ($time = $this->purchased_at_ms)
            return Carbon::createFromTimestamp($time);

        return null;
    }

    /**
     * @return Carbon|null
     */
    public function getGracePeriodExpirationAtMs(): ?Carbon
    {
        if ($time = $this->grace_period_expiration_at_ms)
            return Carbon::createFromTimestamp($time);

        return null;
    }

    /**
     * @return Carbon|null
     */
    public function getExpirationAtMs(): ?Carbon
    {
        if ($time = $this->expiration_at_ms)
            return Carbon::createFromTimestamp($time);

        return null;
    }

    /**
     * @return Carbon|null
     */
    public function getAutoResumeAtMs(): ?Carbon
    {
        if ($time = $this->auto_resume_at_ms)
            return Carbon::createFromTimestamp($time);

        return null;
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