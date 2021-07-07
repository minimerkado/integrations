<?php

namespace RevenueCat\Contracts;

use RevenueCat\Requests\GetSubscriberRequest;
use RevenueCat\Responses\SubscriberResponse;

interface RevenueCatService
{
    function getSubscriber(string $user_id): SubscriberResponse;
}