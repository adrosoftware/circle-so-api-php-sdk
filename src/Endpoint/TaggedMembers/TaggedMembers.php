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
    /**
     * @throws CommunityIdNotPresentException
     */
    public function tagMember(string $email, int $memberTagId): mixed
    {
        return $this->factorResponse(
            $this->circleSo->getHttpClient()->post(
                "/tagged_members?user_email={$email}&member_tag_id={$memberTagId}"
            )
        );
    }
}
