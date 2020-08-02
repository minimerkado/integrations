<?php


namespace PicPay\Responses;

use Carbon\Carbon;
use Common\Response;

class CheckoutResponse implements Response
{
    private string $referenceId;
    private string $paymentUrl;
    private ?Carbon $expiresAt = null;
    private QrCode $qrcode;

    public function __construct(string $body)
    {
        $this->parse($body);
    }

    public function parse(string $body)
    {
        $json = json_decode($body);
        $this->referenceId = $json->referenceId;
        $this->paymentUrl = $json->paymentUrl;
        $this->expiresAt = Carbon::parse($json->expiresAt);
        $this->qrcode = new QrCode($json->qrcode->content, $json->qrcode->base64);
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
     * @return Carbon|null
     */
    public function getExpiresAt(): ?Carbon
    {
        return $this->expiresAt;
    }

    /**
     * @return QrCode
     */
    public function getQrcode(): QrCode
    {
        return $this->qrcode;
    }
}