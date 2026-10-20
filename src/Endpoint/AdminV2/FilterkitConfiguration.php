<?php

declare(strict_types=1);

namespace AdroSoftware\CircleSoSdk\Endpoint\AdminV2;

use AdroSoftware\CircleSoSdk\Endpoint\AbstractEndpoint;
use AdroSoftware\CircleSoSdk\Endpoint\EndpointInterface;

final class FilterkitConfiguration extends AbstractEndpoint implements EndpointInterface
{
    /** Get the filters currently shown on the member directory or a member space */
    /** @param array<string, mixed> $query */
    public function getTheFiltersCurrentlyShownOnTheMemberDirectoryOrAMemberSpace(array $query = []): mixed
    {
        return $this->request('GET', "/filter_kit_configuration", $query);
    }
}
