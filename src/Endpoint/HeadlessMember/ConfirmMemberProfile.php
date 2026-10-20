<?php

declare(strict_types=1);

namespace AdroSoftware\CircleSoSdk\Endpoint\HeadlessMember;

use AdroSoftware\CircleSoSdk\Endpoint\AbstractEndpoint;
use AdroSoftware\CircleSoSdk\Endpoint\EndpointInterface;

final class ConfirmMemberProfile extends AbstractEndpoint implements EndpointInterface
{
    /** Update and confirm community member profile */
    /** @param array<string, mixed> $data */
    public function updateAndConfirmCommunityMemberProfile(array $data = []): mixed
    {
        return $this->request('PUT', "/signup/profile", [], $data);
    }
}
