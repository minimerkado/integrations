<?php

namespace PagSeguro\Http\Objects;

use Carbon\Carbon;
use Common\Utilities;
use Common\XmlDecodable;

class Transaction implements XmlDecodable
{
    const STATUS_AGUARDANDO_PAGAMENTO = 1;
    const STATUS_EM_ANALISE           = 2;
    const STATUS_PAGA                 = 3;
    const STATUS_DISPONIVEL           = 4;
    const STATUS_EM_DISPUTA           = 5;
    const STATUS_DEVOLVIDA            = 6;
    const STATUS_CANCELADA            = 7;
    const STATUS_DEBITADO             = 8;
    const STATUS_RETENCAO_TEMPORARIA  = 9;

    use Utilities;

    private string $code;
    private Carbon $date;
    private Carbon $lastEventDate;
    private ?Carbon $escrowEndDate = null;
    private string $reference;
    private ?string $paymentLink = null;
    private int $type;
    private int $status;
    private PaymentMethod $paymentMethod;

    private float $grossAmount;
    private float $discountAmount;
    private float $feeAmount;
    private float $netAmount;
    private float $extraAmount;
    private int $installmentCount;
    private int $itemCount;
    private Shipping $shipping;
    private Items $items;
    private Sender $sender;

    /**
     * @return string
     */
    public function getCode(): string
    {
        return $this->code;
    }

    /**
     * @return Carbon
     */
    public function getDate(): Carbon
    {
        return $this->date;
    }

    /**
     * @return Carbon
     */
    public function getLastEventDate(): Carbon
    {
        return $this->lastEventDate;
    }

    /**
     * @return Carbon|null
     */
    public function getEscrowEndDate(): ?Carbon
    {
        return $this->escrowEndDate;
    }

    /**
     * @return string
     */
    public function getReference(): string
    {
        return $this->reference;
    }

    /**
     * @return string|null
     */
    public function getPaymentLink(): ?string
    {
        return $this->paymentLink;
    }

    /**
     * @return int
     */
    public function getType(): int
    {
        return $this->type;
    }

    /**
     * @return int
     */
    public function getStatus(): int
    {
        return $this->status;
    }

    /**
     * @return PaymentMethod
     */
    public function getPaymentMethod(): PaymentMethod
    {
        return $this->paymentMethod;
    }

    /**
     * @return float
     */
    public function getGrossAmount(): float
    {
        return $this->grossAmount;
    }

    /**
     * @return float
     */
    public function getDiscountAmount(): float
    {
        return $this->discountAmount;
    }

    /**
     * @return float
     */
    public function getFeeAmount(): float
    {
        return $this->feeAmount;
    }

    /**
     * @return float
     */
    public function getNetAmount(): float
    {
        return $this->netAmount;
    }

    /**
     * @return float
     */
    public function getExtraAmount(): float
    {
        return $this->extraAmount;
    }

    /**
     * @return int
     */
    public function getInstallmentCount(): int
    {
        return $this->installmentCount;
    }

    /**
     * @return int
     */
    public function getItemCount(): int
    {
        return $this->itemCount;
    }

    /**
     * @return Shipping
     */
    public function getShipping(): Shipping
    {
        return $this->shipping;
    }

    /**
     * @return Items
     */
    public function getItems(): Items
    {
        return $this->items;
    }

    /**
     * @return Sender
     */
    public function getSender(): Sender
    {
        return $this->sender;
    }

    public function decode(\SimpleXMLElement $root): Transaction
    {
        $this->code = (string) $root->code;
        $this->date = Carbon::parse($root->date);
        $this->lastEventDate = Carbon::parse($root->lastEventDate);
        $this->escrowEndDate = Carbon::parse($root->escrowEndDate);
        $this->reference = $root->reference;
        $this->paymentLink = $root->paymentLink;
        $this->type = (int) $root->type;
        $this->status = (int) $root->status;
        $this->paymentMethod = (new paymentMethod())->decode($root->paymentMethod);
        $this->grossAmount = (float) $root->grossAmount;
        $this->discountAmount = (float) $root->discountAmount;
        $this->feeAmount = (float) $root->feeAmount;
        $this->netAmount = (float) $root->netAmount;
        $this->extraAmount = (float) $root->extraAmount;
        $this->installmentCount = (int) $root->installmentCount;
        $this->itemsCount = (int) $root->itemsCount;
        $this->items = (new Items())->decode($root->items);
        $this->shipping = (new Shipping())->decode($root->shipping);
        $this->sender = (new Sender())->decode($root->sender);

        return $this;
    }
}