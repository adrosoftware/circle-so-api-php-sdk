<?php

declare(strict_types=1);

namespace AdroSoftware\CircleSoSdk\Endpoint\HeadlessMember;

use AdroSoftware\CircleSoSdk\Endpoint\AbstractEndpoint;
use AdroSoftware\CircleSoSdk\Endpoint\EndpointInterface;

final class Bookmarks extends AbstractEndpoint implements EndpointInterface
{
    /** Create a bookmark */
    /** @param array<string, mixed> $data */
    public function createABookmark(array $data = []): mixed
    {
        return $this->request('POST', "/bookmarks", [], $data);
    }

    /** Get bookmarks paginated list */
    /** @param array<string, mixed> $query */
    public function getBookmarksPaginatedList(array $query = []): mixed
    {
        return $this->request('GET', "/bookmarks", $query);
    }

    /** Delete a bookmark */
    public function deleteABookmark(int|string $id): mixed
    {
        return $this->request('DELETE', "/bookmarks/{$id}");
    }
}
