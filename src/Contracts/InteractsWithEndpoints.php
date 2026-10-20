<?php

declare(strict_types=1);

namespace AdroSoftware\CircleSoSdk\Contracts;

use AdroSoftware\CircleSoSdk\Endpoint\{
    Charge\Charges,
    Comment\Comments,
    Community\Communities,
    CommunityMemberSpace\CommunityMemberSpaces,
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

interface InteractsWithEndpoints
{
    public function me(): Me;

    public function communities(): Communities;

    public function members(): Members;

    public function memberTags(): MemberTag;

    public function taggedMembers(): TaggedMembers;

    public function courses(): Courses;

    public function spaces(): Spaces;

    public function spaceGroups(): SpaceGroups;

    public function spaceGroupMembers(): SpaceGroupMembers;

    public function spaceMembers(): SpaceMembers;

    public function posts(): Posts;

    public function comments(): Comments;

    public function messages(): Messages;

    public function subscriptions(): Subscriptions;

    public function events(): Events;

    public function eventAttendees(): EventAttendees;

    public function charges(): Charges;

    public function likes(): Likes;

    public function communityMemberSpaces(): CommunityMemberSpaces;

    public function profileFields(): ProfileFields;

    public function notifications(): Notifications;

    public function topics(): Topics;

    public function contacts(): Contacts;

    public function flaggedContents(): FlaggedContents;

}
