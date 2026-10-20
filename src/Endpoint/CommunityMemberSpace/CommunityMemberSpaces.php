<?php

declare(strict_types=1);

namespace AdroSoftware\CircleSoSdk\Endpoint\CommunityMemberSpace;

use AdroSoftware\CircleSoSdk\Endpoint\AbstractEndpoint;
use AdroSoftware\CircleSoSdk\Endpoint\EndpointInterface;

final class CommunityMemberSpaces extends AbstractEndpoint implements EndpointInterface
{
    public function all(string $userEmail): mixed
    {
        return $this->request('GET', '/community_member_spaces', ['user_email' => $userEmail]);
    }
}
