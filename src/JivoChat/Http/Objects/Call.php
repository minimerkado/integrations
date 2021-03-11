<?php


namespace JivoChat\Http\Objects;


use Illuminate\Support\Arr;

class Call
{
    const TYPE_CALLBACK = 'callback';
    const TYPE_INCOMING = 'incoming';
    const TYPE_OUTGOING = 'outgoing';

    const STATUS_START = 'start';
    const STATUS_END = 'end';
    const STATUS_AGENT_CONNECTED = 'agent_connected';
    const STATUS_CLIENT_CONNECTED = 'client_connected';
    const STATUS_ERROR = 'error';

    private string $type;
    private string $phone;
    private string $status;
    private ?string $reason;
    private ?string $record_url;

    public function __construct(array $json)
    {
        $this->type = $json['type'];
        $this->phone = $json['phone'];
        $this->status = $json['status'];
        $this->reason = Arr::get($json, 'reason');
        $this->record_url = Arr::get($json, 'record_url');
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @return string
     */
    public function getPhone(): string
    {
        return $this->phone;
    }

    /**
     * @return string
     */
    public function getStatus(): string
    {
        return $this->status;
    }

    /**
     * @return string|null
     */
    public function getReason(): ?string
    {
        return $this->reason;
    }

    /**
     * @return string|null
     */
    public function getRecordUrl(): ?string
    {
        return $this->record_url;
    }
}