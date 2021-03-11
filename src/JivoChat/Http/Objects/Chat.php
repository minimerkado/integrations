<?php


namespace JivoChat\Http\Objects;


use Illuminate\Support\Arr;

class Chat
{
    const RATE_POSITIVE = 'positive';
    const RATE_NEGATIVE = 'negative';

    private array $messages;
    private ?string $rate;
    private bool $blacklisted;

    public function __construct(array $json)
    {
        $this->messages = $json['messages'];
        $this->rate = Arr::get($json, 'rate');
        $this->blacklisted = $json['blacklisted'];
    }

    /**
     * @return array|mixed
     */
    public function getMessages(): array
    {
        return $this->messages;
    }

    /**
     * @return mixed|string
     */
    public function getRate(): string
    {
        return $this->rate;
    }

    /**
     * @return bool|mixed
     */
    public function getBlacklisted(): bool
    {
        return $this->blacklisted;
    }
}