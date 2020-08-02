<?php

namespace Common;

interface Response
{
    public function parse(string $body);
}