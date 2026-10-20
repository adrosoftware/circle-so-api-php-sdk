<?php

declare(strict_types=1);

namespace AdroSoftware\CircleSoSdk\Endpoint\FlaggedContent;

use AdroSoftware\CircleSoSdk\Endpoint\AbstractEndpoint;
use AdroSoftware\CircleSoSdk\Endpoint\EndpointInterface;

final class FlaggedContents extends AbstractEndpoint implements EndpointInterface
{
    public function all(
        ?int $communityId = null,
        ?int $perPage = null,
        ?int $page = null,
        ?string $status = null,
    ): mixed {
        return $this->request('GET', '/flagged_contents', [
            ...$this->communityQuery($communityId),
            'per_page' => $perPage,
            'page' => $page,
            'status' => $status,
        ]);
    }
}
