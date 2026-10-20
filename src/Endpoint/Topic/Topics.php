<?php

declare(strict_types=1);

namespace AdroSoftware\CircleSoSdk\Endpoint\Topic;

use AdroSoftware\CircleSoSdk\Endpoint\AbstractEndpoint;
use AdroSoftware\CircleSoSdk\Endpoint\EndpointInterface;

final class Topics extends AbstractEndpoint implements EndpointInterface
{
    public function all(?int $communityId = null, ?int $perPage = null, ?int $page = null): mixed
    {
        return $this->request('GET', '/topics', [
            ...$this->communityQuery($communityId),
            'per_page' => $perPage,
            'page' => $page,
        ]);
    }

    /** @param array<string, mixed> $data */
    public function create(array $data, ?int $communityId = null): mixed
    {
        return $this->request('POST', '/topics', $this->communityQuery($communityId), $data);
    }

    /** @param array<string, mixed> $data */
    public function update(int $id, array $data, ?int $communityId = null): mixed
    {
        return $this->request('PUT', "/topics/{$id}", $this->communityQuery($communityId), $data);
    }

    public function delete(int $id, ?int $communityId = null): mixed
    {
        return $this->request('DELETE', "/topics/{$id}", $this->communityQuery($communityId));
    }
}
