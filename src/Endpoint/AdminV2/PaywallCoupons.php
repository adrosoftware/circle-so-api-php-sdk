<?php

declare(strict_types=1);

namespace AdroSoftware\CircleSoSdk\Endpoint\AdminV2;

use AdroSoftware\CircleSoSdk\Endpoint\AbstractEndpoint;
use AdroSoftware\CircleSoSdk\Endpoint\EndpointInterface;

final class PaywallCoupons extends AbstractEndpoint implements EndpointInterface
{
    /** Deletes a paywall coupon */
    public function deletesAPaywallCoupon(int|string $id): mixed
    {
        return $this->request('DELETE', "/paywall_coupons/{$id}");
    }
}
