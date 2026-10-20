<?php

declare(strict_types=1);

namespace AdroSoftware\CircleSoSdk\Endpoint\HeadlessMember;

use AdroSoftware\CircleSoSdk\Endpoint\AbstractEndpoint;
use AdroSoftware\CircleSoSdk\Endpoint\EndpointInterface;

final class CommunityMembers extends AbstractEndpoint implements EndpointInterface
{
    /** Get paginated list of comments for a community member ID */
    /** @param array<string, mixed> $query */
    public function comments(int|string $communityMemberId, array $query = []): mixed
    {
        return $this->request('GET', "/community_members/{$communityMemberId}/comments", $query);
    }

    /** Deactivate a non-admin and non-owner community member */
    public function deactivateANonAdminAndNonOwnerCommunityMember(): mixed
    {
        return $this->request('DELETE', "/community_member/deactivate");
    }

    /** Get community members paginated list */
    /** @param array<string, mixed> $query */
    public function getCommunityMembersPaginatedList(array $query = []): mixed
    {
        return $this->request('GET', "/community_members", $query);
    }

    /** Get paginated list of posts for a community member ID */
    /** @param array<string, mixed> $query */
    public function posts(int|string $communityMemberId, array $query = []): mixed
    {
        return $this->request('GET', "/community_members/{$communityMemberId}/posts", $query);
    }

    /** Get current community member details */
    public function getCurrentCommunityMemberDetails(): mixed
    {
        return $this->request('GET', "/community_member");
    }

    /** Get paginated list of posts for a community member ID */
    /** @param array<string, mixed> $query */
    public function spaces(int|string $communityMemberId, array $query = []): mixed
    {
        return $this->request('GET', "/community_members/{$communityMemberId}/spaces", $query);
    }

    /** Update community member profile */
    /** @param array<string, mixed> $data */
    public function updateCommunityMemberProfile(array $data = []): mixed
    {
        return $this->request('PUT', "/profile", [], $data);
    }

    /** Get public profile details for a community member ID */
    public function getPublicProfileDetailsForACommunityMemberId(int|string $communityMemberId): mixed
    {
        return $this->request('GET', "/community_members/{$communityMemberId}/public_profile");
    }

    /** Search community members */
    /** @param array<string, mixed> $data */
    public function searchCommunityMembers(array $data = []): mixed
    {
        return $this->request('POST', "/search/community_members", [], $data);
    }
}
