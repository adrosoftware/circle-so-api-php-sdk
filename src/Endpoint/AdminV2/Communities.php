<?php

declare(strict_types=1);

namespace AdroSoftware\CircleSoSdk\Endpoint\AdminV2;

use AdroSoftware\CircleSoSdk\Endpoint\AbstractEndpoint;
use AdroSoftware\CircleSoSdk\Endpoint\EndpointInterface;

final class Communities extends AbstractEndpoint implements EndpointInterface
{
    public function show(): mixed
    {
        return $this->getCommunityDetails();
    }

    /** @param array<string, mixed> $data */
    public function update(array $data): mixed
    {
        return $this->updateCommunity($data);
    }

    /** Get community details */
    public function getCommunityDetails(): mixed
    {
        return $this->request('GET', "/community");
    }

    /** Update Community */
    /** @param array<string, mixed> $data */
    public function updateCommunity(array $data = []): mixed
    {
        return $this->request('PUT', "/community", [], $data);
    }
}
