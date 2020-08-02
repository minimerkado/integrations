<?php


namespace MercadoPago\Requests\Preference\Objects;


use Common\JsonObject;

class BackUrls implements JsonObject
{
    private string $success;
    private string $pending;
    private string $failure;

    /**
     * @param string $success
     * @return BackUrls
     */
    public function setSuccess(string $success): BackUrls
    {
        $this->success = $success;
        return $this;
    }

    /**
     * @param string $pending
     * @return BackUrls
     */
    public function setPending(string $pending): BackUrls
    {
        $this->pending = $pending;
        return $this;
    }

    /**
     * @param string $failure
     * @return BackUrls
     */
    public function setFailure(string $failure): BackUrls
    {
        $this->failure = $failure;
        return $this;
    }

    public function toJson(): array
    {
        return [
            'success' => $this->success,
            'pending' => $this->pending,
            'failure' => $this->failure,
        ];
    }
}