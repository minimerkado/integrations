<?php

namespace PicPay\Requests\Checkout;

use PicPay\Requests\Checkout\Objects\Buyer;
use PicPay\Requests\Request;

class CheckoutRequest implements Request
{
    private string $token;
    private string $referenceId;
    private string $callbackUrl;
    private ?string $returnUrl = null;
    private float $value = 0.0;
    private ?string $expiresAt = null;
    private Buyer $buyer;

    public function __construct(string $token)
    {
        $this->token = $token;
    }

    /**
     * @param string $referenceId
     * @return CheckoutRequest
     */
    public function setReferenceId(string $referenceId): CheckoutRequest
    {
        $this->referenceId = $referenceId;
        return $this;
    }

    /**
     * @param string $callbackUrl
     * @return CheckoutRequest
     */
    public function setCallbackUrl(string $callbackUrl): CheckoutRequest
    {
        $this->callbackUrl = $callbackUrl;
        return $this;
    }

    /**
     * @param string|null $returnUrl
     * @return CheckoutRequest
     */
    public function setReturnUrl(?string $returnUrl): CheckoutRequest
    {
        $this->returnUrl = $returnUrl;
        return $this;
    }

    /**
     * @param float $value
     * @return CheckoutRequest
     */
    public function setValue(float $value): CheckoutRequest
    {
        $this->value = $value;
        return $this;
    }

    /**
     * @param string|null $expiresAt
     * @return CheckoutRequest
     */
    public function setExpiresAt(?string $expiresAt): CheckoutRequest
    {
        $this->expiresAt = $expiresAt;
        return $this;
    }

    /**
     * @param Buyer $buyer
     * @return CheckoutRequest
     */
    public function setBuyer(Buyer $buyer): CheckoutRequest
    {
        $this->buyer = $buyer;
        return $this;
    }

    public function getMethod()
    {
        return 'POST';
    }

    public function getPath()
    {
        return '/payments';
    }

    public function build(): array
    {
        return [
            'headers' => [
                'x-picpay-token' => $this->token,
            ],
            'json' => [
                "referenceId" => $this->referenceId,
                "callbackUrl" => $this->callbackUrl,
                "returnUrl" => $this->returnUrl,
                "value" => $this->value,
                "expiresAt" => $this->expiresAt,
                "buyer" => $this->buyer->build(),
            ],
        ];
    }
}