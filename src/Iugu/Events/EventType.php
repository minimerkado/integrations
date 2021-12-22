<?php

namespace Iugu\Events;

class EventType
{
    const SUBSCRIPTION_SUSPENDED = 'subscription.suspended';
    const SUBSCRIPTION_EXPIRED = 'subscription.expired';
    const SUBSCRIPTION_ACTIVATED = 'subscription.activated';
    const SUBSCRIPTION_CREATED = 'subscription.created';
    const SUBSCRIPTION_RENEWED = 'subscription.renewed';
    const SUBSCRIPTION_CHANGED = 'subscription.changed';
}