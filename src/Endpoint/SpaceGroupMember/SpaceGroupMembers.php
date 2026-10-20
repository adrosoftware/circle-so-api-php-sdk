<?php

declare(strict_types=1);

namespace AdroSoftware\CircleSoSdk\Endpoint\SpaceGroupMember;

use AdroSoftware\CircleSoSdk\Endpoint\AbstractEndpoint;
use AdroSoftware\CircleSoSdk\Endpoint\EndpointInterface;

final class SpaceGroupMembers extends AbstractEndpoint implements EndpointInterface
{
    public function show(string $email, int $spaceGroupId, ?int $communityId = null): mixed
    {
        return $this->request('GET', '/space_group_member', [
            ...$this->communityQuery($communityId),
            'email' => $email,
            'space_group_id' => $spaceGroupId,
        ]);
    }

    public function add(string $email, int $spaceGroupId, ?int $communityId = null): mixed
    {
        return $this->request('POST', '/space_group_members', [
            ...$this->communityQuery($communityId),
            'email' => $email,
            'space_group_id' => $spaceGroupId,
        ]);
    }

    public function remove(string $email, int $spaceGroupId, ?int $communityId = null): mixed
    {
        return $this->request('DELETE', '/space_group_members', [
            ...$this->communityQuery($communityId),
            'email' => $email,
            'space_group_id' => $spaceGroupId,
        ]);
    }
}
