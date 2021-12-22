<?php

namespace Iugu\Exceptions;

use JetBrains\PhpStorm\Pure;

class IuguException extends \Exception
{
    public function __construct($message = "", $code = 0, \Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}