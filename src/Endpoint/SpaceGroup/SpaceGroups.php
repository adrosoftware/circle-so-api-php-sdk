<?php

declare(strict_types=1);

namespace AdroSoftware\CircleSoSdk\Endpoint\SpaceGroup;

use AdroSoftware\CircleSoSdk\Endpoint\AbstractEndpoint;
use AdroSoftware\CircleSoSdk\Endpoint\EndpointInterface;
use AdroSoftware\CircleSoSdk\Exception\{
    CommunityIdNotPresentException,
    UnsuccessfulResponseException,
};

class SpaceGroups extends AbstractEndpoint implements EndpointInterface
{
    /**
     * @throws CommunityIdNotPresentException
     */
    public function spaceGroups(?int $communityId = null): mixed
    {
        $this->ensureCommunityIdIsPresent($communityId);

        return $this->factorResponse(
            $this->circleSo->getHttpClient()->get(
                "/space_groups?community_id={$this->communityId}"
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
                "/space_groups/{$id}?community_id={$this->communityId}"
            )
        );
    }

    /**
     * Create a space group.
     *
     * The following json example should demonstrate
     * what the `$data` array should look like:
     * ```json
     * {
     *     "name": "Awesome Space Group",
     *     "slug": "awesome-space-group",
     *     "add_members_to_space_group_on_space_join": false,
     *     "allow_members_to_create_spaces": true,
     *     "automatically_add_members_to_new_spaces": false,
     *     "hide_non_member_spaces_from_sidebar": true,
     *     "is_hidden_from_non_members": false,
     *     "space_order_array": [],
     *     "position": 1
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
                uri: "/space_groups?community_id={$this->communityId}",
                body: json_encode($data),
            )
        );
    }

    /**
     * Update a space group.
     *
     * The following json example should demonstrate
     * what the `$data` array should look like:
     * ```json
     * {
     *     "name": "Awesome Space Group",
     *     "slug": "awesome-space-group",
     *     "add_members_to_space_group_on_space_join": false,
     *     "allow_members_to_create_spaces": true,
     *     "automatically_add_members_to_new_spaces": false,
     *     "hide_non_member_spaces_from_sidebar": true,
     *     "is_hidden_from_non_members": false,
     * }
     * ```
     * @throws CommunityIdNotPresentException
     * @throws UnsuccessfulResponseException
     */
    public function update(
        int $id,
        array $data,
        ?int $communityId = null,
    ): mixed {
        $this->ensureCommunityIdIsPresent($communityId);

        return $this->factorResponse(
            $this->circleSo->getHttpClient()->put(
                uri: "/space_groups/{$id}?community_id={$this->communityId}",
                body: json_encode($data),
            )
        );
    }

    /**
     * Delete a space group.
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
                "/space_groups/{$id}?community_id={$this->communityId}",
            )
        );
    }
}
