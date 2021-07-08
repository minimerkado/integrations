<?php


namespace RevenueCat\Events;


use Illuminate\Foundation\Events\Dispatchable;

abstract class RevenueCatEvent
{
    use Dispatchable;

    protected string $type;
    protected string $product_id;
    protected string $app_user_id;
    protected string $store;

    /**
     * RevenueCatEvent constructor.
     * @param string $type
     */
    public function __construct(string $type)
    {
        $this->type = $type;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function getProductId(): string
    {
        return $this->product_id;
    }

    public function setProductId(string $product_id): self
    {
        $this->product_id = $product_id;
        return $this;
    }

    public function getAppUserId(): string
    {
        return $this->app_user_id;
    }

    public function setAppUserId(string $app_user_id): self
    {
        $this->app_user_id = $app_user_id;
        return $this;
    }

    public function getStore(): string
    {
        return $this->store;
    }

    public function setStore(string $store): self
    {
        $this->store = $store;
        return $this;
    }
}
