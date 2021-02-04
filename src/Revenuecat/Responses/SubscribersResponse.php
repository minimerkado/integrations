<?php


namespace Revenuecat\Responses;


use Common\Response;
use Illuminate\Support\Arr;

class SubscribersResponse implements Response
{
    private array $entitlements;
    private array $subscriptions;

    public function __construct(string $body)
    {
        $this->parse($body);
    }

    public function parse(string $body)
    {
        $json = json_decode($body, true);

        $entitlements = Arr::get($json,'subscriber.entitlements');
        foreach ($entitlements as $id => $arr) {
            $this->entitlements[] = new Entitlement($id, $arr);
        }

        $subscriptions = Arr::get($json,'subscriber.subscriptions');
        foreach ($subscriptions as $id => $arr) {
            $this->subscriptions[] = new Subscription($id, $arr);
        }
    }

    /**
     * @return Entitlement[]
     */
    public function getEntitlements(): array
    {
        return $this->entitlements;
    }

    /**
     * @return Subscription[]
     */
    public function getSubscriptions(): array
    {
        return $this->subscriptions;
    }
}