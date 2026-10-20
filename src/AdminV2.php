<?php

declare(strict_types=1);

namespace AdroSoftware\CircleSoSdk;

use AdroSoftware\CircleSoSdk\Endpoint\RawEndpoint;

final class AdminV2 extends AbstractClient
{
    public function __construct(string $token, ?Options $options = null)
    {
        parent::__construct($token, ($options ?? new Options())->withApiVersion('admin/v2'));
    }

    public static function make(string $token, ?Options $options = null): self
    {
        return new self($token, $options);
    }

    public function accessGroupMembers(): Endpoint\AdminV2\AccessGroupMembers
    {
        return new Endpoint\AdminV2\AccessGroupMembers($this);
    }

    public function accessGroups(): Endpoint\AdminV2\AccessGroups
    {
        return new Endpoint\AdminV2\AccessGroups($this);
    }

    public function advancedSearch(): Endpoint\AdminV2\AdvancedSearch
    {
        return new Endpoint\AdminV2\AdvancedSearch($this);
    }

    public function chatPreferences(): Endpoint\AdminV2\ChatPreferences
    {
        return new Endpoint\AdminV2\ChatPreferences($this);
    }

    public function chatRoomMessageImports(): Endpoint\AdminV2\ChatRoomMessageImports
    {
        return new Endpoint\AdminV2\ChatRoomMessageImports($this);
    }

    public function comments(): Endpoint\AdminV2\Comments
    {
        return new Endpoint\AdminV2\Comments($this);
    }

    public function communities(): Endpoint\AdminV2\Communities
    {
        return new Endpoint\AdminV2\Communities($this);
    }

    public function communityLeads(): Endpoint\AdminV2\CommunityLeads
    {
        return new Endpoint\AdminV2\CommunityLeads($this);
    }

    public function communityMemberAccessGroups(): Endpoint\AdminV2\CommunityMemberAccessGroups
    {
        return new Endpoint\AdminV2\CommunityMemberAccessGroups($this);
    }

    public function communityMemberCharges(): Endpoint\AdminV2\CommunityMemberCharges
    {
        return new Endpoint\AdminV2\CommunityMemberCharges($this);
    }

    public function communityMemberSpaces(): Endpoint\AdminV2\CommunityMemberSpaces
    {
        return new Endpoint\AdminV2\CommunityMemberSpaces($this);
    }

    public function communityMemberSubscriptions(): Endpoint\AdminV2\CommunityMemberSubscriptions
    {
        return new Endpoint\AdminV2\CommunityMemberSubscriptions($this);
    }

    public function communityMembers(): Endpoint\AdminV2\CommunityMembers
    {
        return new Endpoint\AdminV2\CommunityMembers($this);
    }

    public function communitySegments(): Endpoint\AdminV2\CommunitySegments
    {
        return new Endpoint\AdminV2\CommunitySegments($this);
    }

    public function connectSettings(): Endpoint\AdminV2\ConnectSettings
    {
        return new Endpoint\AdminV2\ConnectSettings($this);
    }

    public function contactNotes(): Endpoint\AdminV2\ContactNotes
    {
        return new Endpoint\AdminV2\ContactNotes($this);
    }

    public function courseLessonProgress(): Endpoint\AdminV2\CourseLessonProgress
    {
        return new Endpoint\AdminV2\CourseLessonProgress($this);
    }

    public function courseLessons(): Endpoint\AdminV2\CourseLessons
    {
        return new Endpoint\AdminV2\CourseLessons($this);
    }

    public function courseSections(): Endpoint\AdminV2\CourseSections
    {
        return new Endpoint\AdminV2\CourseSections($this);
    }

    public function directUploads(): Endpoint\AdminV2\DirectUploads
    {
        return new Endpoint\AdminV2\DirectUploads($this);
    }

    public function embeds(): Endpoint\AdminV2\Embeds
    {
        return new Endpoint\AdminV2\Embeds($this);
    }

    public function eventAttendees(): Endpoint\AdminV2\EventAttendees
    {
        return new Endpoint\AdminV2\EventAttendees($this);
    }

    public function events(): Endpoint\AdminV2\Events
    {
        return new Endpoint\AdminV2\Events($this);
    }

    public function filterKitControls(): Endpoint\AdminV2\FilterKitControls
    {
        return new Endpoint\AdminV2\FilterKitControls($this);
    }

    public function filterkitConfiguration(): Endpoint\AdminV2\FilterkitConfiguration
    {
        return new Endpoint\AdminV2\FilterkitConfiguration($this);
    }

    public function flaggedContents(): Endpoint\AdminV2\FlaggedContents
    {
        return new Endpoint\AdminV2\FlaggedContents($this);
    }

    public function forms(): Endpoint\AdminV2\Forms
    {
        return new Endpoint\AdminV2\Forms($this);
    }

    public function gamification(): Endpoint\AdminV2\Gamification
    {
        return new Endpoint\AdminV2\Gamification($this);
    }

    public function invitationLinks(): Endpoint\AdminV2\InvitationLinks
    {
        return new Endpoint\AdminV2\InvitationLinks($this);
    }

    public function live(): Endpoint\AdminV2\Live
    {
        return new Endpoint\AdminV2\Live($this);
    }

    public function locations(): Endpoint\AdminV2\Locations
    {
        return new Endpoint\AdminV2\Locations($this);
    }

    public function memberTags(): Endpoint\AdminV2\MemberTags
    {
        return new Endpoint\AdminV2\MemberTags($this);
    }

    public function messages(): Endpoint\AdminV2\Messages
    {
        return new Endpoint\AdminV2\Messages($this);
    }

    public function pageProfileFields(): Endpoint\AdminV2\PageProfileFields
    {
        return new Endpoint\AdminV2\PageProfileFields($this);
    }

    public function paymentMethodSettings(): Endpoint\AdminV2\PaymentMethodSettings
    {
        return new Endpoint\AdminV2\PaymentMethodSettings($this);
    }

    public function paywallAffiliatePayouts(): Endpoint\AdminV2\PaywallAffiliatePayouts
    {
        return new Endpoint\AdminV2\PaywallAffiliatePayouts($this);
    }

    public function paywallAffiliates(): Endpoint\AdminV2\PaywallAffiliates
    {
        return new Endpoint\AdminV2\PaywallAffiliates($this);
    }

    public function paywallCoupons(): Endpoint\AdminV2\PaywallCoupons
    {
        return new Endpoint\AdminV2\PaywallCoupons($this);
    }

    public function paywallGroups(): Endpoint\AdminV2\PaywallGroups
    {
        return new Endpoint\AdminV2\PaywallGroups($this);
    }

    public function paywalls(): Endpoint\AdminV2\Paywalls
    {
        return new Endpoint\AdminV2\Paywalls($this);
    }

    public function postFollowers(): Endpoint\AdminV2\PostFollowers
    {
        return new Endpoint\AdminV2\PostFollowers($this);
    }

    public function posts(): Endpoint\AdminV2\Posts
    {
        return new Endpoint\AdminV2\Posts($this);
    }

    public function profileFields(): Endpoint\AdminV2\ProfileFields
    {
        return new Endpoint\AdminV2\ProfileFields($this);
    }

    public function spaceGroupMembers(): Endpoint\AdminV2\SpaceGroupMembers
    {
        return new Endpoint\AdminV2\SpaceGroupMembers($this);
    }

    public function spaceGroups(): Endpoint\AdminV2\SpaceGroups
    {
        return new Endpoint\AdminV2\SpaceGroups($this);
    }

    public function spaceMembers(): Endpoint\AdminV2\SpaceMembers
    {
        return new Endpoint\AdminV2\SpaceMembers($this);
    }

    public function spaces(): Endpoint\AdminV2\Spaces
    {
        return new Endpoint\AdminV2\Spaces($this);
    }

    public function taggedMembers(): Endpoint\AdminV2\TaggedMembers
    {
        return new Endpoint\AdminV2\TaggedMembers($this);
    }

    public function taxSettings(): Endpoint\AdminV2\TaxSettings
    {
        return new Endpoint\AdminV2\TaxSettings($this);
    }

    public function topics(): Endpoint\AdminV2\Topics
    {
        return new Endpoint\AdminV2\Topics($this);
    }

    public function workflows(): Endpoint\AdminV2\Workflows
    {
        return new Endpoint\AdminV2\Workflows($this);
    }

    public function raw(): RawEndpoint
    {
        return new RawEndpoint($this);
    }
}
