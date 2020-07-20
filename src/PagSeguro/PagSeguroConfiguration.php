<?php


namespace PagSeguro;


class PagSeguroConfiguration
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