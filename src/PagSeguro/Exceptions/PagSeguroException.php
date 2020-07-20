<?php


namespace PagSeguro\Exceptions;

use Exception;
use Throwable;

class PagSeguroException extends Exception
{
    public function __construct($message = "", $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}