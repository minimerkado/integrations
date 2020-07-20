<?php

namespace PagSeguro\Responses;

interface Response
{
    public function parse(string $body);
}