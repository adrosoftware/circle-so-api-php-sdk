<?php

declare(strict_types=1);

namespace AdroSoftware\CircleSoSdk\Endpoint\AdminV2;

use AdroSoftware\CircleSoSdk\Endpoint\AbstractEndpoint;
use AdroSoftware\CircleSoSdk\Endpoint\EndpointInterface;

final class PaywallAffiliatePayouts extends AbstractEndpoint implements EndpointInterface
{
    /** Export Paywall Affiliate Payouts */
    /** @param array<string, mixed> $data */
    public function exportPaywallAffiliatePayouts(array $data = []): mixed
    {
        return $this->request('POST', "/paywall_affiliate_payouts/export", [], $data);
    }

    /** Mark Paywall Affiliate Payouts Paid */
    /** @param array<string, mixed> $data */
    public function markPaywallAffiliatePayoutsPaid(array $data = []): mixed
    {
        return $this->request('POST', "/paywall_affiliate_payouts/mark_paid", [], $data);
    }

    /** Start Paywall Affiliate Payouts */
    /** @param array<string, mixed> $data */
    public function startPaywallAffiliatePayouts(array $data = []): mixed
    {
        return $this->request('POST', "/paywall_affiliate_payouts/start", [], $data);
    }
}
