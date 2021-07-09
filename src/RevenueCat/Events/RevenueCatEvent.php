<?php


namespace RevenueCat\Events;


use Illuminate\Foundation\Events\Dispatchable;

abstract class RevenueCatEvent
{
    use Dispatchable;

    protected string $type;
    protected string $store;
    protected string $app_user_id;
    protected string $product_id;
    protected array $data;

    /**
     * RevenueCatEvent constructor.
     * @param string $type
     */
    public function __construct(string $type, string $store, string $app_user_id, string $product_id, array $data = [])
    {
        $this->type = $type;
        $this->store = $store;
        $this->app_user_id = $app_user_id;
        $this->product_id = $product_id;
        $this->data = $data;
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
    public function getStore(): string
    {
        return $this->store;
    }

    /**
     * @return string
     */
    public function getAppUserId(): string
    {
        return $this->app_user_id;
    }

    /**
     * @return string
     */
    public function getProductId(): string
    {
        return $this->product_id;
    }

    /**
     * @return array
     */
    public function getData(): array
    {
        return $this->data;
    }
}
