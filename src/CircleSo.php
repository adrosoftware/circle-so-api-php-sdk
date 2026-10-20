<?php

declare(strict_types=1);

namespace AdroSoftware\CircleSoSdk;

use AdroSoftware\CircleSoSdk\Contracts\InteractsWithEndpoints;
use AdroSoftware\CircleSoSdk\Endpoint\{
    Charge\Charges,
    Comment\Comments,
    CommunityMemberSpace\CommunityMemberSpaces,
    Community\Communities,
    Contact\Contacts,
    Course\Courses,
    Event\Events,
    EventAttendee\EventAttendees,
    FlaggedContent\FlaggedContents,
    Like\Likes,
    Me\Me,
    Member\Members,
    MemberTag\MemberTag,
    Message\Messages,
    Notification\Notifications,
    Post\Posts,
    ProfileField\ProfileFields,
    Space\Spaces,
    SpaceGroup\SpaceGroups,
    SpaceGroupMember\SpaceGroupMembers,
    SpaceMember\SpaceMembers,
    Subscription\Subscriptions,
    TaggedMembers\TaggedMembers,
    Topic\Topics,
};

final class CircleSo extends AbstractClient implements InteractsWithEndpoints
{
    public static function make(
        string $token,
        ?Options $options = null,
    ): static {
        return new static($token, $options);
    }

    public function me(): Me
    {
        return new Me($this);
    }

    public function communities(): Communities
    {
        return new Communities($this);
    }

    public function courses(): Courses
    {
        return new Courses($this);
    }

    public function members(): Members
    {
        return new Members($this);
    }

    public function memberTags(): MemberTag
    {
        return new MemberTag($this);
    }

    public function spaces(): Spaces
    {
        return new Spaces($this);
    }

    public function spaceGroups(): SpaceGroups
    {
        return new SpaceGroups($this);
    }

    public function taggedMembers(): TaggedMembers
    {
        return new TaggedMembers($this);
    }

    public function spaceGroupMembers(): SpaceGroupMembers
    {
        return new SpaceGroupMembers($this);
    }

    public function spaceMembers(): SpaceMembers
    {
        return new SpaceMembers($this);
    }

    public function posts(): Posts
    {
        return new Posts($this);
    }

    public function comments(): Comments
    {
        return new Comments($this);
    }

    public function messages(): Messages
    {
        return new Messages($this);
    }

    public function subscriptions(): Subscriptions
    {
        return new Subscriptions($this);
    }

    public function events(): Events
    {
        return new Events($this);
    }

    public function eventAttendees(): EventAttendees
    {
        return new EventAttendees($this);
    }

    public function charges(): Charges
    {
        return new Charges($this);
    }

    public function likes(): Likes
    {
        return new Likes($this);
    }

    public function communityMemberSpaces(): CommunityMemberSpaces
    {
        return new CommunityMemberSpaces($this);
    }

    public function profileFields(): ProfileFields
    {
        return new ProfileFields($this);
    }

    public function notifications(): Notifications
    {
        return new Notifications($this);
    }

    public function topics(): Topics
    {
        return new Topics($this);
    }

    public function contacts(): Contacts
    {
        return new Contacts($this);
    }

    public function flaggedContents(): FlaggedContents
    {
        return new FlaggedContents($this);
    }

}
