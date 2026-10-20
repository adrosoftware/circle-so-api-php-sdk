<?php

declare(strict_types=1);

namespace AdroSoftware\CircleSoSdk\Endpoint\AdminV2;

use AdroSoftware\CircleSoSdk\Endpoint\AbstractEndpoint;
use AdroSoftware\CircleSoSdk\Endpoint\EndpointInterface;

final class ProfileFields extends AbstractEndpoint implements EndpointInterface
{
    /** Archive Profile Field */
    public function archiveProfileField(int|string $id): mixed
    {
        return $this->request('PUT', "/profile_fields/{$id}/archive");
    }

    /** Create Profile Field */
    /** @param array<string, mixed> $data */
    public function createProfileField(array $data): mixed
    {
        return $this->request('POST', "/profile_fields", [], $data);
    }

    /** Profile Fields List */
    /** @param array<string, mixed> $query */
    public function profileFieldsList(array $query = []): mixed
    {
        return $this->request('GET', "/profile_fields", $query);
    }

    /** Delete Profile Field */
    public function deleteProfileField(int|string $id): mixed
    {
        return $this->request('DELETE', "/profile_fields/{$id}");
    }

    /** Update Profile Field */
    /** @param array<string, mixed> $data */
    public function updateProfileField(int|string $id, array $data): mixed
    {
        return $this->request('PUT', "/profile_fields/{$id}", [], $data);
    }

    /** Unarchive Profile Field */
    public function unarchiveProfileField(int|string $id): mixed
    {
        return $this->request('PUT', "/profile_fields/{$id}/unarchive");
    }
}
