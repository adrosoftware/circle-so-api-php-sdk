<?php

declare(strict_types=1);

namespace AdroSoftware\CircleSoSdk\Endpoint\HeadlessMember;

use AdroSoftware\CircleSoSdk\Endpoint\AbstractEndpoint;
use AdroSoftware\CircleSoSdk\Endpoint\EndpointInterface;

final class HomePage extends AbstractEndpoint implements EndpointInterface
{
    /** Get home page posts */
    /** @param array<string, mixed> $query */
    public function getHomePagePosts(array $query = []): mixed
    {
        return $this->request('GET', "/home", $query);
    }
}
