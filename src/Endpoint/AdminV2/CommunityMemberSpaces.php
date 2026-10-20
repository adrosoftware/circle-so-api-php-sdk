<?php

declare(strict_types=1);

namespace AdroSoftware\CircleSoSdk\Endpoint\AdminV2;

use AdroSoftware\CircleSoSdk\Endpoint\AbstractEndpoint;
use AdroSoftware\CircleSoSdk\Endpoint\EndpointInterface;

final class CommunityMemberSpaces extends AbstractEndpoint implements EndpointInterface
{
    /** List Community Member Spaces */
    /** @param array<string, mixed> $query */
    public function listCommunityMemberSpaces(array $query = []): mixed
    {
        return $this->request('GET', "/community_member_spaces", $query);
    }
}
