<?php


namespace Tests\PagSeguro\Http\Transaction;


use Illuminate\Support\Carbon;
use Orchestra\Testbench\TestCase;
use PagSeguro\Http\Transaction\TransactionsRequest;

class TransactionsRequestTest extends TestCase
{
    function testPath()
    {
        $request = (new TransactionsRequest('email@example.com', 'token1234'))
            ->setInitialDate(Carbon::parse('2021-01-01'));

        self::assertEquals('/v2/transactions', $request->getPath());
    }

    function testQuery()
    {
        $request = (new TransactionsRequest('email@example.com', 'token1234'))
            ->setInitialDate(Carbon::parse('2021-01-01'))
            ->setFinalDate(Carbon::parse('2021-01-02'))
            ->setPage(1)
            ->setReference('12345');

        self::assertEquals([
            'initialDate' => '2021-01-01T00:00:00+00:00',
            'page' => 1,
            'finalDate' => '2021-01-02T00:00:00+00:00',
            'reference' => '12345',
        ], $request->getQuery());
    }

    function testBuild()
    {
        $request = (new TransactionsRequest('email@example.com', 'token1234'))
            ->setInitialDate(Carbon::parse('2021-01-01'));

        self::assertEquals([
            'query' => [
                'email' => 'email@example.com',
                'token' => 'token1234',
                'initialDate' => '2021-01-01T00:00:00+00:00'
            ]
        ], $request->build());
    }
}