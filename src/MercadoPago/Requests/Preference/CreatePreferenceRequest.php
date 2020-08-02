<?php


namespace MercadoPago\Requests\Preference;


use Carbon\Carbon;
use Common\Utilities;
use MercadoPago\Requests\Preference\Objects\BackUrls;
use MercadoPago\Requests\Preference\Objects\Item;
use MercadoPago\Requests\Preference\Objects\Payer;
use MercadoPago\Requests\Preference\Objects\Shipments;
use MercadoPago\Requests\Request;

class CreatePreferenceRequest extends Request
{
    use Utilities;

    const AUTO_RETURN_ALL = 'all';
    const AUTO_RETURN_APPROVED = 'approved';

    /** @var Item[] */
    private array $items = [];
    private Shipments $shipments;
    private string $external_reference;
    private ?string $auto_return;
    private ?Payer $payer = null;
    private ?BackUrls $back_urls = null;
    private ?string $notification_url = null;
    private ?string $additional_info = null;
    private bool $expires = false;
    private ?Carbon $date_of_expiration = null;
    private ?Carbon $expiration_date_from = null;
    private ?Carbon $expiration_date_to = null;

    /**
     * @param Item[] $items
     * @return CreatePreferenceRequest
     */
    public function setItems(array $items): CreatePreferenceRequest
    {
        $this->items = $items;
        return $this;
    }

    /**
     * @param Shipments $shipments
     * @return CreatePreferenceRequest
     */
    public function setShipments(Shipments $shipments): CreatePreferenceRequest
    {
        $this->shipments = $shipments;
        return $this;
    }

    /**
     * @param string $external_reference
     * @return CreatePreferenceRequest
     */
    public function setExternalReference(string $external_reference): CreatePreferenceRequest
    {
        $this->external_reference = $external_reference;
        return $this;
    }

    /**
     * @param string|null $auto_return
     * @return CreatePreferenceRequest
     */
    public function setAutoReturn(?string $auto_return): CreatePreferenceRequest
    {
        $this->auto_return = $auto_return;
        return $this;
    }

    /**
     * @param Payer|null $payer
     * @return CreatePreferenceRequest
     */
    public function setPayer(?Payer $payer): CreatePreferenceRequest
    {
        $this->payer = $payer;
        return $this;
    }

    /**
     * @param BackUrls|null $back_urls
     * @return CreatePreferenceRequest
     */
    public function setBackUrls(?BackUrls $back_urls): CreatePreferenceRequest
    {
        $this->back_urls = $back_urls;
        return $this;
    }

    /**
     * @param string|null $notification_url
     * @return CreatePreferenceRequest
     */
    public function setNotificationUrl(?string $notification_url): CreatePreferenceRequest
    {
        $this->notification_url = $notification_url;
        return $this;
    }

    /**
     * @param string|null $additional_info
     * @return CreatePreferenceRequest
     */
    public function setAdditionalInfo(?string $additional_info): CreatePreferenceRequest
    {
        $this->additional_info = $additional_info;
        return $this;
    }

    /**
     * @param bool $expires
     * @return CreatePreferenceRequest
     */
    public function setExpires(bool $expires): CreatePreferenceRequest
    {
        $this->expires = $expires;
        return $this;
    }

    /**
     * @param Carbon|null $date_of_expiration
     * @return CreatePreferenceRequest
     */
    public function setDateOfExpiration(?Carbon $date_of_expiration): CreatePreferenceRequest
    {
        $this->date_of_expiration = $date_of_expiration;
        return $this;
    }

    /**
     * @param Carbon|null $expiration_date_from
     * @return CreatePreferenceRequest
     */
    public function setExpirationDateFrom(?Carbon $expiration_date_from): CreatePreferenceRequest
    {
        $this->expiration_date_from = $expiration_date_from;
        return $this;
    }

    /**
     * @param Carbon|null $expiration_date_to
     * @return CreatePreferenceRequest
     */
    public function setExpirationDateTo(?Carbon $expiration_date_to): CreatePreferenceRequest
    {
        $this->expiration_date_to = $expiration_date_to;
        return $this;
    }

    public function toJson()
    {
        return self::not_null([
            'items' => array_map(fn($item) => $item->toJson(), $this->items),
            'shipments' => $this->shipments->toJson(),
            'external_reference' => $this->external_reference,
            'auto_return' => $this->auto_return,
            'payer' => self::when($this->payer, fn($value) => $value->toJson()),
            'back_urls' => self::when($this->back_urls, fn($value) => $value->toJson()),
            'notification_url' => $this->notification_url,
            'additional_info' => $this->additional_info,
            'expires' => $this->expires,
            'date_of_expiration' => self::when($this->date_of_expiration, fn(Carbon $value) => $value->toIso8601String()),
            'expiration_date_from' => self::when($this->expiration_date_from, fn(Carbon $value) => $value->toIso8601String()),
            'expiration_date_to' => self::when($this->expiration_date_to, fn(Carbon $value) => $value->toIso8601String()),
        ]);
    }

    public function getMethod()
    {
        return 'POST';
    }

    public function getPath()
    {
        return '/checkout/preferences';
    }
}