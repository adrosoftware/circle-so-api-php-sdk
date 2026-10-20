<?php

declare(strict_types=1);

namespace AdroSoftware\CircleSoSdk\Endpoint\AdminV2;

use AdroSoftware\CircleSoSdk\Endpoint\AbstractEndpoint;
use AdroSoftware\CircleSoSdk\Endpoint\EndpointInterface;

final class AccessGroups extends AbstractEndpoint implements EndpointInterface
{
    /** Create Access Group */
    /** @param array<string, mixed> $data */
    public function createAccessGroup(array $data = []): mixed
    {
        return $this->request('POST', "/access_groups", [], $data);
    }

    /** List Access Groups */
    /** @param array<string, mixed> $query */
    public function listAccessGroups(array $query = []): mixed
    {
        return $this->request('GET', "/access_groups", $query);
    }

    /** Archive Access Group */
    public function archiveAccessGroup(int|string $id): mixed
    {
        return $this->request('DELETE', "/access_groups/{$id}");
    }

    /** Update Access Group */
    /** @param array<string, mixed> $data */
    public function updateAccessGroup(int|string $id, array $data = []): mixed
    {
        return $this->request('PUT', "/access_groups/{$id}", [], $data);
    }

    /** Unarchive Access Group */
    public function unarchiveAccessGroup(int|string $id): mixed
    {
        return $this->request('PATCH', "/access_groups/{$id}/unarchive");
    }
}
