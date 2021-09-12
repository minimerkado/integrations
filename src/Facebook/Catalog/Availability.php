<?php

namespace Facebook\Catalog;

abstract class Availability
{
    const IN_STOCK = 'in stock';
    const AVAILABLE = 'available';
    const FOR_ORDER = 'for order';
    const OUT_OF_STOCK = 'out of stock';
}