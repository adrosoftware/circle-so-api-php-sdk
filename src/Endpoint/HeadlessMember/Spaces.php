<?php

declare(strict_types=1);

namespace AdroSoftware\CircleSoSdk\Endpoint\HeadlessMember;

use AdroSoftware\CircleSoSdk\Endpoint\AbstractEndpoint;
use AdroSoftware\CircleSoSdk\Endpoint\EndpointInterface;

final class Spaces extends AbstractEndpoint implements EndpointInterface
{
    /** Get space notification details */
    /** @param array<string, mixed> $query */
    public function getSpaceNotificationDetails(array $query = []): mixed
    {
        return $this->request('GET', "/space_notification_details", $query);
    }

    /** Get space bookmarks */
    /** @param array<string, mixed> $query */
    public function getSpaceBookmarks(int|string $spaceId, array $query = []): mixed
    {
        return $this->request('GET', "/spaces/{$spaceId}/bookmarks", $query);
    }

    /** Get home space details */
    public function getHomeSpaceDetails(): mixed
    {
        return $this->request('GET', "/spaces/home");
    }

    /** Get list of spaces */
    public function getListOfSpaces(): mixed
    {
        return $this->request('GET', "/spaces");
    }

    /** Join a space by id */
    public function joinASpaceById(int|string $id): mixed
    {
        return $this->request('POST', "/spaces/{$id}/join");
    }

    /** Leave a space by id */
    public function leaveASpaceById(int|string $id): mixed
    {
        return $this->request('POST', "/spaces/{$id}/leave");
    }

    /** Get space details */
    public function getSpaceDetails(int|string $id): mixed
    {
        return $this->request('GET', "/spaces/{$id}");
    }

    /** Get space topics */
    /** @param array<string, mixed> $query */
    public function getSpaceTopics(int|string $spaceId, array $query = []): mixed
    {
        return $this->request('GET', "/spaces/{$spaceId}/topics", $query);
    }
}
