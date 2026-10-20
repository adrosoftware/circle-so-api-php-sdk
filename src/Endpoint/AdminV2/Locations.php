<?php

declare(strict_types=1);

namespace AdroSoftware\CircleSoSdk\Endpoint\AdminV2;

use AdroSoftware\CircleSoSdk\Endpoint\AbstractEndpoint;
use AdroSoftware\CircleSoSdk\Endpoint\EndpointInterface;

final class Locations extends AbstractEndpoint implements EndpointInterface
{
    /** Search locations */
    /** @param array<string, mixed> $query */
    public function searchLocations(array $query = []): mixed
    {
        return $this->request('GET', "/locations/search", $query);
    }
}
