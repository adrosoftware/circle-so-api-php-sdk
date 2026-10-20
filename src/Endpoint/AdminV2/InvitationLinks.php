<?php

declare(strict_types=1);

namespace AdroSoftware\CircleSoSdk\Endpoint\AdminV2;

use AdroSoftware\CircleSoSdk\Endpoint\AbstractEndpoint;
use AdroSoftware\CircleSoSdk\Endpoint\EndpointInterface;

final class InvitationLinks extends AbstractEndpoint implements EndpointInterface
{
    /** Create invitation link */
    /** @param array<string, mixed> $data */
    public function createInvitationLink(array $data): mixed
    {
        return $this->request('POST', "/invitation_links", [], $data);
    }

    /** List Invitation Links */
    /** @param array<string, mixed> $query */
    public function listInvitationLinks(array $query = []): mixed
    {
        return $this->request('GET', "/invitation_links", $query);
    }

    /** Delete invitation link */
    public function deleteInvitationLink(int|string $id): mixed
    {
        return $this->request('DELETE', "/invitation_links/{$id}");
    }

    /** Update invitation link */
    /** @param array<string, mixed> $data */
    public function updateInvitationLink(int|string $id, array $data): mixed
    {
        return $this->request('PUT', "/invitation_links/{$id}", [], $data);
    }

    /** Revoke invitation link */
    public function revokeInvitationLink(int|string $id): mixed
    {
        return $this->request('PATCH', "/invitation_links/{$id}/revoke");
    }
}
