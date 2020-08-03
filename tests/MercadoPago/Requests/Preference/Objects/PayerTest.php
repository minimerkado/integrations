<?php


namespace Tests\MercadoPago\Requests\Preference\Objects;


use MercadoPago\Requests\Preference\Objects\Address;
use MercadoPago\Requests\Preference\Objects\Identification;
use MercadoPago\Requests\Preference\Objects\Payer;
use MercadoPago\Requests\Preference\Objects\Phone;
use Orchestra\Testbench\TestCase;

class PayerTest extends TestCase
{
    function testToJson()
    {
        $payer = (new Payer())
            ->setName('Joao')
            ->setSurname('Santos da Silva')
            ->setEmail('joao@example.com')
            ->setPhone(new Phone('21', '98888-8888'))
            ->setAddress((new Address())
                ->setZipCode('99999-888')
                ->setStreetName('St Test Name')
                ->setStreetNumber(5))
            ->setIdentification(new Identification('CPF', '111.111.111-11'));

        self::assertEquals([
            'name' => 'Joao',
            'surname' => 'Santos da Silva',
            'email' => 'joao@example.com',
            'phone' => [
                'area_code' => '21',
                'number' => '98888-8888',
            ],
            'address' => [
                'zip_code' => '99999-888',
                'street_name' => 'St Test Name',
                'street_number' => 5,
            ],
            'identification' => [
                'type' => 'CPF',
                'number' => '111.111.111-11',
            ],
        ], $payer->toJson());
    }

    function testToJsonWithNull()
    {
        $payer = (new Payer())
            ->setName('Joao')
            ->setSurname('Santos da Silva')
            ->setEmail('joao@example.com');

        self::assertEquals([
            'name' => 'Joao',
            'surname' => 'Santos da Silva',
            'email' => 'joao@example.com',
        ], $payer->toJson());
    }
}