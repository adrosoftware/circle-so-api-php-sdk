<?php

declare(strict_types=1);

namespace AdroSoftware\CircleSoSdk\Endpoint\AdminV2;

use AdroSoftware\CircleSoSdk\Endpoint\AbstractEndpoint;
use AdroSoftware\CircleSoSdk\Endpoint\EndpointInterface;

final class Comments extends AbstractEndpoint implements EndpointInterface
{
    /** @param array<string, mixed> $query */
    public function all(array $query = []): mixed
    {
        return $this->listComments($query);
    }

    public function show(int|string $id): mixed
    {
        return $this->showComment($id);
    }

    /** @param array<string, mixed> $data */
    public function create(array $data): mixed
    {
        return $this->createComment($data);
    }

    public function delete(int|string $id): mixed
    {
        return $this->destroyComment($id);
    }

    /** Create Comment */
    /** @param array<string, mixed> $data */
    public function createComment(array $data = []): mixed
    {
        return $this->request('POST', "/comments", [], $data);
    }

    /** List Comments */
    /** @param array<string, mixed> $query */
    public function listComments(array $query = []): mixed
    {
        return $this->request('GET', "/comments", $query);
    }

    /** Destroy Comment */
    public function destroyComment(int|string $id): mixed
    {
        return $this->request('DELETE', "/comments/{$id}");
    }

    /** Show Comment */
    public function showComment(int|string $id): mixed
    {
        return $this->request('GET', "/comments/{$id}");
    }
}
