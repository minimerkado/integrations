<?php


namespace PicPay\Responses;


class CancelResponse implements Response
{
    private string $referenceId;
    private string $cancellationId;

    public function __construct(string $body)
    {
        $this->parse($body);
    }

    public function parse(string $body)
    {
        $json = json_decode($body);
        $this->referenceId = $json->referenceId;
        $this->cancellationId = $json->cancellationId;
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
    public function getCancellationId(): string
    {
        return $this->cancellationId;
    }
}