<?php


namespace PagSeguro\Http\Checkout;

use PagSeguro\Http\Objects\Items;
use PagSeguro\Http\Objects\Receiver;
use PagSeguro\Http\Objects\Sender;
use PagSeguro\Http\Objects\Shipping;
use PagSeguro\Http\PostRequest;
use Common\Utilities;
use SimpleXMLElement;

class CheckoutRequest extends PostRequest
{
    use Utilities;

    private string $currency = 'BRL';
    private Items $items;
    private Receiver $receiver;
    private Shipping $shipping;
    private ?Sender $sender = null;
    private ?float $extraAmount = null;
    private ?string $reference = null;
    private ?string $redirectUrl = null;
    private ?string $notificationUrl = null;
    private bool $enableRecover = false;
    private ?int $timeout = null;
    private ?int $maxAge = null;
    private ?int $maxUses = null;

    /**
     * CheckoutRequest constructor.
     * @param string $email
     * @param string $token
     */
    public function __construct(string $email, string $token)
    {
        parent::__construct($email, $token);
        $this->receiver = new Receiver($email);
        $this->shipping = new Shipping();
    }

    /**
     * @param string $currency
     * @return CheckoutRequest
     */
    public function setCurrency(string $currency): CheckoutRequest
    {
        $this->currency = $currency;
        return $this;
    }

    /**
     * @param Items $items
     * @return CheckoutRequest
     */
    public function setItems(Items $items): CheckoutRequest
    {
        $this->items = $items;
        return $this;
    }

    /**
     * @param Receiver $receiver
     * @return CheckoutRequest
     */
    public function setReceiver(Receiver $receiver): CheckoutRequest
    {
        $this->receiver = $receiver;
        return $this;
    }

    /**
     * @param Shipping $shipping
     * @return CheckoutRequest
     */
    public function setShipping(Shipping $shipping): CheckoutRequest
    {
        $this->shipping = $shipping;
        return $this;
    }

    /**
     * @param Sender|null $sender
     * @return CheckoutRequest
     */
    public function setSender(?Sender $sender): CheckoutRequest
    {
        $this->sender = $sender;
        return $this;
    }

    /**
     * @param float|null $extraAmount
     * @return CheckoutRequest
     */
    public function setExtraAmount(?float $extraAmount): CheckoutRequest
    {
        $this->extraAmount = $extraAmount;
        return $this;
    }

    /**
     * @param string|null $reference
     * @return CheckoutRequest
     */
    public function setReference(?string $reference): CheckoutRequest
    {
        $this->reference = $reference;
        return $this;
    }

    /**
     * @param string|null $redirectUrl
     * @return CheckoutRequest
     */
    public function setRedirectUrl(?string $redirectUrl): CheckoutRequest
    {
        $this->redirectUrl = $redirectUrl;
        return $this;
    }

    /**
     * @param string|null $notificationUrl
     * @return CheckoutRequest
     */
    public function setNotificationUrl(?string $notificationUrl): CheckoutRequest
    {
        $this->notificationUrl = $notificationUrl;
        return $this;
    }

    /**
     * @param bool $enableRecover
     * @return CheckoutRequest
     */
    public function setEnableRecover(bool $enableRecover): CheckoutRequest
    {
        $this->enableRecover = $enableRecover;
        return $this;
    }

    /**
     * @param int|null $timeout
     * @return CheckoutRequest
     */
    public function setTimeout(?int $timeout): CheckoutRequest
    {
        $this->timeout = $timeout;
        return $this;
    }

    /**
     * @param int|null $maxAge
     * @return CheckoutRequest
     */
    public function setMaxAge(?int $maxAge): CheckoutRequest
    {
        $this->maxAge = $maxAge;
        return $this;
    }

    /**
     * @param int|null $maxUses
     * @return CheckoutRequest
     */
    public function setMaxUses(?int $maxUses): CheckoutRequest
    {
        $this->maxUses = $maxUses;
        return $this;
    }

    public function getPath()
    {
        return '/v2/checkout';
    }
    public function getRootElement(): SimpleXMLElement
    {
        return new SimpleXMLElement('<checkout/>');
    }

    public function encode(SimpleXMLElement $root)
    {
        $root->addChild('currency', $this->currency);
        $root->addChild('enableRecover', $this->enableRecover ? 'true' : 'false');
        $this->items->encode($root);
        $this->receiver->encode($root);
        $this->shipping->encode($root);

        self::when($this->sender, fn($value) => $value->encode($root));
        self::when($this->extraAmount, fn($value) => $root->addChild('extraAmount', $value));
        self::when($this->reference, fn($value) => $root->addChild('reference', $value));
        self::when($this->redirectUrl, fn($value) => $root->addChild('redirectURL', $value));
        self::when($this->notificationUrl, fn($value) => $root->addChild('notificationURL', $value));
        self::when($this->timeout, fn($value) => $root->addChild('timeout', $value));
        self::when($this->maxAge, fn($value) => $root->addChild('maxAge', $value));
        self::when($this->maxUses, fn($value) => $root->addChild('maxUses', $value));
    }
}