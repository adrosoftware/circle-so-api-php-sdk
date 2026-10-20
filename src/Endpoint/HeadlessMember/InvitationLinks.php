<?php

declare(strict_types=1);

namespace AdroSoftware\CircleSoSdk\Endpoint\HeadlessMember;

use AdroSoftware\CircleSoSdk\Endpoint\AbstractEndpoint;
use AdroSoftware\CircleSoSdk\Endpoint\EndpointInterface;

final class InvitationLinks extends AbstractEndpoint implements EndpointInterface
{
    /** Join community using invitation link */
    public function joinCommunityUsingInvitationLink(int|string $token): mixed
    {
        return $this->request('POST', "/invitation_links/{$token}/join");
    }
}
