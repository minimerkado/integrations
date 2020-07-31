<?php


namespace PicPay\Responses;


class StatusResponse implements Response
{
    private string $referenceId;
    private string $authorizationId;
    private string $status;

    public function __construct(string $body)
    {
        $this->parse($body);
    }

    public function parse(string $body)
    {
        $json = json_decode($body);
        $this->referenceId = $json->referenceId;
        $this->authorizationId = $json->authorizationId;
        $this->status = $json->status;
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
    public function getAuthorizationId(): string
    {
        return $this->authorizationId;
    }

    /**
     * @return string
     */
    public function getStatus(): string
    {
        return $this->status;
    }
}