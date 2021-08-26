<?php

namespace Facebook\Contracts;

use Illuminate\Support\Collection;

interface FacebookCatalogService
{
    public function batch(string $catalog_id, Collection|array $requests): void;
}