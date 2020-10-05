<?php


namespace Common;


interface JsonEncodable
{
    public function toJson(): array;
}