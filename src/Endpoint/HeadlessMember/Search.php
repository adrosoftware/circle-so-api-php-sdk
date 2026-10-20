<?php

declare(strict_types=1);

namespace AdroSoftware\CircleSoSdk\Endpoint\HeadlessMember;

use AdroSoftware\CircleSoSdk\Endpoint\AbstractEndpoint;
use AdroSoftware\CircleSoSdk\Endpoint\EndpointInterface;

final class Search extends AbstractEndpoint implements EndpointInterface
{
    /** Search */
    /** @param array<string, mixed> $query */
    public function search(array $query = []): mixed
    {
        return $this->request('GET', "/search", $query);
    }
}
