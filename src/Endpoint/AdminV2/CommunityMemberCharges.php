<?php

declare(strict_types=1);

namespace AdroSoftware\CircleSoSdk\Endpoint\AdminV2;

use AdroSoftware\CircleSoSdk\Endpoint\AbstractEndpoint;
use AdroSoftware\CircleSoSdk\Endpoint\EndpointInterface;

final class CommunityMemberCharges extends AbstractEndpoint implements EndpointInterface
{
    /** Export Community Member Charges */
    /** @param array<string, mixed> $query */
    public function exportCommunityMemberCharges(array $query = []): mixed
    {
        return $this->request('POST', "/community_member_charges/export", $query);
    }

    /** Community Member Charges List */
    /** @param array<string, mixed> $query */
    public function communityMemberChargesList(array $query = []): mixed
    {
        return $this->request('GET', "/community_member_charges", $query);
    }

    /** Refund Community Member Charge */
    /** @param array<string, mixed> $data */
    public function refundCommunityMemberCharge(int|string $id, array $data = []): mixed
    {
        return $this->request('POST', "/community_member_charges/{$id}/refund", [], $data);
    }
}
