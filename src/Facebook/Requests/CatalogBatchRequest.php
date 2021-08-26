<?php

namespace Facebook\Requests;

use Illuminate\Support\Collection;

class CatalogBatchRequest extends PostRequest
{
    private string $catalog_id;
    private array $requests = [];
    private bool $allow_upsert = true;

    public function setAllowUpsert(bool $allow_upsert): CatalogBatchRequest
    {
        $this->allow_upsert = $allow_upsert;
        return $this;
    }

    public function setCatalogId(string $catalog_id): CatalogBatchRequest
    {
        $this->catalog_id = $catalog_id;
        return $this;
    }

    public function setRequests(Collection|array $requests): CatalogBatchRequest
    {
        if ($requests instanceof Collection)
            $this->requests = $requests->all();
        else
            $this->requests = $requests;
        return $this;
    }

    public function addRequest(CatalogItemRequest $request): self
    {
        $this->requests[] = $request;
        return $this;
    }

    public function getPath()
    {
        return "$this->catalog_id/batch";
    }

    public function toJson(): array
    {
        $requests = collect($this->requests)
            ->map(fn (CatalogItemRequest $req) => $req->toJson())
            ->all();

        return [
            'allow_upsert' => $this->allow_upsert,
            'requests' => $requests,
        ];
    }
}