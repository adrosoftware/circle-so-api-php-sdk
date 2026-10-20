<?php

declare(strict_types=1);

namespace AdroSoftware\CircleSoSdk\Endpoint\Post;

use AdroSoftware\CircleSoSdk\Endpoint\AbstractEndpoint;
use AdroSoftware\CircleSoSdk\Endpoint\EndpointInterface;

final class Posts extends AbstractEndpoint implements EndpointInterface
{
    /** @param array<int> $topicIds */
    public function all(int $spaceId, ?int $communityId = null, array $topicIds = []): mixed
    {
        return $this->request('GET', '/posts', [
            ...$this->communityQuery($communityId),
            'space_id' => $spaceId,
            'topics' => $topicIds === [] ? null : $topicIds,
        ]);
    }

    public function show(int $id, ?int $communityId = null): mixed
    {
        return $this->request('GET', "/posts/{$id}", $this->communityQuery($communityId));
    }

    /** @param array<string, mixed> $data */
    public function create(int $spaceId, array $data, ?int $communityId = null): mixed
    {
        return $this->request('POST', '/posts', [
            ...$this->communityQuery($communityId),
            'space_id' => $spaceId,
        ], $data);
    }

    /** @param array<string, mixed> $data */
    public function update(int $id, array $data, ?int $communityId = null): mixed
    {
        return $this->request('PUT', "/posts/{$id}", $this->communityQuery($communityId), $data);
    }

    public function delete(int $id, ?int $communityId = null): mixed
    {
        return $this->request('DELETE', "/posts/{$id}", $this->communityQuery($communityId));
    }
}
