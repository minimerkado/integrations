<?php


namespace Common;


interface Request
{
    public function getMethod();
    public function getPath();
    public function build(): array;
}