<?php

declare(strict_types=1);

namespace AdroSoftware\CircleSoSdk\Endpoint\AdminV2;

use AdroSoftware\CircleSoSdk\Endpoint\AbstractEndpoint;
use AdroSoftware\CircleSoSdk\Endpoint\EndpointInterface;

final class FilterKitControls extends AbstractEndpoint implements EndpointInterface
{
    /** Create a member filter control */
    /** @param array<string, mixed> $data */
    public function createAMemberFilterControl(array $data): mixed
    {
        return $this->request('POST', "/filter_kit_controls", [], $data);
    }

    /** List member directory and member space filter controls */
    /** @param array<string, mixed> $query */
    public function listMemberDirectoryAndMemberSpaceFilterControls(array $query = []): mixed
    {
        return $this->request('GET', "/filter_kit_controls", $query);
    }

    /** Delete a filter control */
    public function deleteAFilterControl(int|string $id): mixed
    {
        return $this->request('DELETE', "/filter_kit_controls/{$id}");
    }

    /** Get a filter control */
    public function getAFilterControl(int|string $id): mixed
    {
        return $this->request('GET', "/filter_kit_controls/{$id}");
    }

    /** Update a member directory or member space filter control */
    /** @param array<string, mixed> $data */
    public function updateAMemberDirectoryOrMemberSpaceFilterControl(int|string $id, array $data = []): mixed
    {
        return $this->request('PATCH', "/filter_kit_controls/{$id}", [], $data);
    }
}
