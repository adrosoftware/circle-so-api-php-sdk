<?php

declare(strict_types=1);

namespace AdroSoftware\CircleSoSdk\Endpoint\AdminV2;

use AdroSoftware\CircleSoSdk\Endpoint\AbstractEndpoint;
use AdroSoftware\CircleSoSdk\Endpoint\EndpointInterface;

final class PaywallAffiliates extends AbstractEndpoint implements EndpointInterface
{
    /** Paywall Affiliates List */
    /** @param array<string, mixed> $query */
    public function paywallAffiliatesList(array $query = []): mixed
    {
        return $this->request('GET', "/paywall_affiliates", $query);
    }

    /** Invite Paywall Affiliates */
    /** @param array<string, mixed> $data */
    public function invitePaywallAffiliates(array $data): mixed
    {
        return $this->request('POST', "/paywall_affiliates/invite", [], $data);
    }

    /** Update Paywall Affiliate */
    /** @param array<string, mixed> $data */
    public function updatePaywallAffiliate(int|string $id, array $data): mixed
    {
        return $this->request('PATCH', "/paywall_affiliates/{$id}", [], $data);
    }
}
