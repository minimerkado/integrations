<?php


namespace MelhorEnvio;


use Illuminate\Support\Str;

abstract class Environment
{
    const SANDBOX = 'SANDBOX';
    const PRODUCTION = 'PRODUCTION';

    public static function isSandbox($value): bool
    {
        return strcasecmp(self::SANDBOX, $value);
    }

    public static function isProduction($value): bool
    {
        return strcasecmp(self::PRODUCTION, $value);
    }
}