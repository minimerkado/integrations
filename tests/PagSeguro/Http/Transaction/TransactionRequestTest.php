<?php


namespace Tests\PagSeguro\Http\Transaction;


use Orchestra\Testbench\TestCase;
use PagSeguro\Http\Transaction\TransactionRequest;

class TransactionRequestTest extends TestCase
{
    function testPath()
    {
        $request = (new TransactionRequest('email@example.com', 'token1234'))
            ->setCode('code123');

        self::assertEquals('/v3/transactions/code123', $request->getPath());
    }

    function testBuild()
    {
        $request = (new TransactionRequest('email@example.com', 'token1234'))
            ->setCode('code123');

        self::assertEquals([
            'query' => [
                'email' => 'email@example.com',
                'token' => 'token1234',
            ]
        ], $request->build());
    }
}