<?php


namespace Tests\MercadoPago\Requests\Preference\Objects;


use MercadoPago\Requests\Preference\Objects\PaymentMethods;
use Orchestra\Testbench\TestCase;

class PaymentMethodsTest extends TestCase
{
    function testToJson()
    {
        $obj = (new PaymentMethods())
            ->addExcludedPaymentMethod('method1')
            ->addExcludedPaymentMethod('method2')
            ->addExcludedPaymentType('type1')
            ->setInstallments(5)
            ->setDefaultInstallments(3)
            ->setDefaultPaymentMethodId('method3');

        self::assertEquals([
            'excluded_payment_methods' => [
                ['id' => 'method1'],
                ['id' => 'method2'],
            ],
            'excluded_payment_types' => [
                ['id' => 'type1'],
            ],
            'default_payment_method_id' => 'method3',
            'installments' => 5,
            'default_installments' => 3,
        ], $obj->toJson());
    }
}