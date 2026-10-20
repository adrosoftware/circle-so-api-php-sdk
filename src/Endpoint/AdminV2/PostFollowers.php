<?php

declare(strict_types=1);

namespace AdroSoftware\CircleSoSdk\Endpoint\AdminV2;

use AdroSoftware\CircleSoSdk\Endpoint\AbstractEndpoint;
use AdroSoftware\CircleSoSdk\Endpoint\EndpointInterface;

final class PostFollowers extends AbstractEndpoint implements EndpointInterface
{
    /** Unfollow a post */
    /** @param array<string, mixed> $query */
    public function unfollowAPost(int|string $postId, array $query = []): mixed
    {
        return $this->request('DELETE', "/posts/{$postId}/post_followers", $query);
    }
}
