<?php

declare(strict_types=1);

namespace AdroSoftware\CircleSoSdk\Endpoint\HeadlessMember;

use AdroSoftware\CircleSoSdk\Endpoint\AbstractEndpoint;
use AdroSoftware\CircleSoSdk\Endpoint\EndpointInterface;

final class PageProfileFields extends AbstractEndpoint implements EndpointInterface
{
    /** Get Page Profile Fields */
    /** @param array<string, mixed> $query */
    public function getPageProfileFields(array $query = []): mixed
    {
        return $this->request('GET', "/page_profile_fields", $query);
    }
}
