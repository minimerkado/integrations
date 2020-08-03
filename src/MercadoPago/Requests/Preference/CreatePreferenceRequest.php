<?php


namespace MercadoPago\Requests\Preference;


use Carbon\Carbon;
use Common\Utilities;
use MercadoPago\Requests\Preference\Objects\Item;
use MercadoPago\Requests\Preference\Objects\Payer;
use MercadoPago\Requests\Preference\Objects\PaymentMethods;
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
    private ?PaymentMethods $payment_methods = null;
    private ?string $auto_return = null;
    private ?Payer $payer = null;
    private ?string $pending_back_url = null;
    private ?string $success_back_url = null;
    private ?string $failure_back_url = null;
    private ?string $notification_url = null;
    private ?string $additional_info = null;
    private bool $expires = false;
    private ?Carbon $date_of_expiration = null;
    private ?Carbon $expiration_date_from = null;
    private ?Carbon $expiration_date_to = null;

    /**
     * Itens da preferência
     *
     * @param Item $item
     * @return CreatePreferenceRequest
     */
    public function addItem(Item $item): CreatePreferenceRequest
    {
        $this->items[] = $item;
        return $this;
    }

    /**
     * Informações de envio.
     *
     * @param Shipments $shipments
     * @return CreatePreferenceRequest
     */
    public function setShipments(Shipments $shipments): CreatePreferenceRequest
    {
        $this->shipments = $shipments;
        return $this;
    }

    /**
     * @param PaymentMethods|null $payment_methods
     * @return CreatePreferenceRequest
     */
    public function setPaymentMethods(?PaymentMethods $payment_methods): CreatePreferenceRequest
    {
        $this->payment_methods = $payment_methods;
        return $this;
    }

    /**
     * Referência que pode sincronizar com seu sistema de pagamentos.
     *
     * @param string $external_reference
     * @return CreatePreferenceRequest
     */
    public function setExternalReference(string $external_reference): CreatePreferenceRequest
    {
        $this->external_reference = $external_reference;
        return $this;
    }

    /**
     * No caso de estar especificado o comprador será redirecionado para o seu site imediatamente após a compra.
     *  - **approved**: The redirection takes place only for approved payments.
     *  - **all**: The redirection takes place only for approved payments, forward compatibility only
     *  if we change the default behavior
     * @param string|null $auto_return
     * @return CreatePreferenceRequest
     */
    public function setAutoReturn(?string $auto_return): CreatePreferenceRequest
    {
        $this->auto_return = $auto_return;
        return $this;
    }

    /**
     * Informações sobre o comprador.
     *
     * @param Payer|null $payer
     * @return CreatePreferenceRequest
     */
    public function setPayer(?Payer $payer): CreatePreferenceRequest
    {
        $this->payer = $payer;
        return $this;
    }

    /**
     * @param string|null $pending_back_url
     * @return CreatePreferenceRequest
     */
    public function setPendingBackUrl(?string $pending_back_url): CreatePreferenceRequest
    {
        $this->pending_back_url = $pending_back_url;
        return $this;
    }

    /**
     * @param string|null $success_back_url
     * @return CreatePreferenceRequest
     */
    public function setSuccessBackUrl(?string $success_back_url): CreatePreferenceRequest
    {
        $this->success_back_url = $success_back_url;
        return $this;
    }

    /**
     * @param string|null $failure_back_url
     * @return CreatePreferenceRequest
     */
    public function setFailureBackUrl(?string $failure_back_url): CreatePreferenceRequest
    {
        $this->failure_back_url = $failure_back_url;
        return $this;
    }

    /**
     * URL para a qual você gostaria de receber notificações de pagamentos.
     *
     * @param string|null $notification_url
     * @return CreatePreferenceRequest
     */
    public function setNotificationUrl(?string $notification_url): CreatePreferenceRequest
    {
        $this->notification_url = $notification_url;
        return $this;
    }

    /**
     * Informações adicionais.
     *
     * @param string|null $additional_info
     * @return CreatePreferenceRequest
     */
    public function setAdditionalInfo(?string $additional_info): CreatePreferenceRequest
    {
        $this->additional_info = $additional_info;
        return $this;
    }

    /**
     * Determina se uma preferência expira.
     *
     * @param bool $expires
     * @return CreatePreferenceRequest
     */
    public function setExpires(bool $expires): CreatePreferenceRequest
    {
        $this->expires = $expires;
        return $this;
    }

    /**
     * Data de expiração de meios de pagamento em dinheiro.
     *
     * @param Carbon|null $date_of_expiration
     * @return CreatePreferenceRequest
     */
    public function setDateOfExpiration(?Carbon $date_of_expiration): CreatePreferenceRequest
    {
        $this->date_of_expiration = $date_of_expiration;
        return $this;
    }

    /**
     * Data a partir da qual a preferência estará ativa.
     *
     * @param Carbon|null $expiration_date_from
     * @return CreatePreferenceRequest
     */
    public function setExpirationDateFrom(?Carbon $expiration_date_from): CreatePreferenceRequest
    {
        $this->expiration_date_from = $expiration_date_from;
        return $this;
    }

    /**
     * Data em que a preferência expira.
     *
     * @param Carbon|null $expiration_date_to
     * @return CreatePreferenceRequest
     */
    public function setExpirationDateTo(?Carbon $expiration_date_to): CreatePreferenceRequest
    {
        $this->expiration_date_to = $expiration_date_to;
        return $this;
    }

    public function toJson(): array
    {
        return self::not_null([
            'items' => array_map(fn($item) => $item->toJson(), $this->items),
            'shipments' => $this->shipments->toJson(),
            'external_reference' => $this->external_reference,
            'payer' => self::when($this->payer, fn($value) => $value->toJson()),
            'payment_methods' => self::when($this->payment_methods, fn($value) => $value->toJson()),
            'auto_return' => $this->auto_return,
            'back_urls' => [
                'success' => $this->success_back_url,
                'pending' => $this->pending_back_url,
                'failure' => $this->failure_back_url,
            ],
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