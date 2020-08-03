<?php


namespace MercadoPago\Requests\Preference\Objects;


use Common\JsonObject;
use Common\Utilities;

class PaymentMethods implements JsonObject
{
    use Utilities;

    /** @var string[] */
    private array $excluded_payment_methods = [];
    /** @var string[] */
    private array $excluded_payment_types = [];
    private string $default_payment_method_id;
    private int $installments = 1;
    private int $default_installments = 1;

    /**
     * @param string $method
     * @return PaymentMethods
     */
    public function addExcludedPaymentMethod(string $method): PaymentMethods
    {
        $this->excluded_payment_methods[] = $method;
        return $this;
    }

    /**
     * @param string $type
     * @return PaymentMethods
     */
    public function addExcludedPaymentType(string $type): PaymentMethods
    {
        $this->excluded_payment_types[] = $type;
        return $this;
    }

    /**
     * @param string $default_payment_method_id
     * @return PaymentMethods
     */
    public function setDefaultPaymentMethodId(string $default_payment_method_id): PaymentMethods
    {
        $this->default_payment_method_id = $default_payment_method_id;
        return $this;
    }

    /**
     * @param int $installments
     * @return PaymentMethods
     */
    public function setInstallments(int $installments): PaymentMethods
    {
        $this->installments = $installments;
        return $this;
    }

    /**
     * @param int $default_installments
     * @return PaymentMethods
     */
    public function setDefaultInstallments(int $default_installments): PaymentMethods
    {
        $this->default_installments = $default_installments;
        return $this;
    }

    public function toJson(): array
    {
        return [
            'excluded_payment_methods' => array_map(fn ($id) => [ 'id' => $id ], $this->excluded_payment_methods),
            'excluded_payment_types' => array_map(fn ($id) => [ 'id' => $id ], $this->excluded_payment_types),
            'default_payment_method_id' => $this->default_payment_method_id,
            'installments' => $this->installments,
            'default_installments' => $this->default_installments,
        ];
    }
}