<?php

namespace PagSeguro\Requests;


interface Request
{
    public function getMethod();
    public function getPath();
    public function build(): array;
}