<?php

namespace RevenueCat\Contracts;

use RevenueCat\Responses\SubscriberResponse;

interface RevenueCatService
{
    function getSubscriber(string $user_id): SubscriberResponse;
}