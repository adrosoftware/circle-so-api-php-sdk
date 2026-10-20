<?php

declare(strict_types=1);

namespace AdroSoftware\CircleSoSdk\Endpoint\AdminV2;

use AdroSoftware\CircleSoSdk\Endpoint\AbstractEndpoint;
use AdroSoftware\CircleSoSdk\Endpoint\EndpointInterface;

final class Gamification extends AbstractEndpoint implements EndpointInterface
{
    /** Show Leaderboard */
    /** @param array<string, mixed> $query */
    public function showLeaderboard(array $query = []): mixed
    {
        return $this->request('GET', "/gamification/leaderboard", $query);
    }
}
