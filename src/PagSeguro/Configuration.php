<?php


namespace PagSeguro;


class Configuration
{
    private string $environment;

    public function __construct(array $config)
    {
        $this->environment = $config['environment'] ?? 'sandbox';
    }

    public function isProduction(): bool
    {
        return $this->environment === 'production';
    }
}