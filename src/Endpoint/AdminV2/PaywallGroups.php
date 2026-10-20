<?php

declare(strict_types=1);

namespace AdroSoftware\CircleSoSdk\Endpoint\AdminV2;

use AdroSoftware\CircleSoSdk\Endpoint\AbstractEndpoint;
use AdroSoftware\CircleSoSdk\Endpoint\EndpointInterface;

final class PaywallGroups extends AbstractEndpoint implements EndpointInterface
{
    /** Create Subscription Group */
    /** @param array<string, mixed> $data */
    public function createSubscriptionGroup(array $data): mixed
    {
        return $this->request('POST', "/paywall_groups", [], $data);
    }

    /** Update Subscription Group */
    /** @param array<string, mixed> $data */
    public function updateSubscriptionGroup(int|string $id, array $data): mixed
    {
        return $this->request('PUT', "/paywall_groups/{$id}", [], $data);
    }
}
