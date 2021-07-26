<?php


namespace Correios\Exceptions;


class InvalidDimensionException extends CorreiosException
{
    public function __construct($dimension, $value)
    {
        parent::__construct(409, __('exceptions.correios.invalid_dimension', [
            'dimension' => __("exceptions.correios.dimensions.$dimension"),
            'value' => $value
        ]));
    }
}