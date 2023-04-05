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
    public function tagMember(string|array $email, int $memberTagId): mixed
    {
        if (is_array($email)) {
            $emailParam = '';
            foreach ($email as $e) {
                $emailParam .= "user_email[]={$e}&";
            }

            $emailParam = trim($emailParam, '&');
        } else {
            $emailParam = "user_email={$email}";
        }

        return $this->factorResponse(
            $this->circleSo->getHttpClient()->post(
                "/tagged_members?{$emailParam}&member_tag_id={$memberTagId}"
            )
        );
    }

    /**
     * @throws CommunityIdNotPresentException
     */
    public function untagMember(string $email, int $memberTagId, ?int $communityId = null): mixed
    {
        $this->ensureCommunityIdIsPresent($communityId);

        return $this->factorResponse(
            $this->circleSo->getHttpClient()->delete(
                "/tagged_members?email={$email}&member_tag_id={$memberTagId}&community_id={$this->communityId}"
            )
        );
    }
}
