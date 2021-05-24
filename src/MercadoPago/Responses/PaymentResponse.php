<?php


namespace MercadoPago\Responses;


use Carbon\Carbon;
use Common\Response;

class PaymentResponse implements Response
{
    const STATUS_PENDING = 'pending';
    const STATUS_APPROVED = 'approved';
    const STATUS_AUTHORIZED = 'authorized';
    const STATUS_IN_PROCESS = 'in_process';
    const STATUS_IN_MEDIATION = 'in_mediation';
    const STATUS_REJECTED = 'rejected';
    const STATUS_CANCELLED = 'cancelled';
    const STATUS_REFUNDED = 'refunded';
    const STATUS_CHARGEBACK = 'chargeback';

    private string $id;
    private string $status;
    private Carbon $date_created;
    private ?Carbon $date_last_updated;
    private ?Carbon $date_approved;

    public function __construct(string $body)
    {
        $this->parse($body);
    }

    public function parse(string $body)
    {
        $json = json_decode($body, true);
        $this->id = $json['id'];
        $this->status = $json['status'];
        $this->date_created = Carbon::parse($json['date_created']);

        if ($date_last_updated = $json['date_last_updated']) {
            $this->date_last_updated = Carbon::parse($date_last_updated);
        }

        if ($date_approved = $json['date_approved']) {
            $this->date_approved = Carbon::parse($date_approved);
        }
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getStatus(): string
    {
        return $this->status;
    }

    /**
     * @return Carbon
     */
    public function getDateCreated(): Carbon
    {
        return $this->date_created;
    }

    /**
     * @return Carbon|null
     */
    public function getDateApproved(): ?Carbon
    {
        return $this->date_approved;
    }

    /**
     * @return Carbon|null
     */
    public function getDateLastUpdated(): ?Carbon
    {
        return $this->date_last_updated;
    }
}