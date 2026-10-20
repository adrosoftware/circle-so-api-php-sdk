<?php

declare(strict_types=1);

namespace AdroSoftware\CircleSoSdk\Endpoint\AdminV2;

use AdroSoftware\CircleSoSdk\Endpoint\AbstractEndpoint;
use AdroSoftware\CircleSoSdk\Endpoint\EndpointInterface;

final class CommunitySegments extends AbstractEndpoint implements EndpointInterface
{
    /** Create a community segment */
    /** @param array<string, mixed> $data */
    public function createACommunitySegment(array $data): mixed
    {
        return $this->request('POST', "/community_segments", [], $data);
    }

    /** List Community Segments */
    /** @param array<string, mixed> $query */
    public function listCommunitySegments(array $query = []): mixed
    {
        return $this->request('GET', "/community_segments", $query);
    }

    /** Delete a community segment */
    public function deleteACommunitySegment(int|string $id): mixed
    {
        return $this->request('DELETE', "/community_segments/{$id}");
    }

    /** Update a community segment */
    /** @param array<string, mixed> $data */
    public function updateACommunitySegment(int|string $id, array $data): mixed
    {
        return $this->request('PUT', "/community_segments/{$id}", [], $data);
    }

    /** Duplicate a community segment */
    /** @param array<string, mixed> $query */
    public function duplicateACommunitySegment(int|string $id, array $query = []): mixed
    {
        return $this->request('POST', "/community_segments/{$id}/duplicate", $query);
    }
}
