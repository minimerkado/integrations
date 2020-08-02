<?php


namespace MercadoPago;


class Configuration
{
    const PRODUCTION = 'production';
    const SANDBOX = 'sandbox';

    private string $environment;

    public function __construct(array $config)
    {
        $this->environment = $config['environment'] ?? self::SANDBOX;
    }

    public function isProduction()
    {
        return $this->environment === self::PRODUCTION;
    }
}