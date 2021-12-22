<?php

namespace Iugu\Events;

abstract class IuguEvent
{
    protected string $type;
    protected string $id;
    protected string $account_id;

    public function __construct(string $type, string $id, string $account_id)
    {
        $this->type = $type;
        $this->id = $id;
        $this->account_id = $account_id;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getAccountId(): string
    {
        return $this->account_id;
    }
}