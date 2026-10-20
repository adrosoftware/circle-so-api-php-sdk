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
    public function spaces(
        ?int $communityId = null,
        ?string $sort = null,
        ?int $perPage = null,
        ?int $page = null,
    ): mixed {
        return $this->request('GET', '/spaces', [
            ...$this->communityQuery($communityId),
            'sort' => $sort,
            'per_page' => $perPage,
            'page' => $page,
        ]);
    }

    /**
     * @throws CommunityIdNotPresentException
     * @throws UnsuccessfulResponseException
     */
    public function show(int $id, ?int $communityId = null): mixed
    {
        return $this->request('GET', "/spaces/{$id}", $this->communityQuery($communityId));
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
        return $this->request('POST', '/spaces', $this->communityQuery($communityId), $data);
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
        return $this->request('DELETE', "/spaces/{$id}", $this->communityQuery($communityId));
    }

    public function members(
        int $id,
        ?int $communityId = null
    ): mixed {
        return $this->request('GET', '/space_members', [
            ...$this->communityQuery($communityId),
            'space_id' => $id,
        ]);
    }
}
