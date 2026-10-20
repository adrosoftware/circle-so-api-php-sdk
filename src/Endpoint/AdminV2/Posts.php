<?php

declare(strict_types=1);

namespace AdroSoftware\CircleSoSdk\Endpoint\AdminV2;

use AdroSoftware\CircleSoSdk\Endpoint\AbstractEndpoint;
use AdroSoftware\CircleSoSdk\Endpoint\EndpointInterface;

final class Posts extends AbstractEndpoint implements EndpointInterface
{
    /** @param array<string, mixed> $query */
    public function all(array $query = []): mixed
    {
        return $this->listBasicPosts($query);
    }

    public function show(int|string $id): mixed
    {
        return $this->showBasicPost($id);
    }

    /** @param array<string, mixed> $data */
    public function create(array $data): mixed
    {
        return $this->createBasicPost($data);
    }

    /** @param array<string, mixed> $data */
    public function update(int|string $id, array $data): mixed
    {
        return $this->updateBasicPost($id, $data);
    }

    public function delete(int|string $id): mixed
    {
        return $this->deleteBasicPost($id);
    }

    public function summary(int|string $postId): mixed
    {
        return $this->getPostSummary($postId);
    }

    /** Create Image Post */
    /** @param array<string, mixed> $data */
    public function createImagePost(int|string $spaceId, array $data = []): mixed
    {
        return $this->request('POST', "/spaces/{$spaceId}/images/posts", [], $data);
    }

    /** List Image Posts */
    /** @param array<string, mixed> $query */
    public function listImagePosts(int|string $spaceId, array $query = []): mixed
    {
        return $this->request('GET', "/spaces/{$spaceId}/images/posts", $query);
    }

    /** Delete Image Post */
    public function deleteImagePost(int|string $spaceId, int|string $id): mixed
    {
        return $this->request('DELETE', "/spaces/{$spaceId}/images/posts/{$id}");
    }

    /** Show Image Post */
    public function showImagePost(int|string $spaceId, int|string $id): mixed
    {
        return $this->request('GET', "/spaces/{$spaceId}/images/posts/{$id}");
    }

    /** Duplicate Image Post */
    /** @param array<string, mixed> $data */
    public function duplicateImagePost(int|string $spaceId, int|string $id, array $data = []): mixed
    {
        return $this->request('POST', "/spaces/{$spaceId}/images/posts/{$id}/duplicate", [], $data);
    }

    /** Create Basic Post */
    /** @param array<string, mixed> $data */
    public function createBasicPost(array $data = []): mixed
    {
        return $this->request('POST', "/posts", [], $data);
    }

    /** List Basic Posts */
    /** @param array<string, mixed> $query */
    public function listBasicPosts(array $query = []): mixed
    {
        return $this->request('GET', "/posts", $query);
    }

    /** Delete Basic Post */
    public function deleteBasicPost(int|string $id): mixed
    {
        return $this->request('DELETE', "/posts/{$id}");
    }

    /** Show Basic Post */
    public function showBasicPost(int|string $id): mixed
    {
        return $this->request('GET', "/posts/{$id}");
    }

    /** Update Basic Post */
    /** @param array<string, mixed> $data */
    public function updateBasicPost(int|string $id, array $data = []): mixed
    {
        return $this->request('PUT', "/posts/{$id}", [], $data);
    }

    /** Get Post Summary */
    public function getPostSummary(int|string $postId): mixed
    {
        return $this->request('GET', "/posts/{$postId}/summary");
    }
}
