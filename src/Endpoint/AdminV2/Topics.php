<?php

declare(strict_types=1);

namespace AdroSoftware\CircleSoSdk\Endpoint\AdminV2;

use AdroSoftware\CircleSoSdk\Endpoint\AbstractEndpoint;
use AdroSoftware\CircleSoSdk\Endpoint\EndpointInterface;

final class Topics extends AbstractEndpoint implements EndpointInterface
{
    /** Create a topic */
    /** @param array<string, mixed> $data */
    public function createATopic(array $data = []): mixed
    {
        return $this->request('POST', "/topics", [], $data);
    }

    /** List topics */
    /** @param array<string, mixed> $query */
    public function listTopics(array $query = []): mixed
    {
        return $this->request('GET', "/topics", $query);
    }

    /** Delete a topic */
    public function deleteATopic(int|string $id): mixed
    {
        return $this->request('DELETE', "/topics/{$id}");
    }

    /** Show topic details */
    public function showTopicDetails(int|string $id): mixed
    {
        return $this->request('GET', "/topics/{$id}");
    }

    /** Update a topic */
    /** @param array<string, mixed> $data */
    public function updateATopic(int|string $id, array $data = []): mixed
    {
        return $this->request('PUT', "/topics/{$id}", [], $data);
    }
}
