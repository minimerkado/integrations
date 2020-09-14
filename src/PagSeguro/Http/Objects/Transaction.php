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
    private ?string $reference = null;
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
     * @param string $code
     * @return Transaction
     */
    public function setCode(string $code): Transaction
    {
        $this->code = $code;
        return $this;
    }

    /**
     * @return Carbon
     */
    public function getDate(): Carbon
    {
        return $this->date;
    }

    /**
     * @param Carbon $date
     * @return Transaction
     */
    public function setDate(Carbon $date): Transaction
    {
        $this->date = $date;
        return $this;
    }

    /**
     * @return Carbon
     */
    public function getLastEventDate(): Carbon
    {
        return $this->lastEventDate;
    }

    /**
     * @param Carbon $lastEventDate
     * @return Transaction
     */
    public function setLastEventDate(Carbon $lastEventDate): Transaction
    {
        $this->lastEventDate = $lastEventDate;
        return $this;
    }

    /**
     * @return Carbon|null
     */
    public function getEscrowEndDate(): ?Carbon
    {
        return $this->escrowEndDate;
    }

    /**
     * @param Carbon|null $escrowEndDate
     * @return Transaction
     */
    public function setEscrowEndDate(?Carbon $escrowEndDate): Transaction
    {
        $this->escrowEndDate = $escrowEndDate;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getReference(): ?string
    {
        return $this->reference;
    }

    /**
     * @param string|null $reference
     * @return Transaction
     */
    public function setReference(?string $reference): Transaction
    {
        $this->reference = $reference;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getPaymentLink(): ?string
    {
        return $this->paymentLink;
    }

    /**
     * @param string|null $paymentLink
     * @return Transaction
     */
    public function setPaymentLink(?string $paymentLink): Transaction
    {
        $this->paymentLink = $paymentLink;
        return $this;
    }

    /**
     * @return int
     */
    public function getType(): int
    {
        return $this->type;
    }

    /**
     * @param int $type
     * @return Transaction
     */
    public function setType(int $type): Transaction
    {
        $this->type = $type;
        return $this;
    }

    /**
     * @return int
     */
    public function getStatus(): int
    {
        return $this->status;
    }

    /**
     * @param int $status
     * @return Transaction
     */
    public function setStatus(int $status): Transaction
    {
        $this->status = $status;
        return $this;
    }

    /**
     * @return PaymentMethod
     */
    public function getPaymentMethod(): PaymentMethod
    {
        return $this->paymentMethod;
    }

    /**
     * @param PaymentMethod $paymentMethod
     * @return Transaction
     */
    public function setPaymentMethod(PaymentMethod $paymentMethod): Transaction
    {
        $this->paymentMethod = $paymentMethod;
        return $this;
    }

    /**
     * @return float
     */
    public function getGrossAmount(): float
    {
        return $this->grossAmount;
    }

    /**
     * @param float $grossAmount
     * @return Transaction
     */
    public function setGrossAmount(float $grossAmount): Transaction
    {
        $this->grossAmount = $grossAmount;
        return $this;
    }

    /**
     * @return float
     */
    public function getDiscountAmount(): float
    {
        return $this->discountAmount;
    }

    /**
     * @param float $discountAmount
     * @return Transaction
     */
    public function setDiscountAmount(float $discountAmount): Transaction
    {
        $this->discountAmount = $discountAmount;
        return $this;
    }

    /**
     * @return float
     */
    public function getFeeAmount(): float
    {
        return $this->feeAmount;
    }

    /**
     * @param float $feeAmount
     * @return Transaction
     */
    public function setFeeAmount(float $feeAmount): Transaction
    {
        $this->feeAmount = $feeAmount;
        return $this;
    }

    /**
     * @return float
     */
    public function getNetAmount(): float
    {
        return $this->netAmount;
    }

    /**
     * @param float $netAmount
     * @return Transaction
     */
    public function setNetAmount(float $netAmount): Transaction
    {
        $this->netAmount = $netAmount;
        return $this;
    }

    /**
     * @return float
     */
    public function getExtraAmount(): float
    {
        return $this->extraAmount;
    }

    /**
     * @param float $extraAmount
     * @return Transaction
     */
    public function setExtraAmount(float $extraAmount): Transaction
    {
        $this->extraAmount = $extraAmount;
        return $this;
    }

    /**
     * @return int
     */
    public function getInstallmentCount(): int
    {
        return $this->installmentCount;
    }

    /**
     * @param int $installmentCount
     * @return Transaction
     */
    public function setInstallmentCount(int $installmentCount): Transaction
    {
        $this->installmentCount = $installmentCount;
        return $this;
    }

    /**
     * @return int
     */
    public function getItemCount(): int
    {
        return $this->itemCount;
    }

    /**
     * @param int $itemCount
     * @return Transaction
     */
    public function setItemCount(int $itemCount): Transaction
    {
        $this->itemCount = $itemCount;
        return $this;
    }

    /**
     * @return Shipping
     */
    public function getShipping(): Shipping
    {
        return $this->shipping;
    }

    /**
     * @param Shipping $shipping
     * @return Transaction
     */
    public function setShipping(Shipping $shipping): Transaction
    {
        $this->shipping = $shipping;
        return $this;
    }

    /**
     * @return Items
     */
    public function getItems(): Items
    {
        return $this->items;
    }

    /**
     * @param Items $items
     * @return Transaction
     */
    public function setItems(Items $items): Transaction
    {
        $this->items = $items;
        return $this;
    }

    /**
     * @return Sender
     */
    public function getSender(): Sender
    {
        return $this->sender;
    }

    /**
     * @param Sender $sender
     * @return Transaction
     */
    public function setSender(Sender $sender): Transaction
    {
        $this->sender = $sender;
        return $this;
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