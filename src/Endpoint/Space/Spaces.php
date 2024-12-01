<?php

declare(strict_types=1);

namespace AdroSoftware\CircleSoSdk\Endpoint\Space;

use AdroSoftware\CircleSoSdk\Endpoint\AbstractEndpoint;
use AdroSoftware\CircleSoSdk\Endpoint\EndpointInterface;
use AdroSoftware\CircleSoSdk\Exception\{
    CommunityIdNotPresentException,
    UnsuccessfulResponseException,
};

class Spaces extends AbstractEndpoint implements EndpointInterface
{
    /**
     * @throws CommunityIdNotPresentException
     */
    public function spaces(?int $communityId = null): mixed
    {
        $this->ensureCommunityIdIsPresent($communityId);

        return $this->factorResponse(
            $this->circleSo->getHttpClient()->get(
                "/spaces?community_id={$this->communityId}"
            )
        );
    }

    /**
     * @throws CommunityIdNotPresentException
     * @throws UnsuccessfulResponseException
     */
    public function show(int $id, ?int $communityId = null): mixed
    {
        $this->ensureCommunityIdIsPresent($communityId);

        return $this->factorResponse(
            $this->circleSo->getHttpClient()->get(
                "/spaces/{$id}?community_id={$this->communityId}"
            )
        );
    }

    /**
     * Create a space.
     *
     * The following json example should demonstrate
     * what the `$data` array should look like:
     * ```json
     * {
     *     "name": "Awesome Space",
     *     "is_private": true,
     *     "is_hidden_from_non_members": false,
     *     "is_hidden": true,
     *     "slug": "awesome-space",
     *     "space_group_id": 1,
     *     "topics": [],
     * }
     * ```
     * @throws CommunityIdNotPresentException
     * @throws UnsuccessfulResponseException
     */
    public function create(
        array $data,
        ?int $communityId = null,
    ): mixed {
        $this->ensureCommunityIdIsPresent($communityId);

        return $this->factorResponse(
            $this->circleSo->getHttpClient()->post(
                uri: "/spaces?community_id={$this->communityId}",
                body: json_encode($data),
            )
        );
    }

    /**
     * Delete a space.
     *
     * @throws CommunityIdNotPresentException
     * @throws UnsuccessfulResponseException
     */
    public function delete(
        int $id,
        ?int $communityId = null,
    ): mixed {
        $this->ensureCommunityIdIsPresent($communityId);

        return $this->factorResponse(
            $this->circleSo->getHttpClient()->delete(
                "/spaces/{$id}?community_id={$this->communityId}",
            )
        );
    }

    public function members(
        int $id,
        ?int $communityId = null
    ): mixed {
        $this->ensureCommunityIdIsPresent($communityId);

        return $this->factorResponse(
            $this->circleSo->getHttpClient()->delete(
                "/space_members/{$id}?space_id={$id}&community_id={$this->communityId}",
            )
        );
    }
}
