<?php

declare(strict_types=1);

namespace AdroSoftware\CircleSoSdk\Endpoint\SpaceMember;

use AdroSoftware\CircleSoSdk\Endpoint\AbstractEndpoint;
use AdroSoftware\CircleSoSdk\Endpoint\EndpointInterface;

final class SpaceMembers extends AbstractEndpoint implements EndpointInterface
{
    public function add(string $email, int $spaceId, ?int $communityId = null): mixed
    {
        return $this->request('POST', '/space_members', [
            ...$this->communityQuery($communityId),
            'email' => $email,
            'space_id' => $spaceId,
        ]);
    }

    public function remove(string $email, int $spaceId, ?int $communityId = null): mixed
    {
        return $this->request('DELETE', '/space_members', [
            ...$this->communityQuery($communityId),
            'email' => $email,
            'space_id' => $spaceId,
        ]);
    }
}
