<?php

declare(strict_types=1);

namespace AdroSoftware\CircleSoSdk\Endpoint\Member;

use AdroSoftware\CircleSoSdk\Endpoint\AbstractEndpoint;
use AdroSoftware\CircleSoSdk\Endpoint\EndpointInterface;
use AdroSoftware\CircleSoSdk\Exception\{
    CommunityIdNotPresentException,
    UnsuccessfulResponseException,
};

final class Members extends AbstractEndpoint implements EndpointInterface
{
    public function communityMembers(
        ?int $communityId = null,
        ?string $sortBy = null,
        ?int $perPage = null,
        ?int $page = null,
        ?string $status = null,
    ): mixed {
        $this->ensureCommunityIdIsPresent($communityId);

        $query = [
            'sort' => $sortBy ?? 'latest',
            'per_page' => $perPage ?? 10,
            'page' => $page ?? 1,
            'status' => $status ?? 'active',
        ];

        return $this->factorResponse(
            $this->circleSo->getHttpClient()->get(
                "/community_members?" . http_build_query($query)
            )
        );
    }

    /**
     * @throws CommunityIdNotPresentException
     */
    public function search(string $email, ?int $communityId = null): mixed
    {
        $this->ensureCommunityIdIsPresent($communityId);

        return $this->factorResponse(
            $this->circleSo->getHttpClient()->get(
                "/community_members/search?community_id={$this->communityId}&email={$email}"
            )
        );
    }

    /**
     * @throws CommunityIdNotPresentException
     * @throws UnsuccessfulResponseException
     */
    public function member(int $id, ?int $communityId = null): mixed
    {
        $this->ensureCommunityIdIsPresent($communityId);

        return $this->factorResponse(
            $this->circleSo->getHttpClient()->get(
                "/community_members/{$id}?community_id={$this->communityId}"
            )
        );
    }

    /**
     * Update a member data.
     *
     * The following json example should demonstrate
     * what the `$data` array should look like:
     * ```json
     * {
     *     "name": "John1 Doe1",
     *     "bio": "Runner",
     *     "headline": "World Class Athlete",
     *     "facebook_url": "https://facebook.com/username",
     *     "instagram_url": "https://instagram.com/username",
     *     "twitter_url": "https://twitter.com/username",
     *     "linkedin_url": "https://linkedin.com/username",
     *     "website_url": "https://my-blog.com/website",
     *     "avatar": "http://imgur.com/4j34h3h3.jpg",
     *     "is_flagged": true,
     *     "preferences": {
     *         "messaging_enabled_by_admin": false
     *     },
     *     "location": "New York",
     *     "community_member_profile_fields": {
     *         "nickname": "MyNickname",
     *         "your_business_description": "My bussiness is focused on enterprise customers...",
     *         "favourite_colors": [1, 2, 3],
     *         "best_country_to_live": 1
     *     }
     * }
     * ```
     * @throws CommunityIdNotPresentException
     * @throws UnsuccessfulResponseException
     */
    public function update(
        int $id,
        array $data,
        ?int $communityId = null,
        ?array $spaceIds = null,
        ?array $spaceGroupIds = null,
        ?bool $skipInvitation = null,
    ): mixed {
        $this->ensureCommunityIdIsPresent($communityId);

        $params = [
            'community_id' => $this->communityId,
        ];

        if (is_array($spaceIds)) {
            $params['space_ids'] = '[' . implode(',', $spaceIds) . ']';
        }

        if (is_array($spaceGroupIds)) {
            $params['space_group_ids'] = '[' . implode(',', $spaceGroupIds) . ']';
        }

        if ($skipInvitation) {
            $params['skip_invitation'] = 'true';
        }

        $endpoint =  "/community_members/{$id}?" . urldecode(http_build_query($params));

        return $this->factorResponse(
            $this->circleSo->getHttpClient()->put(
                uri: $endpoint,
                body: json_encode($data),
            )
        );
    }

    /**
     * Remove Member from Community
     */
    public function remove(string $email, ?int $communityId = null): mixed
    {
        $this->ensureCommunityIdIsPresent($communityId);

        return $this->factorResponse(
            $this->circleSo->getHttpClient()->delete(
                "/community_members?community_id={$this->communityId}&email={$email}"
            )
        );
    }

    /**
     * Invite Member to Community
     */
    public function invite(string $email, ?int $communityId = null): mixed {
        
        $endpoint =  "/community_members/";

        $data = [
            'email' => $email,
        ];

        if (!empty($communityId)) {
            $this->ensureCommunityIdIsPresent($communityId);
            $data['community_id'] = $communityId;
        }

        return $this->factorResponse(
            $this->circleSo->getHttpClient()->post(
                uri: $endpoint,
                body: json_encode($data),
            )
        );
    }
}
