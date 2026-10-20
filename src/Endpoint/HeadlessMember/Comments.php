<?php

declare(strict_types=1);

namespace AdroSoftware\CircleSoSdk\Endpoint\HeadlessMember;

use AdroSoftware\CircleSoSdk\Endpoint\AbstractEndpoint;
use AdroSoftware\CircleSoSdk\Endpoint\EndpointInterface;

final class Comments extends AbstractEndpoint implements EndpointInterface
{
    /** Create a comment for a post */
    /** @param array<string, mixed> $data */
    public function createACommentForAPost(int|string $postId, array $data): mixed
    {
        return $this->request('POST', "/posts/{$postId}/comments", [], $data);
    }

    /** Get list of comments for a post */
    /** @param array<string, mixed> $query */
    public function getListOfCommentsForAPost(int|string $postId, array $query = []): mixed
    {
        return $this->request('GET', "/posts/{$postId}/comments", $query);
    }

    /** Delete a comment for a post */
    public function deleteACommentForAPost(int|string $postId, int|string $id): mixed
    {
        return $this->request('DELETE', "/posts/{$postId}/comments/{$id}");
    }

    /** Get a comment for a post */
    public function getACommentForAPost(int|string $postId, int|string $id): mixed
    {
        return $this->request('GET', "/posts/{$postId}/comments/{$id}");
    }

    /** Update a comment for a post */
    /** @param array<string, mixed> $data */
    public function updateACommentForAPost(int|string $postId, int|string $id, array $data): mixed
    {
        return $this->request('PATCH', "/posts/{$postId}/comments/{$id}", [], $data);
    }

    /** Create a reply for a comment */
    /** @param array<string, mixed> $data */
    public function createAReplyForAComment(int|string $commentId, array $data): mixed
    {
        return $this->request('POST', "/comments/{$commentId}/replies", [], $data);
    }

    /** Get list of replies for a comment */
    /** @param array<string, mixed> $query */
    public function getListOfRepliesForAComment(int|string $commentId, array $query = []): mixed
    {
        return $this->request('GET', "/comments/{$commentId}/replies", $query);
    }

    /** Delete a reply for a comment */
    public function deleteAReplyForAComment(int|string $commentId, int|string $id): mixed
    {
        return $this->request('DELETE', "/comments/{$commentId}/replies/{$id}");
    }

    /** Get a reply for a comment */
    public function getAReplyForAComment(int|string $commentId, int|string $id): mixed
    {
        return $this->request('GET', "/comments/{$commentId}/replies/{$id}");
    }

    /** Update a reply for a comment */
    /** @param array<string, mixed> $data */
    public function updateAReplyForAComment(int|string $commentId, int|string $id, array $data): mixed
    {
        return $this->request('PATCH', "/comments/{$commentId}/replies/{$id}", [], $data);
    }

    /** Create a user like for a comment */
    /** @param array<string, mixed> $data */
    public function createAUserLikeForAComment(int|string $commentId, array $data = []): mixed
    {
        return $this->request('POST', "/comments/{$commentId}/user_likes", [], $data);
    }

    /** Destroy a user like for a comment */
    public function destroyAUserLikeForAComment(int|string $commentId): mixed
    {
        return $this->request('DELETE', "/comments/{$commentId}/user_likes");
    }

    /** Get list of users who liked a comment */
    /** @param array<string, mixed> $query */
    public function getListOfUsersWhoLikedAComment(int|string $commentId, array $query = []): mixed
    {
        return $this->request('GET', "/comments/{$commentId}/user_likes", $query);
    }
}
