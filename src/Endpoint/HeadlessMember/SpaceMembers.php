<?php

declare(strict_types=1);

namespace AdroSoftware\CircleSoSdk\Endpoint\HeadlessMember;

use AdroSoftware\CircleSoSdk\Endpoint\AbstractEndpoint;
use AdroSoftware\CircleSoSdk\Endpoint\EndpointInterface;

final class SpaceMembers extends AbstractEndpoint implements EndpointInterface
{
    /** Mark space member messages as read */
    public function markSpaceMemberMessagesAsRead(int|string $id): mixed
    {
        return $this->request('POST', "/space_members/{$id}/mark_as_read");
    }
}
