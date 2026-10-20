<?php

declare(strict_types=1);

namespace AdroSoftware\CircleSoSdk\Endpoint\HeadlessMember;

use AdroSoftware\CircleSoSdk\Endpoint\AbstractEndpoint;
use AdroSoftware\CircleSoSdk\Endpoint\EndpointInterface;

final class Posts extends AbstractEndpoint implements EndpointInterface
{
    /** Create an image post */
    /** @param array<string, mixed> $data */
    public function createAnImagePost(int|string $spaceId, array $data): mixed
    {
        return $this->request('POST', "/spaces/{$spaceId}/images/posts", [], $data);
    }

    /** Update an image post */
    /** @param array<string, mixed> $data */
    public function updateAnImagePost(int|string $spaceId, int|string $id, array $data = []): mixed
    {
        return $this->request('PUT', "/spaces/{$spaceId}/images/posts/{$id}", [], $data);
    }

    /** Follow a post */
    public function followAPost(int|string $postId): mixed
    {
        return $this->request('POST', "/posts/{$postId}/post_followers");
    }

    /** Unfollow a post */
    public function unfollowAPost(int|string $postId): mixed
    {
        return $this->request('DELETE', "/posts/{$postId}/post_followers");
    }

    /** Unfollow a post with ID */
    public function unfollowAPostWithId(int|string $postId, int|string $id): mixed
    {
        return $this->request('DELETE', "/posts/{$postId}/post_followers/{$id}");
    }

    /** Create a post */
    /** @param array<string, mixed> $data */
    public function createAPost(int|string $spaceId, array $data): mixed
    {
        return $this->request('POST', "/spaces/{$spaceId}/posts", [], $data);
    }

    /** Get list of posts in a space */
    /** @param array<string, mixed> $query */
    public function getListOfPostsInASpace(int|string $spaceId, array $query = []): mixed
    {
        return $this->request('GET', "/spaces/{$spaceId}/posts", $query);
    }

    /** Delete a post */
    public function deleteAPost(int|string $spaceId, int|string $id): mixed
    {
        return $this->request('DELETE', "/spaces/{$spaceId}/posts/{$id}");
    }

    /** Get a post */
    public function getAPost(int|string $spaceId, int|string $id): mixed
    {
        return $this->request('GET', "/spaces/{$spaceId}/posts/{$id}");
    }

    /** Create a user like for a post */
    /** @param array<string, mixed> $data */
    public function createAUserLikeForAPost(int|string $postId, array $data = []): mixed
    {
        return $this->request('POST', "/posts/{$postId}/user_likes", [], $data);
    }

    /** Destroy a user like for a post */
    public function destroyAUserLikeForAPost(int|string $postId): mixed
    {
        return $this->request('DELETE', "/posts/{$postId}/user_likes");
    }

    /** Get list of users who liked a post */
    /** @param array<string, mixed> $query */
    public function getListOfUsersWhoLikedAPost(int|string $postId, array $query = []): mixed
    {
        return $this->request('GET', "/posts/{$postId}/user_likes", $query);
    }
}
