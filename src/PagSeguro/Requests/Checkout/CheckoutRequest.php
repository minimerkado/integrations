<?php


namespace PagSeguro\Requests\Checkout;


use PagSeguro\Requests\Checkout\Objects\Items;
use PagSeguro\Requests\Checkout\Objects\Receiver;
use PagSeguro\Requests\Checkout\Objects\Sender;
use PagSeguro\Requests\Checkout\Objects\Shipping;
use PagSeguro\Requests\Request;
use PagSeguro\Requests\XMLEncodable;
use PagSeguro\Utilities;
use SimpleXMLElement;

class CheckoutRequest implements Request, XMLEncodable
{
    use Utilities;

    private string $email;
    private string $token;
    private string $currency = 'BRL';
    private Items $items;
    private Receiver $receiver;
    private Shipping $shipping;
    private ?Sender $sender = null;
    private ?float $extraAmount = null;
    private ?string $reference = null;
    private ?string $redirectUrl = null;
    private ?bool $enableRecover = null;
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
        $this->email = $email;
        $this->token = $token;
        $this->receiver = new Receiver($email);
        $this->shipping = new Shipping();
    }

    /**
     * @param string $email
     * @return CheckoutRequest
     */
    public function setEmail(string $email): CheckoutRequest
    {
        $this->email = $email;
        return $this;
    }

    /**
     * @param string $token
     * @return CheckoutRequest
     */
    public function setToken(string $token): CheckoutRequest
    {
        $this->token = $token;
        return $this;
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
    public function setItems($items): CheckoutRequest
    {
        $this->items = $items;

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
     * @param Shipping $shipping
     * @return CheckoutRequest
     */
    public function setShipping(Shipping $shipping): CheckoutRequest
    {
        $this->shipping = $shipping;
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
     * @param bool|null $enableRecover
     * @return CheckoutRequest
     */
    public function setEnableRecover(?bool $enableRecover): CheckoutRequest
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

    public function getMethod()
    {
        return 'POST';
    }

    public function getPath()
    {
        return '/checkout';
    }

    public function build(): array
    {
        $root = new SimpleXMLElement('<checkout/>');
        $this->encode($root);

        return [
            'query' => [
                'email' => $this->email,
                'token' => $this->token,
            ],
            'body' => $root->asXML(),
        ];
    }

    public function encode(SimpleXMLElement $root)
    {
        $root->addChild('currency', $this->currency);
        $this->items->encode($root);
        $this->receiver->encode($root);
        $this->shipping->encode($root);

        self::when($this->sender, fn($value) => $value->encode($root));
        self::when($this->extraAmount, fn($value) => $root->addChild('extraAmount', $value));
        self::when($this->reference, fn($value) => $root->addChild('reference', $value));
        self::when($this->redirectUrl, fn($value) => $root->addChild('redirectUrl', $value));
        self::when($this->enableRecover, fn($value) => $root->addChild('enableRecover', $value));
        self::when($this->timeout, fn($value) => $root->addChild('timeout', $value));
        self::when($this->maxAge, fn($value) => $root->addChild('maxAge', $value));
        self::when($this->maxUses, fn($value) => $root->addChild('maxUses', $value));
    }
}