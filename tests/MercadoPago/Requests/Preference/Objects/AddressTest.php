<?php


namespace Tests\MercadoPago\Requests\Preference\Objects;


use MercadoPago\Requests\Preference\Objects\Address;
use Orchestra\Testbench\TestCase;

class AddressTest extends TestCase
{
    function testToJson()
    {
        $address = (new Address())
            ->setZipCode('99999-888')
            ->setStreetName('St Test Name')
            ->setStreetNumber(5)
            ->setCityName('San Francisco')
            ->setStateName('CA')
            ->setFloor('2')
            ->setApartment('2001');

        self::assertEquals([
            'zip_code' => '99999-888',
            'street_name' => 'St Test Name',
            'street_number' => 5,
            'state_name' => 'CA',
            'city_name' => 'San Francisco',
            'floor' => '2',
            'apartment' => '2001',
        ], $address->toJson());
    }

    function testToJsonWithNull()
    {
        $address = (new Address())
            ->setZipCode('99999-888')
            ->setStreetName('St Test Name')
            ->setStreetNumber(5);

        self::assertEquals([
            'zip_code' => '99999-888',
            'street_name' => 'St Test Name',
            'street_number' => 5,
        ], $address->toJson());
    }
}