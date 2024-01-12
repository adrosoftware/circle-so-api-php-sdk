<?php

declare(strict_types=1);

namespace AdroSoftware\CircleSoSdk\Endpoint\Community;

use AdroSoftware\CircleSoSdk\Endpoint\AbstractEndpoint;
use AdroSoftware\CircleSoSdk\Endpoint\EndpointInterface;

final class Communities extends AbstractEndpoint implements EndpointInterface
{
    public function all(): mixed
    {
        return $this->factorResponse(
            $this->circleSo->getHttpClient()->get('/communities')
        );
    }

    public function community(string $slug, ?int $communityId = null): mixed
    {
        $this->ensureCommunityIdIsPresent($communityId);

        return $this->factorResponse(
            response: $this->circleSo->getHttpClient()->get('/communities'),
            throwNotFoundException: true,
        );
    }
}
