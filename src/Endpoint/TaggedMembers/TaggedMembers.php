<?php

declare(strict_types=1);

namespace AdroSoftware\CircleSoSdk\Endpoint\TaggedMembers;

use AdroSoftware\CircleSoSdk\Endpoint\AbstractEndpoint;
use AdroSoftware\CircleSoSdk\Endpoint\EndpointInterface;
use AdroSoftware\CircleSoSdk\Exception\{
    CommunityIdNotPresentException,
    UnsuccessfulResponseException,
};

final class TaggedMembers extends AbstractEndpoint implements EndpointInterface
{
    public function all(?string $sort = null, ?int $perPage = null, ?int $page = null): mixed
    {
        return $this->request('GET', '/tagged_members', [
            'sort' => $sort,
            'per_page' => $perPage,
            'page' => $page,
        ]);
    }

    public function show(int $id): mixed
    {
        return $this->request('GET', "/tagged_members/{$id}");
    }

    /**
     * @throws CommunityIdNotPresentException
     */
    public function tagMember(string|array $email, int $memberTagId): mixed
    {
        return $this->request('POST', '/tagged_members', [
            'user_email' => $email,
            'member_tag_id' => $memberTagId,
        ]);
    }

    /**
     * @throws CommunityIdNotPresentException
     */
    public function untagMember(string $email, int $memberTagId, ?int $communityId = null): mixed
    {
        return $this->request('DELETE', '/tagged_members', [
            'email' => $email,
            'member_tag_id' => $memberTagId,
            ...$this->communityQuery($communityId),
        ]);
    }
}
