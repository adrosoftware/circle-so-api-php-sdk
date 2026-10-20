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
        $query = [
            ...$this->communityQuery($communityId),
            'sort' => $sortBy ?? 'latest',
            'per_page' => $perPage ?? 10,
            'page' => $page ?? 1,
            'status' => $status ?? 'active',
        ];

        return $this->request('GET', '/community_members', $query);
    }

    /**
     * @throws CommunityIdNotPresentException
     */
    public function search(string $email, ?int $communityId = null): mixed
    {
        return $this->request('GET', '/community_members/search', [
            ...$this->communityQuery($communityId),
            'email' => $email,
        ]);
    }

    /**
     * @throws CommunityIdNotPresentException
     * @throws UnsuccessfulResponseException
     */
    public function member(int $id, ?int $communityId = null): mixed
    {
        return $this->request('GET', "/community_members/{$id}", $this->communityQuery($communityId));
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
        $params = [
            ...$this->communityQuery($communityId),
        ];

        if (is_array($spaceIds)) {
            $params['space_ids'] = '[' . implode(',', $spaceIds) . ']';
        }

        if (is_array($spaceGroupIds)) {
            $params['space_group_ids'] = '[' . implode(',', $spaceGroupIds) . ']';
        }

        $params['skip_invitation'] = $skipInvitation;

        return $this->request('PUT', "/community_members/{$id}", $params, $data);
    }

    /**
     * Remove Member from Community
     */
    public function remove(string $email, ?int $communityId = null): mixed
    {
        return $this->request('DELETE', '/community_members', [
            ...$this->communityQuery($communityId),
            'email' => $email,
        ]);
    }

    /**
     * Invite Member to Community
     */
    public function invite(string $email, ?int $communityId = null): mixed
    {
        $data = [
            'email' => $email,
        ];

        if ($communityId !== null || $this->communityId !== null) {
            $data['community_id'] = $this->communityQuery($communityId)['community_id'];
        }

        return $this->request('POST', '/community_members', data: $data);
    }
}
