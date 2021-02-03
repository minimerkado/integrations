<?php


namespace MercadoPago\Requests\Preference\Objects;


use Common\JsonEncodable;
use Common\Utilities;

class Shipments implements JsonEncodable
{
    use Utilities;

    const MODE_CUSTOM = 'custom';
    const MODE_ME2 = 'me2';
    const MODE_NOT_SPECIFIED = 'not_specified';

    private string $mode = self::MODE_NOT_SPECIFIED;
    private ?bool $local_pickup = null;
    private ?string $dimensions = null;
    private ?int $default_shipping_method = null;
    /** @var int[]|null  */
    private ?array $free_methods = null;
    private ?float $cost = null;
    private ?bool $free_shipping = null;
    private ?Address $receiver_address = null;

    static function custom(float $cost): Shipments
    {
        return (new Shipments())
            ->setMode(self::MODE_CUSTOM)
            ->setCost($cost);
    }

    static function free(): Shipments
    {
        return (new Shipments())
            ->setMode(self::MODE_NOT_SPECIFIED);
    }

    /**
     * Modo de envio:
     *
     *  - **custom**: informado pelo vendedor
     *  - **me2**: mercado envios
     *  - **not_specified**: não especificado (padrão)
     *
     * @param string $mode
     * @return Shipments
     */
    public function setMode(string $mode): Shipments
    {
        $this->mode = $mode;
        return $this;
    }

    /**
     * Preferência de remoção de pacotes em agência(mode:me2 somente).
     *
     * @param bool|null $local_pickup
     * @return Shipments
     */
    public function setLocalPickup(?bool $local_pickup): Shipments
    {
        $this->local_pickup = $local_pickup;
        return $this;
    }

    /**
     * Tamanho do pacote em cm x cm x cm, gr (mode:me2 somente).
     * Para um pacote cúbico de **10cm** de lado com **100gr**: **10x10x10,100**
     *
     * @param string|null $dimensions
     * @return Shipments
     */
    public function setDimensions(?string $dimensions): Shipments
    {
        $this->dimensions = $dimensions;
        return $this;
    }

    /**
     * Escolha um método de envio padrão no _checkout_(mode:me2 somente).
     *
     * @param int|null $default_shipping_method
     * @return Shipments
     */
    public function setDefaultShippingMethod(?int $default_shipping_method): Shipments
    {
        $this->default_shipping_method = $default_shipping_method;
        return $this;
    }

    /**
     * Oferecer um método de frete grátis (mode:me2 somente).
     * Deve ser informado um array com os ids dos métodos de envio
     *
     * @param array|null $free_methods
     * @return Shipments
     */
    public function setFreeMethods(?array $free_methods): Shipments
    {
        $this->free_methods = $free_methods;
        return $this;
    }

    /**
     * Custo do transporte (mode:custom somente).
     *
     * @param float|null $cost
     * @return Shipments
     */
    public function setCost(?float $cost): Shipments
    {
        $this->cost = $cost;
        return $this;
    }

    /**
     * Preferência de frete grátis para mode:custom.
     *
     * @param bool|null $free_shipping
     * @return Shipments
     */
    public function setFreeShipping(?bool $free_shipping): Shipments
    {
        $this->free_shipping = $free_shipping;
        return $this;
    }

    /**
     * Endereço de envio.
     *
     * @param Address|null $receiver_address
     * @return Shipments
     */
    public function setReceiverAddress(?Address $receiver_address): Shipments
    {
        $this->receiver_address = $receiver_address;
        return $this;
    }

    public function toJson(): array
    {
        $free_methods = self::when($this->free_methods, fn($arr) => array_map(fn($id) => [ 'id' => $id ], $arr));

        return self::not_null([
            'mode' => $this->mode,
            'local_pickup' => $this->local_pickup,
            'dimensions' => $this->dimensions,
            'default_shipping_method' => $this->default_shipping_method,
            'free_methods' => $free_methods,
            'cost' => $this->cost,
            'free_shipping' => $this->free_shipping,
            'receiver_address' => self::when($this->receiver_address, fn($value) => $value->toJson()),
        ]);
    }
}