<?php

declare(strict_types=1);

namespace AdroSoftware\CircleSoSdk\Endpoint\AdminV2;

use AdroSoftware\CircleSoSdk\Endpoint\AbstractEndpoint;
use AdroSoftware\CircleSoSdk\Endpoint\EndpointInterface;

final class SpaceGroupMembers extends AbstractEndpoint implements EndpointInterface
{
    /** Create Space Group Member */
    /** @param array<string, mixed> $data */
    public function createSpaceGroupMember(array $data = []): mixed
    {
        return $this->request('POST', "/space_group_members", [], $data);
    }

    /** Destroy Space Group Member */
    /** @param array<string, mixed> $query */
    public function destroySpaceGroupMember(array $query = []): mixed
    {
        return $this->request('DELETE', "/space_group_members", $query);
    }

    /** List Space Group Members */
    /** @param array<string, mixed> $query */
    public function listSpaceGroupMembers(array $query = []): mixed
    {
        return $this->request('GET', "/space_group_members", $query);
    }

    /** Show Space Group Member */
    /** @param array<string, mixed> $query */
    public function showSpaceGroupMember(array $query = []): mixed
    {
        return $this->request('GET', "/space_group_member", $query);
    }
}
