<?php

declare(strict_types=1);

namespace AdroSoftware\CircleSoSdk\Endpoint\AdminV2;

use AdroSoftware\CircleSoSdk\Endpoint\AbstractEndpoint;
use AdroSoftware\CircleSoSdk\Endpoint\EndpointInterface;

final class SpaceGroups extends AbstractEndpoint implements EndpointInterface
{
    /** Create Space Group */
    /** @param array<string, mixed> $data */
    public function createSpaceGroup(array $data = []): mixed
    {
        return $this->request('POST', "/space_groups", [], $data);
    }

    /** List Space Groups */
    /** @param array<string, mixed> $query */
    public function listSpaceGroups(array $query = []): mixed
    {
        return $this->request('GET', "/space_groups", $query);
    }

    /** Delete Space Group */
    public function deleteSpaceGroup(int|string $id): mixed
    {
        return $this->request('DELETE', "/space_groups/{$id}");
    }

    /** Show Space Group */
    public function showSpaceGroup(int|string $id): mixed
    {
        return $this->request('GET', "/space_groups/{$id}");
    }

    /** Update Space Group */
    /** @param array<string, mixed> $data */
    public function updateSpaceGroup(int|string $id, array $data): mixed
    {
        return $this->request('PUT', "/space_groups/{$id}", [], $data);
    }
}
