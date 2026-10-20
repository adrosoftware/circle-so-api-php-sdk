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
        return $this->request('GET', '/space_groups', $this->communityQuery($communityId));
    }

    /**
     * @throws CommunityIdNotPresentException
     * @throws UnsuccessfulResponseException
     */
    public function show(int $id, ?int $communityId = null): mixed
    {
        return $this->request('GET', "/space_groups/{$id}", $this->communityQuery($communityId));
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
        return $this->request('POST', '/space_groups', $this->communityQuery($communityId), $data);
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
        return $this->request('PUT', "/space_groups/{$id}", $this->communityQuery($communityId), $data);
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
        return $this->request('DELETE', "/space_groups/{$id}", $this->communityQuery($communityId));
    }
}
