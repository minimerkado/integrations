<?php

namespace Facebook\Catalog;

use Carbon\Carbon;
use Common\XmlEncodable;

class SalePriceEffectiveDate implements XmlEncodable
{
    private Carbon $start;
    private Carbon $end;

    /**
     * @param Carbon $start
     * @param Carbon $end
     */
    public function __construct(Carbon $start, Carbon $end)
    {
        $this->start = $start;
        $this->end = $end;
    }

    public function encode(\SimpleXMLElement $root)
    {
        $start_date = $this->start->toIso8601String();
        $end_date = $this->end->toIso8601String();
        $root->addChild("sale_price_effective_date", "$start_date/$end_date", Catalog::GOOGLE_NS);
    }
}