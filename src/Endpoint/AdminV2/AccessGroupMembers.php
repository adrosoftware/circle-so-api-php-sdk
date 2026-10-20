<?php

declare(strict_types=1);

namespace AdroSoftware\CircleSoSdk\Endpoint\AdminV2;

use AdroSoftware\CircleSoSdk\Endpoint\AbstractEndpoint;
use AdroSoftware\CircleSoSdk\Endpoint\EndpointInterface;

final class AccessGroupMembers extends AbstractEndpoint implements EndpointInterface
{
    /** Add Member to Access Group */
    /** @param array<string, mixed> $data */
    public function addMemberToAccessGroup(int|string $accessGroupId, array $data): mixed
    {
        return $this->request('POST', "/access_groups/{$accessGroupId}/community_members", [], $data);
    }

    /** Remove Access Group Member */
    /** @param array<string, mixed> $query */
    public function removeAccessGroupMember(int|string $accessGroupId, array $query = []): mixed
    {
        return $this->request('DELETE', "/access_groups/{$accessGroupId}/community_members", $query);
    }

    /** List Access Group Community Members */
    /** @param array<string, mixed> $query */
    public function listAccessGroupCommunityMembers(int|string $accessGroupId, array $query = []): mixed
    {
        return $this->request('GET', "/access_groups/{$accessGroupId}/community_members", $query);
    }

    /** Show Access Group Community Member */
    /** @param array<string, mixed> $query */
    public function showAccessGroupCommunityMember(int|string $accessGroupId, array $query = []): mixed
    {
        return $this->request('GET', "/access_groups/{$accessGroupId}/community_member", $query);
    }
}
