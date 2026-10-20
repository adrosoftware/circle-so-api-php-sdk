<?php

declare(strict_types=1);

namespace AdroSoftware\CircleSoSdk\Endpoint\AdminV2;

use AdroSoftware\CircleSoSdk\Endpoint\AbstractEndpoint;
use AdroSoftware\CircleSoSdk\Endpoint\EndpointInterface;

final class AdvancedSearch extends AbstractEndpoint implements EndpointInterface
{
    /** Advanced Search */
    /** @param array<string, mixed> $query */
    public function advancedSearch(array $query = []): mixed
    {
        return $this->request('GET', "/advanced_search", $query);
    }
}
