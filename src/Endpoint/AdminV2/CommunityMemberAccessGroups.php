<?php

declare(strict_types=1);

namespace AdroSoftware\CircleSoSdk\Endpoint\AdminV2;

use AdroSoftware\CircleSoSdk\Endpoint\AbstractEndpoint;
use AdroSoftware\CircleSoSdk\Endpoint\EndpointInterface;

final class CommunityMemberAccessGroups extends AbstractEndpoint implements EndpointInterface
{
    /** List Community Member's Access Groups */
    /** @param array<string, mixed> $query */
    public function listCommunityMembersAccessGroups(int|string $communityMemberId, array $query = []): mixed
    {
        return $this->request('GET', "/community_members/{$communityMemberId}/access_groups", $query);
    }
}
