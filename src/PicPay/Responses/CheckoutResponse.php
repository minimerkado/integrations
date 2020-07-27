<?php


namespace PicPay\Responses;

use Carbon\Carbon;

class CheckoutResponse implements Response
{
    private string $referenceId;
    private string $paymentUrl;
    private Carbon $expiresAt;
    private string $qrcode;

    public function __construct(string $body)
    {
        $this->parse($body);
    }

    public function parse(string $body)
    {
        $json = json_decode($body);
        $this->referenceId = $json->referenceId;
        $this->paymentUrl = $json->paymentUrl;
        $this->expiresAt = $json->expiresAt;
        $this->qrcode = $json->qrcode;
    }

    /**
     * @return string
     */
    public function getReferenceId(): string
    {
        return $this->referenceId;
    }

    /**
     * @return string
     */
    public function getPaymentUrl(): string
    {
        return $this->paymentUrl;
    }

    /**
     * @return Carbon
     */
    public function getExpiresAt(): Carbon
    {
        return $this->expiresAt;
    }

    /**
     * @return string
     */
    public function getQrcode(): string
    {
        return $this->qrcode;
    }
}