<?php

declare(strict_types=1);

namespace AdroSoftware\CircleSoSdk\Endpoint\AdminV2;

use AdroSoftware\CircleSoSdk\Endpoint\AbstractEndpoint;
use AdroSoftware\CircleSoSdk\Endpoint\EndpointInterface;

final class SpaceMembers extends AbstractEndpoint implements EndpointInterface
{
    /** Add Space Member */
    /** @param array<string, mixed> $data */
    public function addSpaceMember(array $data = []): mixed
    {
        return $this->request('POST', "/space_members", [], $data);
    }

    /** Remove Space Member */
    /** @param array<string, mixed> $query */
    public function removeSpaceMember(array $query = []): mixed
    {
        return $this->request('DELETE', "/space_members", $query);
    }

    /** List Space Members */
    /** @param array<string, mixed> $query */
    public function listSpaceMembers(array $query = []): mixed
    {
        return $this->request('GET', "/space_members", $query);
    }

    /** Show Space Member */
    /** @param array<string, mixed> $query */
    public function showSpaceMember(array $query = []): mixed
    {
        return $this->request('GET', "/space_member", $query);
    }
}
