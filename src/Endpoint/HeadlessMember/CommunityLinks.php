<?php

declare(strict_types=1);

namespace AdroSoftware\CircleSoSdk\Endpoint\HeadlessMember;

use AdroSoftware\CircleSoSdk\Endpoint\AbstractEndpoint;
use AdroSoftware\CircleSoSdk\Endpoint\EndpointInterface;

final class CommunityLinks extends AbstractEndpoint implements EndpointInterface
{
    /** Get list of community links */
    public function getListOfCommunityLinks(): mixed
    {
        return $this->request('GET', "/community_links");
    }
}
