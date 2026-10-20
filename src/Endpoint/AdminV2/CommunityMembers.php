<?php

declare(strict_types=1);

namespace AdroSoftware\CircleSoSdk\Endpoint\AdminV2;

use AdroSoftware\CircleSoSdk\Endpoint\AbstractEndpoint;
use AdroSoftware\CircleSoSdk\Endpoint\EndpointInterface;

final class CommunityMembers extends AbstractEndpoint implements EndpointInterface
{
    /** @param array<string, mixed> $query */
    public function all(array $query = []): mixed
    {
        return $this->listCommunityMembers($query);
    }

    public function show(int|string $id): mixed
    {
        return $this->showACommunityMember($id);
    }

    /** @param array<string, mixed> $query */
    public function search(array $query): mixed
    {
        return $this->searchACommunityMember($query);
    }

    /** @param array<string, mixed> $data */
    public function create(array $data): mixed
    {
        return $this->createInviteACommunityMember($data);
    }

    /** @param array<string, mixed> $data */
    public function update(int|string $id, array $data): mixed
    {
        return $this->updateACommunityMember($id, $data);
    }

    public function deactivate(int|string $id): mixed
    {
        return $this->deactivateACommunityMember($id);
    }

    public function delete(int|string $id): mixed
    {
        return $this->deleteCommunityMember($id);
    }

    public function ban(int|string $id): mixed
    {
        return $this->banCommunityMember($id);
    }

    /** Ban Community Member */
    public function banCommunityMember(int|string $id): mixed
    {
        return $this->request('PUT', "/community_members/{$id}/ban_member");
    }

    /** Create/Invite a community member */
    /** @param array<string, mixed> $data */
    public function createInviteACommunityMember(array $data): mixed
    {
        return $this->request('POST', "/community_members", [], $data);
    }

    /** List Community Members */
    /** @param array<string, mixed> $query */
    public function listCommunityMembers(array $query = []): mixed
    {
        return $this->request('GET', "/community_members", $query);
    }

    /** Delete Community Member */
    public function deleteCommunityMember(int|string $id): mixed
    {
        return $this->request('PUT', "/community_members/{$id}/delete_member");
    }

    /** Deactivate a community member */
    public function deactivateACommunityMember(int|string $id): mixed
    {
        return $this->request('DELETE', "/community_members/{$id}");
    }

    /** Show a community member */
    public function showACommunityMember(int|string $id): mixed
    {
        return $this->request('GET', "/community_members/{$id}");
    }

    /** Update a community member */
    /** @param array<string, mixed> $data */
    public function updateACommunityMember(int|string $id, array $data): mixed
    {
        return $this->request('PUT', "/community_members/{$id}", [], $data);
    }

    /** Search a community member */
    /** @param array<string, mixed> $query */
    public function searchACommunityMember(array $query = []): mixed
    {
        return $this->request('GET', "/community_members/search", $query);
    }
}
