<?php


namespace Correios\Exceptions;


class ShippingValuationException extends CorreiosException
{
    public function __construct($code, $message)
    {
        parent::__construct(409, "$code: $message");
    }
}