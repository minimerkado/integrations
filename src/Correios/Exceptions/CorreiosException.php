<?php


namespace Correios\Exceptions;

use Symfony\Component\HttpKernel\Exception\HttpException;

class CorreiosException extends HttpException
{
    public function __construct(int $statusCode = 500, string $message = null)
    {
        parent::__construct($statusCode, $message);
    }
}