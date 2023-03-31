<?php

declare(strict_types=1);

namespace AdroSoftware\CircleSoSdk\Endpoint\Member;

use AdroSoftware\CircleSoSdk\Endpoint\AbstractEndpoint;
use AdroSoftware\CircleSoSdk\Endpoint\EndpointInterface;

final class Members extends AbstractEndpoint implements EndpointInterface
{
    public function search(string $email, ?int $communityId = null): array
    {
        $this->ensureCommunityIdIsPresent($communityId);

        return $this->factorResponse(
            $this->circleSo->getHttpClient()->get(
                "/community_members/search?community_id={$this->communityId}&email={$email}"
            )
        );
    }

    public function show(int $id, ?int $communityId = null): array
    {
        $this->ensureCommunityIdIsPresent($communityId);

        return $this->factorResponse(
            $this->circleSo->getHttpClient()->get(
                "/community_members/{$id}?community_id={$this->communityId}"
            )
        );
    }
}
