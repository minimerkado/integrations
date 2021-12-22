<?php

namespace Iugu\Responses;

use Common\Response;

class EmptyResponse implements Response
{
    public function parse(string $body) { }
}