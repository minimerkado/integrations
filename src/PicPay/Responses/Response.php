<?php

namespace PicPay\Responses;

interface Response
{
    public function parse(string $body);
}