<?php


namespace Correios\Exceptions;



class InvalidDimensionSumException extends CorreiosException
{
    public function __construct($value)
    {
        parent::__construct(409, __('exceptions.correios.invalid_dimension_sum', ['value' => $value]));
    }
}