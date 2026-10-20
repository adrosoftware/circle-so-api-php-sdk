<?php

declare(strict_types=1);

namespace AdroSoftware\CircleSoSdk\Endpoint\MemberTag;

use AdroSoftware\CircleSoSdk\Endpoint\AbstractEndpoint;
use AdroSoftware\CircleSoSdk\Endpoint\EndpointInterface;
use AdroSoftware\CircleSoSdk\Exception\{
    CommunityIdNotPresentException,
    UnsuccessfulResponseException,
};

final class MemberTag extends AbstractEndpoint implements EndpointInterface
{
    /**
     * @throws CommunityIdNotPresentException
     */
    public function memberTags(?int $communityId = null): mixed
    {
        return $this->request('GET', '/member_tags', $this->communityQuery($communityId));
    }

    /**
     * @throws CommunityIdNotPresentException
     * @throws UnsuccessfulResponseException
     */
    public function show(int $id, ?int $communityId = null): mixed
    {
        return $this->request('GET', "/member_tags/{$id}", $this->communityQuery($communityId));
    }
}
