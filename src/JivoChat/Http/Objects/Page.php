<?php


namespace JivoChat\Http\Objects;


use Illuminate\Support\Arr;

class Page
{
    private string $url;
    private ?string $title;

    public function __construct(array $json)
    {
        $this->url = $json['url'];
        $this->title = Arr::get($json, 'title');
    }

    /**
     * @return string
     */
    public function getUrl(): string
    {
        return $this->url;
    }

    /**
     * @return string|null
     */
    public function getTitle(): ?string
    {
        return $this->title;
    }
}