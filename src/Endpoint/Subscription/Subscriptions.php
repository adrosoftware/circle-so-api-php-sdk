<?php

declare(strict_types=1);

namespace AdroSoftware\CircleSoSdk\Endpoint\Subscription;

use AdroSoftware\CircleSoSdk\Endpoint\AbstractEndpoint;
use AdroSoftware\CircleSoSdk\Endpoint\EndpointInterface;

final class Subscriptions extends AbstractEndpoint implements EndpointInterface
{
    public function all(?int $communityId = null, ?int $perPage = null, ?int $page = null): mixed
    {
        return $this->request('GET', '/community_member_subscriptions', [
            ...$this->communityQuery($communityId),
            'per_page' => $perPage,
            'page' => $page,
        ]);
    }
}
