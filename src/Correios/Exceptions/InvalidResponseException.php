<?php


namespace Correios\Exceptions;


class InvalidResponseException extends CorreiosException
{
    public function __construct()
    {
        parent::__construct(500, 'Invalid response');
    }
}