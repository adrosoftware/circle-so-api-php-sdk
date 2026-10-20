<?php

declare(strict_types=1);

namespace AdroSoftware\CircleSoSdk\Endpoint\Comment;

use AdroSoftware\CircleSoSdk\Endpoint\AbstractEndpoint;
use AdroSoftware\CircleSoSdk\Endpoint\EndpointInterface;

final class Comments extends AbstractEndpoint implements EndpointInterface
{
    public function all(
        ?int $communityId = null,
        ?int $spaceId = null,
        ?int $postId = null,
        ?int $topicId = null,
    ): mixed {
        return $this->request('GET', '/comments', [
            ...$this->communityQuery($communityId),
            'space_id' => $spaceId,
            'post_id' => $postId,
            'topic_id' => $topicId,
        ]);
    }

    public function show(int $id, ?int $communityId = null): mixed
    {
        return $this->request('GET', "/comments/{$id}", $this->communityQuery($communityId));
    }

    /** @param array<string, mixed> $data */
    public function create(int $spaceId, int $postId, array $data, ?int $communityId = null): mixed
    {
        return $this->request('POST', '/comments', [
            ...$this->communityQuery($communityId),
            'space_id' => $spaceId,
            'post_id' => $postId,
        ], $data);
    }

    public function delete(int $id, ?int $communityId = null): mixed
    {
        return $this->request('DELETE', "/comments/{$id}", $this->communityQuery($communityId));
    }
}
