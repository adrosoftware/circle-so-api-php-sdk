<?php

declare(strict_types=1);

namespace AdroSoftware\CircleSoSdk\Endpoint\Event;

use AdroSoftware\CircleSoSdk\Endpoint\AbstractEndpoint;
use AdroSoftware\CircleSoSdk\Endpoint\EndpointInterface;

final class Events extends AbstractEndpoint implements EndpointInterface
{
    public function all(?int $communityId = null, ?int $perPage = null, ?int $page = null): mixed
    {
        return $this->request('GET', '/events', [
            ...$this->communityQuery($communityId),
            'per_page' => $perPage,
            'page' => $page,
        ]);
    }

    /** @param array<string, mixed> $data */
    public function create(int $spaceId, array $data, ?int $communityId = null): mixed
    {
        return $this->request('POST', '/events', [
            ...$this->communityQuery($communityId),
            'space_id' => $spaceId,
        ], $data);
    }

    /** @param array<string, mixed> $data */
    public function update(int $id, int $spaceId, array $data, ?int $communityId = null): mixed
    {
        return $this->request('PUT', "/events/{$id}", [
            ...$this->communityQuery($communityId),
            'space_id' => $spaceId,
        ], $data);
    }

    public function delete(int $id, int $spaceId, ?int $communityId = null): mixed
    {
        return $this->request('DELETE', "/events/{$id}", [
            ...$this->communityQuery($communityId),
            'space_id' => $spaceId,
        ]);
    }
}
