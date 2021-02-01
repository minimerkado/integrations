<?php


namespace Revenuecat\Exceptions;

use Exception;
use Throwable;

class RevenuecatException extends Exception
{
    public function __construct($message = "", $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}