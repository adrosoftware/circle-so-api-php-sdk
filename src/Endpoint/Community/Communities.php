<?php

declare(strict_types=1);

namespace AdroSoftware\CircleSoSdk\Endpoint\Community;

use AdroSoftware\CircleSoSdk\Endpoint\AbstractEndpoint;
use AdroSoftware\CircleSoSdk\Endpoint\EndpointInterface;

final class Communities extends AbstractEndpoint implements EndpointInterface
{
    public function all(): mixed
    {
        return $this->request('GET', '/communities');
    }

    public function community(string $slug, ?int $communityId = null): mixed
    {
        return $this->request(
            'GET',
            "/communities/{$this->communityQuery($communityId)['community_id']}",
            ['slug' => $slug],
            throwNotFoundException: true,
        );
    }
}
