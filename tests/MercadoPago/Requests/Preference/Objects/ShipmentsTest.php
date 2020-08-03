<?php


namespace Tests\MercadoPago\Requests\Preference\Objects;


use MercadoPago\Requests\Preference\Objects\Address;
use MercadoPago\Requests\Preference\Objects\Shipments;
use Orchestra\Testbench\TestCase;

class ShipmentsTest extends TestCase
{
    public function testToJson()
    {
        $shipments = (new Shipments())
            ->setMode(Shipments::MODE_ME2)
            ->setDimensions('10x10x10,100gr')
            ->setDefaultShippingMethod(2)
            ->setFreeMethods([1, 3, 4])
            ->setLocalPickup(true)
            ->setReceiverAddress((new Address())
                ->setZipCode('99999-888')
                ->setStreetName('St Test Name')
                ->setStreetNumber(5)
                ->setCityName('San Francisco')
                ->setStateName('CA')
                ->setFloor('2')
                ->setApartment('2001'));

        self::assertEquals([
            'mode' => 'me2',
            'local_pickup' => true,
            'dimensions' => '10x10x10,100gr',
            'default_shipping_method' => 2,
            'free_methods' => [
                [ 'id' => 1 ],
                [ 'id' => 3 ],
                [ 'id' => 4 ],
            ],
            'receiver_address' => [
                'zip_code' => '99999-888',
                'street_name' => 'St Test Name',
                'street_number' => 5,
                'state_name' => 'CA',
                'city_name' => 'San Francisco',
                'floor' => '2',
                'apartment' => '2001',
            ]
        ], $shipments->toJson());
    }

    public function testToJsonForCustom()
    {
        $shipments = Shipments::custom(15.0, false);

        self::assertEquals([
            'mode' => 'custom',
            'cost' => 15.0,
            'free_shipping' => false,
        ], $shipments->toJson());

    }
}