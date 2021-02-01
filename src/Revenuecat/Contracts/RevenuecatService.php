<?php

namespace Revenuecat\Contracts;

use Revenuecat\Requests\SubscribersRequest;
use Revenuecat\Responses\SubscribersResponse;

interface RevenuecatService
{
    /**
     * @param SubscribersRequest $request
     * @return SubscribersResponse
     */
    function get(SubscribersRequest $request): SubscribersResponse;

}