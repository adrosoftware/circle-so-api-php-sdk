<?php

declare(strict_types=1);

namespace AdroSoftware\CircleSoSdk\Endpoint\AdminV2;

use AdroSoftware\CircleSoSdk\Endpoint\AbstractEndpoint;
use AdroSoftware\CircleSoSdk\Endpoint\EndpointInterface;

final class Events extends AbstractEndpoint implements EndpointInterface
{
    /** Create Event */
    /** @param array<string, mixed> $data */
    public function createEvent(array $data): mixed
    {
        return $this->request('POST', "/events", [], $data);
    }

    /** List Events */
    /** @param array<string, mixed> $query */
    public function listEvents(array $query = []): mixed
    {
        return $this->request('GET', "/events", $query);
    }

    /** Delete Event */
    /** @param array<string, mixed> $query */
    public function deleteEvent(int|string $id, array $query = []): mixed
    {
        return $this->request('DELETE', "/events/{$id}", $query);
    }

    /** Get Event */
    public function getEvent(int|string $id): mixed
    {
        return $this->request('GET', "/events/{$id}");
    }

    /** Update Event */
    /** @param array<string, mixed> $data */
    public function updateEvent(int|string $id, array $data): mixed
    {
        return $this->request('PUT', "/events/{$id}", [], $data);
    }

    /** Duplicate Event */
    /** @param array<string, mixed> $data */
    public function duplicateEvent(int|string $spaceId, int|string $id, array $data): mixed
    {
        return $this->request('POST', "/spaces/{$spaceId}/events/{$id}/duplicate", [], $data);
    }
}
