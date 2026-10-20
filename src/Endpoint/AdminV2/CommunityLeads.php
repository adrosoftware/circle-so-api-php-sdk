<?php

declare(strict_types=1);

namespace AdroSoftware\CircleSoSdk\Endpoint\AdminV2;

use AdroSoftware\CircleSoSdk\Endpoint\AbstractEndpoint;
use AdroSoftware\CircleSoSdk\Endpoint\EndpointInterface;

final class CommunityLeads extends AbstractEndpoint implements EndpointInterface
{
    /** Create a non-member contact (lead). To add a full community member instead, use create_community_member. */
    /** @param array<string, mixed> $data */
    public function createLead(array $data): mixed
    {
        return $this->request('POST', "/community_leads", [], $data);
    }

    /** Delete a non-member contact (lead). To delete a full community member instead, use destroy_community_member. */
    public function deleteLead(int|string $id): mixed
    {
        return $this->request('DELETE', "/community_leads/{$id}");
    }
}
