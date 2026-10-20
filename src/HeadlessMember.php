<?php

declare(strict_types=1);

namespace AdroSoftware\CircleSoSdk;

use AdroSoftware\CircleSoSdk\Endpoint\RawEndpoint;

final class HeadlessMember extends AbstractClient
{
    public function __construct(string $accessToken, ?Options $options = null)
    {
        parent::__construct($accessToken, ($options ?? new Options())->withApiVersion('headless/v1'));
    }

    public static function make(string $accessToken, ?Options $options = null): self
    {
        return new self($accessToken, $options);
    }

    protected function authorizationHeader(): string
    {
        return "Bearer {$this->token}";
    }
    public function advancedSearch(): Endpoint\HeadlessMember\AdvancedSearch
    {
        return new Endpoint\HeadlessMember\AdvancedSearch($this);
    }

    public function bookmarks(): Endpoint\HeadlessMember\Bookmarks
    {
        return new Endpoint\HeadlessMember\Bookmarks($this);
    }

    public function chatRoom(): Endpoint\HeadlessMember\ChatRoom
    {
        return new Endpoint\HeadlessMember\ChatRoom($this);
    }

    public function chatThreads(): Endpoint\HeadlessMember\ChatThreads
    {
        return new Endpoint\HeadlessMember\ChatThreads($this);
    }

    public function comments(): Endpoint\HeadlessMember\Comments
    {
        return new Endpoint\HeadlessMember\Comments($this);
    }

    public function communityLinks(): Endpoint\HeadlessMember\CommunityLinks
    {
        return new Endpoint\HeadlessMember\CommunityLinks($this);
    }

    public function communityMembers(): Endpoint\HeadlessMember\CommunityMembers
    {
        return new Endpoint\HeadlessMember\CommunityMembers($this);
    }

    public function confirmMemberProfile(): Endpoint\HeadlessMember\ConfirmMemberProfile
    {
        return new Endpoint\HeadlessMember\ConfirmMemberProfile($this);
    }

    public function cookies(): Endpoint\HeadlessMember\Cookies
    {
        return new Endpoint\HeadlessMember\Cookies($this);
    }

    public function courses(): Endpoint\HeadlessMember\Courses
    {
        return new Endpoint\HeadlessMember\Courses($this);
    }

    public function directUploads(): Endpoint\HeadlessMember\DirectUploads
    {
        return new Endpoint\HeadlessMember\DirectUploads($this);
    }

    public function events(): Endpoint\HeadlessMember\Events
    {
        return new Endpoint\HeadlessMember\Events($this);
    }

    public function flaggedContents(): Endpoint\HeadlessMember\FlaggedContents
    {
        return new Endpoint\HeadlessMember\FlaggedContents($this);
    }

    public function homePage(): Endpoint\HeadlessMember\HomePage
    {
        return new Endpoint\HeadlessMember\HomePage($this);
    }

    public function invitationLinks(): Endpoint\HeadlessMember\InvitationLinks
    {
        return new Endpoint\HeadlessMember\InvitationLinks($this);
    }

    public function liveStreams(): Endpoint\HeadlessMember\LiveStreams
    {
        return new Endpoint\HeadlessMember\LiveStreams($this);
    }

    public function notificationPreferences(): Endpoint\HeadlessMember\NotificationPreferences
    {
        return new Endpoint\HeadlessMember\NotificationPreferences($this);
    }

    public function notifications(): Endpoint\HeadlessMember\Notifications
    {
        return new Endpoint\HeadlessMember\Notifications($this);
    }

    public function pageProfileFields(): Endpoint\HeadlessMember\PageProfileFields
    {
        return new Endpoint\HeadlessMember\PageProfileFields($this);
    }

    public function posts(): Endpoint\HeadlessMember\Posts
    {
        return new Endpoint\HeadlessMember\Posts($this);
    }

    public function quizzes(): Endpoint\HeadlessMember\Quizzes
    {
        return new Endpoint\HeadlessMember\Quizzes($this);
    }

    public function search(): Endpoint\HeadlessMember\Search
    {
        return new Endpoint\HeadlessMember\Search($this);
    }

    public function spaceMembers(): Endpoint\HeadlessMember\SpaceMembers
    {
        return new Endpoint\HeadlessMember\SpaceMembers($this);
    }

    public function spaces(): Endpoint\HeadlessMember\Spaces
    {
        return new Endpoint\HeadlessMember\Spaces($this);
    }

    public function raw(): RawEndpoint
    {
        return new RawEndpoint($this);
    }
}
