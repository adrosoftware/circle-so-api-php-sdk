<?php

declare(strict_types=1);

namespace AdroSoftware\CircleSoSdk\Tests\Endpoint;

use AdroSoftware\CircleSoSdk\{AdminV2, ClientBuilder, HeadlessAuth, HeadlessMember, Options};
use AdroSoftware\CircleSoSdk\Response\FactoryInterface;
use AdroSoftware\CircleSoSdk\Tests\TestCase;
use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Middleware;
use GuzzleHttp\Psr7\Response;

final class HeadlessEndpointCoverageTest extends TestCase
{
    /** @dataProvider endpointProvider */
    public function test_documented_endpoint(
        string $clientClass,
        string $resource,
        string $operation,
        string $method,
        string $path,
        array $arguments,
        array $query,
        ?array $body,
        string $authorization,
    ): void {
        $documentedResponse = self::documentedResponse($clientClass, $method, $path);
        $history = [];
        $stack = HandlerStack::create(new MockHandler([
            new Response(200, [], json_encode($documentedResponse, JSON_THROW_ON_ERROR)),
        ]));
        $stack->push(Middleware::history($history));
        $class = 'AdroSoftware\\CircleSoSdk\\' . $clientClass;
        $api = $class::make('secret', new Options([
            'client_builder' => new ClientBuilder(new Client(['handler' => $stack])),
        ]));

        $response = $api->{$resource}()->{$operation}(...$arguments);

        $request = $history[0]['request'];
        self::assertSame($method, $request->getMethod());
        self::assertSame($path, $request->getUri()->getPath());
        parse_str($request->getUri()->getQuery(), $actualQuery);
        self::assertSame($query, $actualQuery);
        self::assertSame($authorization, $request->getHeaderLine('Authorization'));
        self::assertSame($body, $body === null ? null : json_decode((string) $request->getBody(), true));
        self::assertSame($documentedResponse, $response);
    }

    public function test_all_api_clients_preserve_the_configured_response_factory(): void
    {
        $factory = new class implements FactoryInterface {
            public function factor(?array $response = null): object
            {
                return (object) $response;
            }
        };

        foreach ([
            [AdminV2::class, 'communities', 'getCommunityDetails'],
            [HeadlessAuth::class, 'tokens', 'createGetAnAuthToken'],
            [HeadlessMember::class, 'spaces', 'getListOfSpaces'],
        ] as [$class, $resource, $operation]) {
            $api = $class::make('secret', new Options([
                'client_builder' => new ClientBuilder($this->mockedClient([
                    new Response(200, [], '{"records":[]}'),
                ])),
                'response_factory' => $factory,
            ]));

            $response = $api->{$resource}()->{$operation}(...($class === HeadlessAuth::class ? [[]] : []));

            self::assertIsObject($response);
            self::assertSame([], $response->records);
        }
    }

    /** @return array<mixed> */
    private static function documentedResponse(string $clientClass, string $method, string $path): array
    {
        $fixture = match ($clientClass) {
            'AdminV2' => 'admin_v2_examples',
            'HeadlessAuth' => 'headless_auth_examples',
            'HeadlessMember' => 'headless_member_examples',
        };
        $examples = json_decode(json_response($fixture), true, flags: JSON_THROW_ON_ERROR);

        return $examples["{$method} {$path}"] ?? [];
    }

    /** @return iterable<string, array{string, string, string, string, string, array<mixed>, array<string, string>, array<string, string>|null, string}> */
    public static function endpointProvider(): iterable
    {
        yield 'AdminV2 Access Group Members Add Member to Access Group' => ['AdminV2', 'accessGroupMembers', 'addMemberToAccessGroup', 'POST', '/api/admin/v2/access_groups/101/community_members', [101, ['example' => 'value']], [], ['example' => 'value'], 'Token secret'];
        yield 'AdminV2 Access Group Members Remove Access Group Member' => ['AdminV2', 'accessGroupMembers', 'removeAccessGroupMember', 'DELETE', '/api/admin/v2/access_groups/101/community_members', [101, ['email' => 2]], ['email' => '2'], null, 'Token secret'];
        yield 'AdminV2 Access Group Members List Access Group Community Members' => ['AdminV2', 'accessGroupMembers', 'listAccessGroupCommunityMembers', 'GET', '/api/admin/v2/access_groups/101/community_members', [101, ['page' => 2]], ['page' => '2'], null, 'Token secret'];
        yield 'AdminV2 Access Group Members Show Access Group Community Member' => ['AdminV2', 'accessGroupMembers', 'showAccessGroupCommunityMember', 'GET', '/api/admin/v2/access_groups/101/community_member', [101, ['email' => 2]], ['email' => '2'], null, 'Token secret'];
        yield 'AdminV2 Access Groups Create Access Group' => ['AdminV2', 'accessGroups', 'createAccessGroup', 'POST', '/api/admin/v2/access_groups', [['example' => 'value']], [], ['example' => 'value'], 'Token secret'];
        yield 'AdminV2 Access Groups List Access Groups' => ['AdminV2', 'accessGroups', 'listAccessGroups', 'GET', '/api/admin/v2/access_groups', [['page' => 2]], ['page' => '2'], null, 'Token secret'];
        yield 'AdminV2 Access Groups Archive Access Group' => ['AdminV2', 'accessGroups', 'archiveAccessGroup', 'DELETE', '/api/admin/v2/access_groups/101', [101], [], null, 'Token secret'];
        yield 'AdminV2 Access Groups Update Access Group' => ['AdminV2', 'accessGroups', 'updateAccessGroup', 'PUT', '/api/admin/v2/access_groups/101', [101, ['example' => 'value']], [], ['example' => 'value'], 'Token secret'];
        yield 'AdminV2 Access Groups Unarchive Access Group' => ['AdminV2', 'accessGroups', 'unarchiveAccessGroup', 'PATCH', '/api/admin/v2/access_groups/101/unarchive', [101], [], null, 'Token secret'];
        yield 'AdminV2 Advanced Search Advanced Search' => ['AdminV2', 'advancedSearch', 'advancedSearch', 'GET', '/api/admin/v2/advanced_search', [['page' => 2]], ['page' => '2'], null, 'Token secret'];
        yield 'AdminV2 Chat Preferences Update Chat Preferences' => ['AdminV2', 'chatPreferences', 'updateChatPreferences', 'PUT', '/api/admin/v2/chat_preferences', [['example' => 'value']], [], ['example' => 'value'], 'Token secret'];
        yield 'AdminV2 Chat Room Message Imports Import Chat Room Message' => ['AdminV2', 'chatRoomMessageImports', 'importChatRoomMessage', 'POST', '/api/admin/v2/chat_room_message_imports', [['example' => 'value']], [], ['example' => 'value'], 'Token secret'];
        yield 'AdminV2 Comments Create Comment' => ['AdminV2', 'comments', 'createComment', 'POST', '/api/admin/v2/comments', [['example' => 'value']], [], ['example' => 'value'], 'Token secret'];
        yield 'AdminV2 Comments List Comments' => ['AdminV2', 'comments', 'listComments', 'GET', '/api/admin/v2/comments', [['page' => 2]], ['page' => '2'], null, 'Token secret'];
        yield 'AdminV2 Comments Destroy Comment' => ['AdminV2', 'comments', 'destroyComment', 'DELETE', '/api/admin/v2/comments/101', [101], [], null, 'Token secret'];
        yield 'AdminV2 Comments Show Comment' => ['AdminV2', 'comments', 'showComment', 'GET', '/api/admin/v2/comments/101', [101], [], null, 'Token secret'];
        yield 'AdminV2 Communities Get community details' => ['AdminV2', 'communities', 'getCommunityDetails', 'GET', '/api/admin/v2/community', [], [], null, 'Token secret'];
        yield 'AdminV2 Communities Update Community' => ['AdminV2', 'communities', 'updateCommunity', 'PUT', '/api/admin/v2/community', [['example' => 'value']], [], ['example' => 'value'], 'Token secret'];
        yield 'AdminV2 Community Leads Create a non-member contact (lead). To add a full community member instead, use create_community_member.' => ['AdminV2', 'communityLeads', 'createLead', 'POST', '/api/admin/v2/community_leads', [['example' => 'value']], [], ['example' => 'value'], 'Token secret'];
        yield 'AdminV2 Community Leads Delete a non-member contact (lead). To delete a full community member instead, use destroy_community_member.' => ['AdminV2', 'communityLeads', 'deleteLead', 'DELETE', '/api/admin/v2/community_leads/101', [101], [], null, 'Token secret'];
        yield 'AdminV2 Community Member Access Groups List Community Member\'s Access Groups' => ['AdminV2', 'communityMemberAccessGroups', 'listCommunityMembersAccessGroups', 'GET', '/api/admin/v2/community_members/101/access_groups', [101, ['page' => 2]], ['page' => '2'], null, 'Token secret'];
        yield 'AdminV2 Community Member Charges Export Community Member Charges' => ['AdminV2', 'communityMemberCharges', 'exportCommunityMemberCharges', 'POST', '/api/admin/v2/community_member_charges/export', [['member_email' => 2]], ['member_email' => '2'], null, 'Token secret'];
        yield 'AdminV2 Community Member Charges Community Member Charges List' => ['AdminV2', 'communityMemberCharges', 'communityMemberChargesList', 'GET', '/api/admin/v2/community_member_charges', [['page' => 2]], ['page' => '2'], null, 'Token secret'];
        yield 'AdminV2 Community Member Charges Refund Community Member Charge' => ['AdminV2', 'communityMemberCharges', 'refundCommunityMemberCharge', 'POST', '/api/admin/v2/community_member_charges/101/refund', [101, ['example' => 'value']], [], ['example' => 'value'], 'Token secret'];
        yield 'AdminV2 Community Member Spaces List Community Member Spaces' => ['AdminV2', 'communityMemberSpaces', 'listCommunityMemberSpaces', 'GET', '/api/admin/v2/community_member_spaces', [['page' => 2]], ['page' => '2'], null, 'Token secret'];
        yield 'AdminV2 Community Member Subscriptions Cancel Community Member Subscription' => ['AdminV2', 'communityMemberSubscriptions', 'cancelCommunityMemberSubscription', 'POST', '/api/admin/v2/community_member_subscriptions/101/cancel', [101, ['example' => 'value']], [], ['example' => 'value'], 'Token secret'];
        yield 'AdminV2 Community Member Subscriptions Export Community Member Subscriptions' => ['AdminV2', 'communityMemberSubscriptions', 'exportCommunityMemberSubscriptions', 'POST', '/api/admin/v2/community_member_subscriptions/export', [['member_email' => 2]], ['member_email' => '2'], null, 'Token secret'];
        yield 'AdminV2 Community Member Subscriptions Change a billing date or extend a genuine trial; change_billing_date requires billing_date and extend_trial requires days_to_extend (the opposite field is ignored); ineligible selected operations return 401 before input validation' => ['AdminV2', 'communityMemberSubscriptions', 'changeBillingDateOrExtendTrialCommunityMemberSubscription', 'PATCH', '/api/admin/v2/community_member_subscriptions/101/billing_date', [101, ['example' => 'value']], [], ['example' => 'value'], 'Token secret'];
        yield 'AdminV2 Community Member Subscriptions Community Member Subscriptions List' => ['AdminV2', 'communityMemberSubscriptions', 'communityMemberSubscriptionsList', 'GET', '/api/admin/v2/community_member_subscriptions', [['page' => 2]], ['page' => '2'], null, 'Token secret'];
        yield 'AdminV2 Community Member Subscriptions Resume Community Member Subscription' => ['AdminV2', 'communityMemberSubscriptions', 'resumeCommunityMemberSubscription', 'POST', '/api/admin/v2/community_member_subscriptions/101/resume', [101], [], null, 'Token secret'];
        yield 'AdminV2 Community Members Ban Community Member' => ['AdminV2', 'communityMembers', 'banCommunityMember', 'PUT', '/api/admin/v2/community_members/101/ban_member', [101], [], null, 'Token secret'];
        yield 'AdminV2 Community Members Create/Invite a community member' => ['AdminV2', 'communityMembers', 'createInviteACommunityMember', 'POST', '/api/admin/v2/community_members', [['example' => 'value']], [], ['example' => 'value'], 'Token secret'];
        yield 'AdminV2 Community Members List Community Members' => ['AdminV2', 'communityMembers', 'listCommunityMembers', 'GET', '/api/admin/v2/community_members', [['page' => 2]], ['page' => '2'], null, 'Token secret'];
        yield 'AdminV2 Community Members Delete Community Member' => ['AdminV2', 'communityMembers', 'deleteCommunityMember', 'PUT', '/api/admin/v2/community_members/101/delete_member', [101], [], null, 'Token secret'];
        yield 'AdminV2 Community Members Deactivate a community member' => ['AdminV2', 'communityMembers', 'deactivateACommunityMember', 'DELETE', '/api/admin/v2/community_members/101', [101], [], null, 'Token secret'];
        yield 'AdminV2 Community Members Show a community member' => ['AdminV2', 'communityMembers', 'showACommunityMember', 'GET', '/api/admin/v2/community_members/101', [101], [], null, 'Token secret'];
        yield 'AdminV2 Community Members Update a community member' => ['AdminV2', 'communityMembers', 'updateACommunityMember', 'PUT', '/api/admin/v2/community_members/101', [101, ['example' => 'value']], [], ['example' => 'value'], 'Token secret'];
        yield 'AdminV2 Community Members Search a community member' => ['AdminV2', 'communityMembers', 'searchACommunityMember', 'GET', '/api/admin/v2/community_members/search', [['email' => 2]], ['email' => '2'], null, 'Token secret'];
        yield 'AdminV2 Community Segments Create a community segment' => ['AdminV2', 'communitySegments', 'createACommunitySegment', 'POST', '/api/admin/v2/community_segments', [['example' => 'value']], [], ['example' => 'value'], 'Token secret'];
        yield 'AdminV2 Community Segments List Community Segments' => ['AdminV2', 'communitySegments', 'listCommunitySegments', 'GET', '/api/admin/v2/community_segments', [['page' => 2]], ['page' => '2'], null, 'Token secret'];
        yield 'AdminV2 Community Segments Delete a community segment' => ['AdminV2', 'communitySegments', 'deleteACommunitySegment', 'DELETE', '/api/admin/v2/community_segments/101', [101], [], null, 'Token secret'];
        yield 'AdminV2 Community Segments Update a community segment' => ['AdminV2', 'communitySegments', 'updateACommunitySegment', 'PUT', '/api/admin/v2/community_segments/101', [101, ['example' => 'value']], [], ['example' => 'value'], 'Token secret'];
        yield 'AdminV2 Community Segments Duplicate a community segment' => ['AdminV2', 'communitySegments', 'duplicateACommunitySegment', 'POST', '/api/admin/v2/community_segments/101/duplicate', [101, ['title' => 2]], ['title' => '2'], null, 'Token secret'];
        yield 'AdminV2 Connect Settings Get Connect settings' => ['AdminV2', 'connectSettings', 'getConnectSettings', 'GET', '/api/admin/v2/settings/connect', [], [], null, 'Token secret'];
        yield 'AdminV2 Connect Settings Update Connect settings' => ['AdminV2', 'connectSettings', 'updateConnectSettings', 'PATCH', '/api/admin/v2/settings/connect', [['example' => 'value']], [], ['example' => 'value'], 'Token secret'];
        yield 'AdminV2 Contact Notes Create Contact Note' => ['AdminV2', 'contactNotes', 'createContactNote', 'POST', '/api/admin/v2/contacts/101/contact_notes', [101, ['example' => 'value']], [], ['example' => 'value'], 'Token secret'];
        yield 'AdminV2 Contact Notes List Contact Notes' => ['AdminV2', 'contactNotes', 'listContactNotes', 'GET', '/api/admin/v2/contacts/101/contact_notes', [101, ['page' => 2]], ['page' => '2'], null, 'Token secret'];
        yield 'AdminV2 Course Lesson Progress Update Course Lesson Progress' => ['AdminV2', 'courseLessonProgress', 'updateCourseLessonProgress', 'PUT', '/api/admin/v2/course_lesson_progress', [['example' => 'value']], [], ['example' => 'value'], 'Token secret'];
        yield 'AdminV2 Course Lessons Create a course lesson' => ['AdminV2', 'courseLessons', 'createACourseLesson', 'POST', '/api/admin/v2/course_lessons', [['example' => 'value']], [], ['example' => 'value'], 'Token secret'];
        yield 'AdminV2 Course Lessons List course lessons' => ['AdminV2', 'courseLessons', 'listCourseLessons', 'GET', '/api/admin/v2/course_lessons', [['page' => 2]], ['page' => '2'], null, 'Token secret'];
        yield 'AdminV2 Course Lessons Delete a course lesson' => ['AdminV2', 'courseLessons', 'deleteACourseLesson', 'DELETE', '/api/admin/v2/course_lessons/101', [101], [], null, 'Token secret'];
        yield 'AdminV2 Course Lessons Show a course lesson' => ['AdminV2', 'courseLessons', 'showACourseLesson', 'GET', '/api/admin/v2/course_lessons/101', [101], [], null, 'Token secret'];
        yield 'AdminV2 Course Lessons Update a course lesson' => ['AdminV2', 'courseLessons', 'updateACourseLesson', 'PATCH', '/api/admin/v2/course_lessons/101', [101, ['example' => 'value']], [], ['example' => 'value'], 'Token secret'];
        yield 'AdminV2 Course Lessons Reorder course lessons' => ['AdminV2', 'courseLessons', 'reorderCourseLessons', 'PUT', '/api/admin/v2/course_lessons/reorder', [['example' => 'value']], [], ['example' => 'value'], 'Token secret'];
        yield 'AdminV2 Course Sections Create a course section' => ['AdminV2', 'courseSections', 'createACourseSection', 'POST', '/api/admin/v2/course_sections', [['example' => 'value']], [], ['example' => 'value'], 'Token secret'];
        yield 'AdminV2 Course Sections List Course Sections' => ['AdminV2', 'courseSections', 'listCourseSections', 'GET', '/api/admin/v2/course_sections', [['page' => 2]], ['page' => '2'], null, 'Token secret'];
        yield 'AdminV2 Course Sections Delete a course section' => ['AdminV2', 'courseSections', 'deleteACourseSection', 'DELETE', '/api/admin/v2/course_sections/101', [101], [], null, 'Token secret'];
        yield 'AdminV2 Course Sections Show a course section' => ['AdminV2', 'courseSections', 'showACourseSection', 'GET', '/api/admin/v2/course_sections/101', [101], [], null, 'Token secret'];
        yield 'AdminV2 Course Sections Update a course section' => ['AdminV2', 'courseSections', 'updateACourseSection', 'PUT', '/api/admin/v2/course_sections/101', [101, ['example' => 'value']], [], ['example' => 'value'], 'Token secret'];
        yield 'AdminV2 Direct Uploads Create Direct Upload' => ['AdminV2', 'directUploads', 'createDirectUpload', 'POST', '/api/admin/v2/direct_uploads', [['example' => 'value']], [], ['example' => 'value'], 'Token secret'];
        yield 'AdminV2 Embeds Create Embed' => ['AdminV2', 'embeds', 'createEmbed', 'POST', '/api/admin/v2/embeds', [['example' => 'value']], [], ['example' => 'value'], 'Token secret'];
        yield 'AdminV2 Embeds Get Embed' => ['AdminV2', 'embeds', 'getEmbed', 'GET', '/api/admin/v2/embeds/101', [101], [], null, 'Token secret'];
        yield 'AdminV2 Event Attendees Create Event Attendee' => ['AdminV2', 'eventAttendees', 'createEventAttendee', 'POST', '/api/admin/v2/event_attendees', [['example' => 'value']], [], ['example' => 'value'], 'Token secret'];
        yield 'AdminV2 Event Attendees Delete Event Attendee' => ['AdminV2', 'eventAttendees', 'deleteEventAttendee', 'DELETE', '/api/admin/v2/event_attendees', [['example' => 'value']], [], ['example' => 'value'], 'Token secret'];
        yield 'AdminV2 Event Attendees List Event Attendees' => ['AdminV2', 'eventAttendees', 'listEventAttendees', 'GET', '/api/admin/v2/event_attendees', [['event_id' => 2]], ['event_id' => '2'], null, 'Token secret'];
        yield 'AdminV2 Events Create Event' => ['AdminV2', 'events', 'createEvent', 'POST', '/api/admin/v2/events', [['example' => 'value']], [], ['example' => 'value'], 'Token secret'];
        yield 'AdminV2 Events List Events' => ['AdminV2', 'events', 'listEvents', 'GET', '/api/admin/v2/events', [['page' => 2]], ['page' => '2'], null, 'Token secret'];
        yield 'AdminV2 Events Delete Event' => ['AdminV2', 'events', 'deleteEvent', 'DELETE', '/api/admin/v2/events/101', [101, ['space_id' => 2]], ['space_id' => '2'], null, 'Token secret'];
        yield 'AdminV2 Events Get Event' => ['AdminV2', 'events', 'getEvent', 'GET', '/api/admin/v2/events/101', [101], [], null, 'Token secret'];
        yield 'AdminV2 Events Update Event' => ['AdminV2', 'events', 'updateEvent', 'PUT', '/api/admin/v2/events/101', [101, ['example' => 'value']], [], ['example' => 'value'], 'Token secret'];
        yield 'AdminV2 Events Duplicate Event' => ['AdminV2', 'events', 'duplicateEvent', 'POST', '/api/admin/v2/spaces/101/events/102/duplicate', [101, 102, ['example' => 'value']], [], ['example' => 'value'], 'Token secret'];
        yield 'AdminV2 Filter Kit Controls Create a member filter control' => ['AdminV2', 'filterKitControls', 'createAMemberFilterControl', 'POST', '/api/admin/v2/filter_kit_controls', [['example' => 'value']], [], ['example' => 'value'], 'Token secret'];
        yield 'AdminV2 Filter Kit Controls List member directory and member space filter controls' => ['AdminV2', 'filterKitControls', 'listMemberDirectoryAndMemberSpaceFilterControls', 'GET', '/api/admin/v2/filter_kit_controls', [['space_id' => 2]], ['space_id' => '2'], null, 'Token secret'];
        yield 'AdminV2 Filter Kit Controls Delete a filter control' => ['AdminV2', 'filterKitControls', 'deleteAFilterControl', 'DELETE', '/api/admin/v2/filter_kit_controls/101', [101], [], null, 'Token secret'];
        yield 'AdminV2 Filter Kit Controls Get a filter control' => ['AdminV2', 'filterKitControls', 'getAFilterControl', 'GET', '/api/admin/v2/filter_kit_controls/101', [101], [], null, 'Token secret'];
        yield 'AdminV2 Filter Kit Controls Update a member directory or member space filter control' => ['AdminV2', 'filterKitControls', 'updateAMemberDirectoryOrMemberSpaceFilterControl', 'PATCH', '/api/admin/v2/filter_kit_controls/101', [101, ['example' => 'value']], [], ['example' => 'value'], 'Token secret'];
        yield 'AdminV2 FilterKit Configuration Get the filters currently shown on the member directory or a member space' => ['AdminV2', 'filterkitConfiguration', 'getTheFiltersCurrentlyShownOnTheMemberDirectoryOrAMemberSpace', 'GET', '/api/admin/v2/filter_kit_configuration', [['context' => 2]], ['context' => '2'], null, 'Token secret'];
        yield 'AdminV2 Flagged Contents Report Flagged Content' => ['AdminV2', 'flaggedContents', 'reportFlaggedContent', 'POST', '/api/admin/v2/flagged_contents', [['example' => 'value']], [], ['example' => 'value'], 'Token secret'];
        yield 'AdminV2 Flagged Contents List Flagged Contents' => ['AdminV2', 'flaggedContents', 'listFlaggedContents', 'GET', '/api/admin/v2/flagged_contents', [['page' => 2]], ['page' => '2'], null, 'Token secret'];
        yield 'AdminV2 Forms Delete a form' => ['AdminV2', 'forms', 'deleteAForm', 'DELETE', '/api/admin/v2/forms/101', [101], [], null, 'Token secret'];
        yield 'AdminV2 Forms Show a form' => ['AdminV2', 'forms', 'showAForm', 'GET', '/api/admin/v2/forms/101', [101], [], null, 'Token secret'];
        yield 'AdminV2 Forms Update a form' => ['AdminV2', 'forms', 'updateAForm', 'PUT', '/api/admin/v2/forms/101', [101, ['example' => 'value']], [], ['example' => 'value'], 'Token secret'];
        yield 'AdminV2 Forms Duplicate a form' => ['AdminV2', 'forms', 'duplicateAForm', 'POST', '/api/admin/v2/forms/101/duplicate', [101], [], null, 'Token secret'];
        yield 'AdminV2 Forms List Forms' => ['AdminV2', 'forms', 'listForms', 'GET', '/api/admin/v2/forms', [['page' => 2]], ['page' => '2'], null, 'Token secret'];
        yield 'AdminV2 Forms Create a form submission' => ['AdminV2', 'forms', 'createAFormSubmission', 'POST', '/api/admin/v2/forms/101/submissions', [101, ['example' => 'value']], [], ['example' => 'value'], 'Token secret'];
        yield 'AdminV2 Forms List form submissions' => ['AdminV2', 'forms', 'listFormSubmissions', 'GET', '/api/admin/v2/forms/101/submissions', [101, ['page' => 2]], ['page' => '2'], null, 'Token secret'];
        yield 'AdminV2 Gamification Show Leaderboard' => ['AdminV2', 'gamification', 'showLeaderboard', 'GET', '/api/admin/v2/gamification/leaderboard', [['period' => 2]], ['period' => '2'], null, 'Token secret'];
        yield 'AdminV2 Invitation Links Create invitation link' => ['AdminV2', 'invitationLinks', 'createInvitationLink', 'POST', '/api/admin/v2/invitation_links', [['example' => 'value']], [], ['example' => 'value'], 'Token secret'];
        yield 'AdminV2 Invitation Links List Invitation Links' => ['AdminV2', 'invitationLinks', 'listInvitationLinks', 'GET', '/api/admin/v2/invitation_links', [['page' => 2]], ['page' => '2'], null, 'Token secret'];
        yield 'AdminV2 Invitation Links Delete invitation link' => ['AdminV2', 'invitationLinks', 'deleteInvitationLink', 'DELETE', '/api/admin/v2/invitation_links/101', [101], [], null, 'Token secret'];
        yield 'AdminV2 Invitation Links Update invitation link' => ['AdminV2', 'invitationLinks', 'updateInvitationLink', 'PUT', '/api/admin/v2/invitation_links/101', [101, ['example' => 'value']], [], ['example' => 'value'], 'Token secret'];
        yield 'AdminV2 Invitation Links Revoke invitation link' => ['AdminV2', 'invitationLinks', 'revokeInvitationLink', 'PATCH', '/api/admin/v2/invitation_links/101/revoke', [101], [], null, 'Token secret'];
        yield 'AdminV2 Live List Live Rooms' => ['AdminV2', 'live', 'listLiveRooms', 'GET', '/api/admin/v2/live/rooms', [['page' => 2]], ['page' => '2'], null, 'Token secret'];
        yield 'AdminV2 Live List Live Room Transcripts' => ['AdminV2', 'live', 'listLiveRoomTranscripts', 'GET', '/api/admin/v2/live/rooms/101/transcripts', [101], [], null, 'Token secret'];
        yield 'AdminV2 Locations Search locations' => ['AdminV2', 'locations', 'searchLocations', 'GET', '/api/admin/v2/locations/search', [['query' => 2]], ['query' => '2'], null, 'Token secret'];
        yield 'AdminV2 Member Tags Create Member Tag' => ['AdminV2', 'memberTags', 'createMemberTag', 'POST', '/api/admin/v2/member_tags', [['example' => 'value']], [], ['example' => 'value'], 'Token secret'];
        yield 'AdminV2 Member Tags Member Tags List' => ['AdminV2', 'memberTags', 'memberTagsList', 'GET', '/api/admin/v2/member_tags', [['page' => 2]], ['page' => '2'], null, 'Token secret'];
        yield 'AdminV2 Member Tags Deletes a member tag' => ['AdminV2', 'memberTags', 'deletesAMemberTag', 'DELETE', '/api/admin/v2/member_tags/101', [101], [], null, 'Token secret'];
        yield 'AdminV2 Member Tags Shows a member tag\'s details' => ['AdminV2', 'memberTags', 'showsAMemberTagsDetails', 'GET', '/api/admin/v2/member_tags/101', [101], [], null, 'Token secret'];
        yield 'AdminV2 Member Tags Update member tag' => ['AdminV2', 'memberTags', 'updateMemberTag', 'PUT', '/api/admin/v2/member_tags/101', [101, ['example' => 'value']], [], ['example' => 'value'], 'Token secret'];
        yield 'AdminV2 Messages Create Message' => ['AdminV2', 'messages', 'createMessage', 'POST', '/api/admin/v2/messages', [['example' => 'value']], [], ['example' => 'value'], 'Token secret'];
        yield 'AdminV2 Page Profile Fields Get Page Profile Fields' => ['AdminV2', 'pageProfileFields', 'getPageProfileFields', 'GET', '/api/admin/v2/page_profile_fields', [['page_name' => 2]], ['page_name' => '2'], null, 'Token secret'];
        yield 'AdminV2 Payment Method Settings Retrieves the community\'s payment method preferences' => ['AdminV2', 'paymentMethodSettings', 'retrievesTheCommunitysPaymentMethodPreferences', 'GET', '/api/admin/v2/payment_method_setting', [], [], null, 'Token secret'];
        yield 'AdminV2 Paywall Affiliate Payouts Export Paywall Affiliate Payouts' => ['AdminV2', 'paywallAffiliatePayouts', 'exportPaywallAffiliatePayouts', 'POST', '/api/admin/v2/paywall_affiliate_payouts/export', [['example' => 'value']], [], ['example' => 'value'], 'Token secret'];
        yield 'AdminV2 Paywall Affiliate Payouts Mark Paywall Affiliate Payouts Paid' => ['AdminV2', 'paywallAffiliatePayouts', 'markPaywallAffiliatePayoutsPaid', 'POST', '/api/admin/v2/paywall_affiliate_payouts/mark_paid', [['example' => 'value']], [], ['example' => 'value'], 'Token secret'];
        yield 'AdminV2 Paywall Affiliate Payouts Start Paywall Affiliate Payouts' => ['AdminV2', 'paywallAffiliatePayouts', 'startPaywallAffiliatePayouts', 'POST', '/api/admin/v2/paywall_affiliate_payouts/start', [['example' => 'value']], [], ['example' => 'value'], 'Token secret'];
        yield 'AdminV2 Paywall Affiliates Paywall Affiliates List' => ['AdminV2', 'paywallAffiliates', 'paywallAffiliatesList', 'GET', '/api/admin/v2/paywall_affiliates', [['page' => 2]], ['page' => '2'], null, 'Token secret'];
        yield 'AdminV2 Paywall Affiliates Invite Paywall Affiliates' => ['AdminV2', 'paywallAffiliates', 'invitePaywallAffiliates', 'POST', '/api/admin/v2/paywall_affiliates/invite', [['example' => 'value']], [], ['example' => 'value'], 'Token secret'];
        yield 'AdminV2 Paywall Affiliates Update Paywall Affiliate' => ['AdminV2', 'paywallAffiliates', 'updatePaywallAffiliate', 'PATCH', '/api/admin/v2/paywall_affiliates/101', [101, ['example' => 'value']], [], ['example' => 'value'], 'Token secret'];
        yield 'AdminV2 Paywall Coupons Deletes a paywall coupon' => ['AdminV2', 'paywallCoupons', 'deletesAPaywallCoupon', 'DELETE', '/api/admin/v2/paywall_coupons/101', [101], [], null, 'Token secret'];
        yield 'AdminV2 Paywall Groups Create Subscription Group' => ['AdminV2', 'paywallGroups', 'createSubscriptionGroup', 'POST', '/api/admin/v2/paywall_groups', [['example' => 'value']], [], ['example' => 'value'], 'Token secret'];
        yield 'AdminV2 Paywall Groups Update Subscription Group' => ['AdminV2', 'paywallGroups', 'updateSubscriptionGroup', 'PUT', '/api/admin/v2/paywall_groups/101', [101, ['example' => 'value']], [], ['example' => 'value'], 'Token secret'];
        yield 'AdminV2 Paywalls Search Paywalls' => ['AdminV2', 'paywalls', 'searchPaywalls', 'GET', '/api/admin/v2/paywalls/search', [['page' => 2]], ['page' => '2'], null, 'Token secret'];
        yield 'AdminV2 Paywalls Deletes a paywall' => ['AdminV2', 'paywalls', 'deletesAPaywall', 'DELETE', '/api/admin/v2/paywalls/101', [101], [], null, 'Token secret'];
        yield 'AdminV2 Paywalls Archives a paywall' => ['AdminV2', 'paywalls', 'archivesAPaywall', 'PUT', '/api/admin/v2/paywalls/101/archive', [101], [], null, 'Token secret'];
        yield 'AdminV2 Paywalls Syncs a legacy paywall\'s member access' => ['AdminV2', 'paywalls', 'syncsALegacyPaywallsMemberAccess', 'POST', '/api/admin/v2/paywalls/101/member_access_syncs', [101], [], null, 'Token secret'];
        yield 'AdminV2 Paywalls Publishes a paywall' => ['AdminV2', 'paywalls', 'publishesAPaywall', 'PUT', '/api/admin/v2/paywalls/101/publish', [101], [], null, 'Token secret'];
        yield 'AdminV2 Paywalls Unarchives a paywall' => ['AdminV2', 'paywalls', 'unarchivesAPaywall', 'PUT', '/api/admin/v2/paywalls/101/unarchive', [101], [], null, 'Token secret'];
        yield 'AdminV2 Post Followers Unfollow a post' => ['AdminV2', 'postFollowers', 'unfollowAPost', 'DELETE', '/api/admin/v2/posts/101/post_followers', [101, ['community_member_id' => 2]], ['community_member_id' => '2'], null, 'Token secret'];
        yield 'AdminV2 Posts Create Image Post' => ['AdminV2', 'posts', 'createImagePost', 'POST', '/api/admin/v2/spaces/101/images/posts', [101, ['example' => 'value']], [], ['example' => 'value'], 'Token secret'];
        yield 'AdminV2 Posts List Image Posts' => ['AdminV2', 'posts', 'listImagePosts', 'GET', '/api/admin/v2/spaces/101/images/posts', [101, ['page' => 2]], ['page' => '2'], null, 'Token secret'];
        yield 'AdminV2 Posts Delete Image Post' => ['AdminV2', 'posts', 'deleteImagePost', 'DELETE', '/api/admin/v2/spaces/101/images/posts/102', [101, 102], [], null, 'Token secret'];
        yield 'AdminV2 Posts Show Image Post' => ['AdminV2', 'posts', 'showImagePost', 'GET', '/api/admin/v2/spaces/101/images/posts/102', [101, 102], [], null, 'Token secret'];
        yield 'AdminV2 Posts Duplicate Image Post' => ['AdminV2', 'posts', 'duplicateImagePost', 'POST', '/api/admin/v2/spaces/101/images/posts/102/duplicate', [101, 102, ['example' => 'value']], [], ['example' => 'value'], 'Token secret'];
        yield 'AdminV2 Posts Create Basic Post' => ['AdminV2', 'posts', 'createBasicPost', 'POST', '/api/admin/v2/posts', [['example' => 'value']], [], ['example' => 'value'], 'Token secret'];
        yield 'AdminV2 Posts List Basic Posts' => ['AdminV2', 'posts', 'listBasicPosts', 'GET', '/api/admin/v2/posts', [['page' => 2]], ['page' => '2'], null, 'Token secret'];
        yield 'AdminV2 Posts Delete Basic Post' => ['AdminV2', 'posts', 'deleteBasicPost', 'DELETE', '/api/admin/v2/posts/101', [101], [], null, 'Token secret'];
        yield 'AdminV2 Posts Show Basic Post' => ['AdminV2', 'posts', 'showBasicPost', 'GET', '/api/admin/v2/posts/101', [101], [], null, 'Token secret'];
        yield 'AdminV2 Posts Update Basic Post' => ['AdminV2', 'posts', 'updateBasicPost', 'PUT', '/api/admin/v2/posts/101', [101, ['example' => 'value']], [], ['example' => 'value'], 'Token secret'];
        yield 'AdminV2 Posts Get Post Summary' => ['AdminV2', 'posts', 'getPostSummary', 'GET', '/api/admin/v2/posts/101/summary', [101], [], null, 'Token secret'];
        yield 'AdminV2 Profile Fields Archive Profile Field' => ['AdminV2', 'profileFields', 'archiveProfileField', 'PUT', '/api/admin/v2/profile_fields/101/archive', [101], [], null, 'Token secret'];
        yield 'AdminV2 Profile Fields Create Profile Field' => ['AdminV2', 'profileFields', 'createProfileField', 'POST', '/api/admin/v2/profile_fields', [['example' => 'value']], [], ['example' => 'value'], 'Token secret'];
        yield 'AdminV2 Profile Fields Profile Fields List' => ['AdminV2', 'profileFields', 'profileFieldsList', 'GET', '/api/admin/v2/profile_fields', [['page' => 2]], ['page' => '2'], null, 'Token secret'];
        yield 'AdminV2 Profile Fields Delete Profile Field' => ['AdminV2', 'profileFields', 'deleteProfileField', 'DELETE', '/api/admin/v2/profile_fields/101', [101], [], null, 'Token secret'];
        yield 'AdminV2 Profile Fields Update Profile Field' => ['AdminV2', 'profileFields', 'updateProfileField', 'PUT', '/api/admin/v2/profile_fields/101', [101, ['example' => 'value']], [], ['example' => 'value'], 'Token secret'];
        yield 'AdminV2 Profile Fields Unarchive Profile Field' => ['AdminV2', 'profileFields', 'unarchiveProfileField', 'PUT', '/api/admin/v2/profile_fields/101/unarchive', [101], [], null, 'Token secret'];
        yield 'AdminV2 Space Group Members Create Space Group Member' => ['AdminV2', 'spaceGroupMembers', 'createSpaceGroupMember', 'POST', '/api/admin/v2/space_group_members', [['example' => 'value']], [], ['example' => 'value'], 'Token secret'];
        yield 'AdminV2 Space Group Members Destroy Space Group Member' => ['AdminV2', 'spaceGroupMembers', 'destroySpaceGroupMember', 'DELETE', '/api/admin/v2/space_group_members', [['email' => 2]], ['email' => '2'], null, 'Token secret'];
        yield 'AdminV2 Space Group Members List Space Group Members' => ['AdminV2', 'spaceGroupMembers', 'listSpaceGroupMembers', 'GET', '/api/admin/v2/space_group_members', [['page' => 2]], ['page' => '2'], null, 'Token secret'];
        yield 'AdminV2 Space Group Members Show Space Group Member' => ['AdminV2', 'spaceGroupMembers', 'showSpaceGroupMember', 'GET', '/api/admin/v2/space_group_member', [['email' => 2]], ['email' => '2'], null, 'Token secret'];
        yield 'AdminV2 Space Groups Create Space Group' => ['AdminV2', 'spaceGroups', 'createSpaceGroup', 'POST', '/api/admin/v2/space_groups', [['example' => 'value']], [], ['example' => 'value'], 'Token secret'];
        yield 'AdminV2 Space Groups List Space Groups' => ['AdminV2', 'spaceGroups', 'listSpaceGroups', 'GET', '/api/admin/v2/space_groups', [['page' => 2]], ['page' => '2'], null, 'Token secret'];
        yield 'AdminV2 Space Groups Delete Space Group' => ['AdminV2', 'spaceGroups', 'deleteSpaceGroup', 'DELETE', '/api/admin/v2/space_groups/101', [101], [], null, 'Token secret'];
        yield 'AdminV2 Space Groups Show Space Group' => ['AdminV2', 'spaceGroups', 'showSpaceGroup', 'GET', '/api/admin/v2/space_groups/101', [101], [], null, 'Token secret'];
        yield 'AdminV2 Space Groups Update Space Group' => ['AdminV2', 'spaceGroups', 'updateSpaceGroup', 'PUT', '/api/admin/v2/space_groups/101', [101, ['example' => 'value']], [], ['example' => 'value'], 'Token secret'];
        yield 'AdminV2 Space Members Add Space Member' => ['AdminV2', 'spaceMembers', 'addSpaceMember', 'POST', '/api/admin/v2/space_members', [['example' => 'value']], [], ['example' => 'value'], 'Token secret'];
        yield 'AdminV2 Space Members Remove Space Member' => ['AdminV2', 'spaceMembers', 'removeSpaceMember', 'DELETE', '/api/admin/v2/space_members', [['email' => 2]], ['email' => '2'], null, 'Token secret'];
        yield 'AdminV2 Space Members List Space Members' => ['AdminV2', 'spaceMembers', 'listSpaceMembers', 'GET', '/api/admin/v2/space_members', [['page' => 2]], ['page' => '2'], null, 'Token secret'];
        yield 'AdminV2 Space Members Show Space Member' => ['AdminV2', 'spaceMembers', 'showSpaceMember', 'GET', '/api/admin/v2/space_member', [['email' => 2]], ['email' => '2'], null, 'Token secret'];
        yield 'AdminV2 Spaces Summarize a space' => ['AdminV2', 'spaces', 'summarizeASpace', 'GET', '/api/admin/v2/spaces/101/ai_summaries', [101, ['date_from' => 2]], ['date_from' => '2'], null, 'Token secret'];
        yield 'AdminV2 Spaces Create Space' => ['AdminV2', 'spaces', 'createSpace', 'POST', '/api/admin/v2/spaces', [['example' => 'value']], [], ['example' => 'value'], 'Token secret'];
        yield 'AdminV2 Spaces List Spaces' => ['AdminV2', 'spaces', 'listSpaces', 'GET', '/api/admin/v2/spaces', [['page' => 2]], ['page' => '2'], null, 'Token secret'];
        yield 'AdminV2 Spaces Delete a space' => ['AdminV2', 'spaces', 'deleteASpace', 'DELETE', '/api/admin/v2/spaces/101', [101], [], null, 'Token secret'];
        yield 'AdminV2 Spaces Show a space' => ['AdminV2', 'spaces', 'showASpace', 'GET', '/api/admin/v2/spaces/101', [101], [], null, 'Token secret'];
        yield 'AdminV2 Spaces Update Space' => ['AdminV2', 'spaces', 'updateSpace', 'PUT', '/api/admin/v2/spaces/101', [101, ['example' => 'value']], [], ['example' => 'value'], 'Token secret'];
        yield 'AdminV2 Tagged Members Create Tagged Member' => ['AdminV2', 'taggedMembers', 'createTaggedMember', 'POST', '/api/admin/v2/tagged_members', [['example' => 'value']], [], ['example' => 'value'], 'Token secret'];
        yield 'AdminV2 Tagged Members Delete Tagged Member' => ['AdminV2', 'taggedMembers', 'deleteTaggedMember', 'DELETE', '/api/admin/v2/tagged_members', [['user_email' => 2]], ['user_email' => '2'], null, 'Token secret'];
        yield 'AdminV2 Tagged Members List Tagged Members' => ['AdminV2', 'taggedMembers', 'listTaggedMembers', 'GET', '/api/admin/v2/tagged_members', [['page' => 2]], ['page' => '2'], null, 'Token secret'];
        yield 'AdminV2 Tagged Members Get Tagged Member' => ['AdminV2', 'taggedMembers', 'getTaggedMember', 'GET', '/api/admin/v2/tagged_members/101', [101], [], null, 'Token secret'];
        yield 'AdminV2 Tax Settings Get tax settings' => ['AdminV2', 'taxSettings', 'getTaxSettings', 'GET', '/api/admin/v2/tax_setting', [], [], null, 'Token secret'];
        yield 'AdminV2 Tax Settings Update tax settings' => ['AdminV2', 'taxSettings', 'updateTaxSettings', 'PUT', '/api/admin/v2/tax_setting', [['example' => 'value']], [], ['example' => 'value'], 'Token secret'];
        yield 'AdminV2 Topics Create a topic' => ['AdminV2', 'topics', 'createATopic', 'POST', '/api/admin/v2/topics', [['example' => 'value']], [], ['example' => 'value'], 'Token secret'];
        yield 'AdminV2 Topics List topics' => ['AdminV2', 'topics', 'listTopics', 'GET', '/api/admin/v2/topics', [['page' => 2]], ['page' => '2'], null, 'Token secret'];
        yield 'AdminV2 Topics Delete a topic' => ['AdminV2', 'topics', 'deleteATopic', 'DELETE', '/api/admin/v2/topics/101', [101], [], null, 'Token secret'];
        yield 'AdminV2 Topics Show topic details' => ['AdminV2', 'topics', 'showTopicDetails', 'GET', '/api/admin/v2/topics/101', [101], [], null, 'Token secret'];
        yield 'AdminV2 Topics Update a topic' => ['AdminV2', 'topics', 'updateATopic', 'PUT', '/api/admin/v2/topics/101', [101, ['example' => 'value']], [], ['example' => 'value'], 'Token secret'];
        yield 'AdminV2 Workflows Activate an automation (dynamic) workflow so it starts running automatically' => ['AdminV2', 'workflows', 'activateAnAutomationDynamicWorkflowSoItStartsRunningAutomatically', 'PUT', '/api/admin/v2/workflows/101/activate', [101], [], null, 'Token secret'];
        yield 'AdminV2 Workflows Deactivate an automation (dynamic) workflow so it stops running automatically' => ['AdminV2', 'workflows', 'deactivateAnAutomationDynamicWorkflowSoItStopsRunningAutomatically', 'PUT', '/api/admin/v2/workflows/101/deactivate', [101], [], null, 'Token secret'];
        yield 'AdminV2 Workflows Duplicate a workflow' => ['AdminV2', 'workflows', 'duplicateAWorkflow', 'POST', '/api/admin/v2/workflows/101/duplicate', [101], [], null, 'Token secret'];
        yield 'AdminV2 Workflows List a community\'s automations/workflows' => ['AdminV2', 'workflows', 'listACommunitysAutomationsWorkflows', 'GET', '/api/admin/v2/workflows', [['query' => 2]], ['query' => '2'], null, 'Token secret'];
        yield 'AdminV2 Workflows Get Workflow' => ['AdminV2', 'workflows', 'getWorkflow', 'GET', '/api/admin/v2/workflows/101', [101], [], null, 'Token secret'];
        yield 'HeadlessAuth Headless Refresh an access token' => ['HeadlessAuth', 'tokens', 'refreshAnAccessToken', 'PATCH', '/api/v1/headless/access_token/refresh', [['example' => 'value']], [], ['example' => 'value'], 'Bearer secret'];
        yield 'HeadlessAuth Headless Revoke an access token' => ['HeadlessAuth', 'tokens', 'revokeAnAccessToken', 'POST', '/api/v1/headless/access_token/revoke', [['example' => 'value']], [], ['example' => 'value'], 'Bearer secret'];
        yield 'HeadlessAuth Headless Create/Get an auth token' => ['HeadlessAuth', 'tokens', 'createGetAnAuthToken', 'POST', '/api/v1/headless/auth_token', [['example' => 'value']], [], ['example' => 'value'], 'Bearer secret'];
        yield 'HeadlessAuth Headless Revoke a refresh token' => ['HeadlessAuth', 'tokens', 'revokeARefreshToken', 'POST', '/api/v1/headless/refresh_token/revoke', [['example' => 'value']], [], ['example' => 'value'], 'Bearer secret'];
        yield 'HeadlessMember Advanced Search Advanced Search' => ['HeadlessMember', 'advancedSearch', 'advancedSearch', 'GET', '/api/headless/v1/advanced_search', [['page' => 2]], ['page' => '2'], null, 'Bearer secret'];
        yield 'HeadlessMember Bookmarks Create a bookmark' => ['HeadlessMember', 'bookmarks', 'createABookmark', 'POST', '/api/headless/v1/bookmarks', [['example' => 'value']], [], ['example' => 'value'], 'Bearer secret'];
        yield 'HeadlessMember Bookmarks Get bookmarks paginated list' => ['HeadlessMember', 'bookmarks', 'getBookmarksPaginatedList', 'GET', '/api/headless/v1/bookmarks', [['page' => 2]], ['page' => '2'], null, 'Bearer secret'];
        yield 'HeadlessMember Bookmarks Delete a bookmark' => ['HeadlessMember', 'bookmarks', 'deleteABookmark', 'DELETE', '/api/headless/v1/bookmarks/101', [101], [], null, 'Bearer secret'];
        yield 'HeadlessMember Chat Room Create chat room message' => ['HeadlessMember', 'chatRoom', 'createChatRoomMessage', 'POST', '/api/headless/v1/messages/101/chat_room_messages', [101, ['example' => 'value']], [], ['example' => 'value'], 'Bearer secret'];
        yield 'HeadlessMember Chat Room Fetch chat room messages' => ['HeadlessMember', 'chatRoom', 'fetchChatRoomMessages', 'GET', '/api/headless/v1/messages/101/chat_room_messages', [101, ['id' => 2]], ['id' => '2'], null, 'Bearer secret'];
        yield 'HeadlessMember Chat Room Delete chat room message' => ['HeadlessMember', 'chatRoom', 'deleteChatRoomMessage', 'DELETE', '/api/headless/v1/messages/101/chat_room_messages/102', [101, 102], [], null, 'Bearer secret'];
        yield 'HeadlessMember Chat Room Get chat room message' => ['HeadlessMember', 'chatRoom', 'getChatRoomMessage', 'GET', '/api/headless/v1/messages/101/chat_room_messages/102', [101, 102], [], null, 'Bearer secret'];
        yield 'HeadlessMember Chat Room Update chat room message' => ['HeadlessMember', 'chatRoom', 'updateChatRoomMessage', 'PUT', '/api/headless/v1/messages/101/chat_room_messages/102', [101, 102, ['example' => 'value']], [], ['example' => 'value'], 'Bearer secret'];
        yield 'HeadlessMember Chat Room Get chat room participants' => ['HeadlessMember', 'chatRoom', 'getChatRoomParticipants', 'GET', '/api/headless/v1/messages/101/chat_room_participants', [101, ['page' => 2]], ['page' => '2'], null, 'Bearer secret'];
        yield 'HeadlessMember Chat Room Update chat room participant' => ['HeadlessMember', 'chatRoom', 'updateChatRoomParticipant', 'PUT', '/api/headless/v1/messages/101/chat_room_participants/102', [101, 102, ['example' => 'value']], [], ['example' => 'value'], 'Bearer secret'];
        yield 'HeadlessMember Chat Room Create a chat room' => ['HeadlessMember', 'chatRoom', 'createAChatRoom', 'POST', '/api/headless/v1/messages', [['example' => 'value']], [], ['example' => 'value'], 'Bearer secret'];
        yield 'HeadlessMember Chat Room Get chat rooms' => ['HeadlessMember', 'chatRoom', 'getChatRooms', 'GET', '/api/headless/v1/messages', [['page' => 2]], ['page' => '2'], null, 'Bearer secret'];
        yield 'HeadlessMember Chat Room Mark all messages in a chat room as read' => ['HeadlessMember', 'chatRoom', 'markAllMessagesInAChatRoomAsRead', 'POST', '/api/headless/v1/messages/101/mark_all_as_read', [101], [], null, 'Bearer secret'];
        yield 'HeadlessMember Chat Room Get chat room details' => ['HeadlessMember', 'chatRoom', 'getChatRoomDetails', 'GET', '/api/headless/v1/messages/101', [101], [], null, 'Bearer secret'];
        yield 'HeadlessMember Chat Room Get unread chat rooms' => ['HeadlessMember', 'chatRoom', 'getUnreadChatRooms', 'GET', '/api/headless/v1/messages/unread_chat_rooms', [], [], null, 'Bearer secret'];
        yield 'HeadlessMember Chat Room Create a reaction on a chat room message' => ['HeadlessMember', 'chatRoom', 'createAReactionOnAChatRoomMessage', 'POST', '/api/headless/v1/reactions', [['example' => 'value']], [], ['example' => 'value'], 'Bearer secret'];
        yield 'HeadlessMember Chat Room Remove a reaction from a chat room message' => ['HeadlessMember', 'chatRoom', 'removeAReactionFromAChatRoomMessage', 'DELETE', '/api/headless/v1/reactions', [['example' => 'value']], [], ['example' => 'value'], 'Bearer secret'];
        yield 'HeadlessMember Chat Threads List chat threads' => ['HeadlessMember', 'chatThreads', 'listChatThreads', 'GET', '/api/headless/v1/chat_threads', [['page' => 2]], ['page' => '2'], null, 'Bearer secret'];
        yield 'HeadlessMember Chat Threads Get chat thread' => ['HeadlessMember', 'chatThreads', 'getChatThread', 'GET', '/api/headless/v1/chat_threads/101', [101], [], null, 'Bearer secret'];
        yield 'HeadlessMember Chat Threads Get unread chat threads' => ['HeadlessMember', 'chatThreads', 'getUnreadChatThreads', 'GET', '/api/headless/v1/chat_threads/unread_chat_threads', [], [], null, 'Bearer secret'];
        yield 'HeadlessMember Comments Create a comment for a post' => ['HeadlessMember', 'comments', 'createACommentForAPost', 'POST', '/api/headless/v1/posts/101/comments', [101, ['example' => 'value']], [], ['example' => 'value'], 'Bearer secret'];
        yield 'HeadlessMember Comments Get list of comments for a post' => ['HeadlessMember', 'comments', 'getListOfCommentsForAPost', 'GET', '/api/headless/v1/posts/101/comments', [101, ['page' => 2]], ['page' => '2'], null, 'Bearer secret'];
        yield 'HeadlessMember Comments Delete a comment for a post' => ['HeadlessMember', 'comments', 'deleteACommentForAPost', 'DELETE', '/api/headless/v1/posts/101/comments/102', [101, 102], [], null, 'Bearer secret'];
        yield 'HeadlessMember Comments Get a comment for a post' => ['HeadlessMember', 'comments', 'getACommentForAPost', 'GET', '/api/headless/v1/posts/101/comments/102', [101, 102], [], null, 'Bearer secret'];
        yield 'HeadlessMember Comments Update a comment for a post' => ['HeadlessMember', 'comments', 'updateACommentForAPost', 'PATCH', '/api/headless/v1/posts/101/comments/102', [101, 102, ['example' => 'value']], [], ['example' => 'value'], 'Bearer secret'];
        yield 'HeadlessMember Comments Create a reply for a comment' => ['HeadlessMember', 'comments', 'createAReplyForAComment', 'POST', '/api/headless/v1/comments/101/replies', [101, ['example' => 'value']], [], ['example' => 'value'], 'Bearer secret'];
        yield 'HeadlessMember Comments Get list of replies for a comment' => ['HeadlessMember', 'comments', 'getListOfRepliesForAComment', 'GET', '/api/headless/v1/comments/101/replies', [101, ['page' => 2]], ['page' => '2'], null, 'Bearer secret'];
        yield 'HeadlessMember Comments Delete a reply for a comment' => ['HeadlessMember', 'comments', 'deleteAReplyForAComment', 'DELETE', '/api/headless/v1/comments/101/replies/102', [101, 102], [], null, 'Bearer secret'];
        yield 'HeadlessMember Comments Get a reply for a comment' => ['HeadlessMember', 'comments', 'getAReplyForAComment', 'GET', '/api/headless/v1/comments/101/replies/102', [101, 102], [], null, 'Bearer secret'];
        yield 'HeadlessMember Comments Update a reply for a comment' => ['HeadlessMember', 'comments', 'updateAReplyForAComment', 'PATCH', '/api/headless/v1/comments/101/replies/102', [101, 102, ['example' => 'value']], [], ['example' => 'value'], 'Bearer secret'];
        yield 'HeadlessMember Comments Create a user like for a comment' => ['HeadlessMember', 'comments', 'createAUserLikeForAComment', 'POST', '/api/headless/v1/comments/101/user_likes', [101, ['example' => 'value']], [], ['example' => 'value'], 'Bearer secret'];
        yield 'HeadlessMember Comments Destroy a user like for a comment' => ['HeadlessMember', 'comments', 'destroyAUserLikeForAComment', 'DELETE', '/api/headless/v1/comments/101/user_likes', [101], [], null, 'Bearer secret'];
        yield 'HeadlessMember Comments Get list of users who liked a comment' => ['HeadlessMember', 'comments', 'getListOfUsersWhoLikedAComment', 'GET', '/api/headless/v1/comments/101/user_likes', [101, ['page' => 2]], ['page' => '2'], null, 'Bearer secret'];
        yield 'HeadlessMember Community Links Get list of community links' => ['HeadlessMember', 'communityLinks', 'getListOfCommunityLinks', 'GET', '/api/headless/v1/community_links', [], [], null, 'Bearer secret'];
        yield 'HeadlessMember Community Members Get paginated list of comments for a community member ID' => ['HeadlessMember', 'communityMembers', 'comments', 'GET', '/api/headless/v1/community_members/101/comments', [101, ['page' => 2]], ['page' => '2'], null, 'Bearer secret'];
        yield 'HeadlessMember Community Members Deactivate a non-admin and non-owner community member' => ['HeadlessMember', 'communityMembers', 'deactivateANonAdminAndNonOwnerCommunityMember', 'DELETE', '/api/headless/v1/community_member/deactivate', [], [], null, 'Bearer secret'];
        yield 'HeadlessMember Community Members Get community members paginated list' => ['HeadlessMember', 'communityMembers', 'getCommunityMembersPaginatedList', 'GET', '/api/headless/v1/community_members', [['page' => 2]], ['page' => '2'], null, 'Bearer secret'];
        yield 'HeadlessMember Community Members Get paginated list of posts for a community member ID' => ['HeadlessMember', 'communityMembers', 'posts', 'GET', '/api/headless/v1/community_members/101/posts', [101, ['page' => 2]], ['page' => '2'], null, 'Bearer secret'];
        yield 'HeadlessMember Community Members Get current community member details' => ['HeadlessMember', 'communityMembers', 'getCurrentCommunityMemberDetails', 'GET', '/api/headless/v1/community_member', [], [], null, 'Bearer secret'];
        yield 'HeadlessMember Community Members Get spaces for a community member ID' => ['HeadlessMember', 'communityMembers', 'spaces', 'GET', '/api/headless/v1/community_members/101/spaces', [101, ['page' => 2]], ['page' => '2'], null, 'Bearer secret'];
        yield 'HeadlessMember Community Members Update community member profile' => ['HeadlessMember', 'communityMembers', 'updateCommunityMemberProfile', 'PUT', '/api/headless/v1/profile', [['example' => 'value']], [], ['example' => 'value'], 'Bearer secret'];
        yield 'HeadlessMember Community Members Get public profile details for a community member ID' => ['HeadlessMember', 'communityMembers', 'getPublicProfileDetailsForACommunityMemberId', 'GET', '/api/headless/v1/community_members/101/public_profile', [101], [], null, 'Bearer secret'];
        yield 'HeadlessMember Community Members Search community members' => ['HeadlessMember', 'communityMembers', 'searchCommunityMembers', 'POST', '/api/headless/v1/search/community_members', [['example' => 'value']], [], ['example' => 'value'], 'Bearer secret'];
        yield 'HeadlessMember Confirm Member Profile Update and confirm community member profile' => ['HeadlessMember', 'confirmMemberProfile', 'updateAndConfirmCommunityMemberProfile', 'PUT', '/api/headless/v1/signup/profile', [['example' => 'value']], [], ['example' => 'value'], 'Bearer secret'];
        yield 'HeadlessMember Cookies Create cookies' => ['HeadlessMember', 'cookies', 'createCookies', 'POST', '/api/headless/v1/cookies', [], [], null, 'Bearer secret'];
        yield 'HeadlessMember Cookies Destroy cookies' => ['HeadlessMember', 'cookies', 'destroyCookies', 'DELETE', '/api/headless/v1/cookies', [], [], null, 'Bearer secret'];
        yield 'HeadlessMember Courses Get list of files in a lesson' => ['HeadlessMember', 'courses', 'getListOfFilesInALesson', 'GET', '/api/headless/v1/courses/101/lessons/102/files', [101, 102, ['page' => 2]], ['page' => '2'], null, 'Bearer secret'];
        yield 'HeadlessMember Courses Update a lesson progress' => ['HeadlessMember', 'courses', 'updateALessonProgress', 'PATCH', '/api/headless/v1/courses/101/lessons/102/progress', [101, 102, ['example' => 'value']], [], ['example' => 'value'], 'Bearer secret'];
        yield 'HeadlessMember Courses Get a lesson in a course' => ['HeadlessMember', 'courses', 'getALessonInACourse', 'GET', '/api/headless/v1/courses/101/lessons/102', [101, 102], [], null, 'Bearer secret'];
        yield 'HeadlessMember Courses Get list of sections in a course' => ['HeadlessMember', 'courses', 'getListOfSectionsInACourse', 'GET', '/api/headless/v1/courses/101/sections', [101], [], null, 'Bearer secret'];
        yield 'HeadlessMember Courses Get course topics' => ['HeadlessMember', 'courses', 'getCourseTopics', 'GET', '/api/headless/v1/course_topics', [['page' => 2]], ['page' => '2'], null, 'Bearer secret'];
        yield 'HeadlessMember Direct Uploads Create a direct upload' => ['HeadlessMember', 'directUploads', 'createADirectUpload', 'POST', '/api/headless/v1/direct_uploads', [['example' => 'value']], [], ['example' => 'value'], 'Bearer secret'];
        yield 'HeadlessMember Events Get list of community events' => ['HeadlessMember', 'events', 'getListOfCommunityEvents', 'GET', '/api/headless/v1/community_events', [['page' => 2]], ['page' => '2'], null, 'Bearer secret'];
        yield 'HeadlessMember Events Create an event attendee' => ['HeadlessMember', 'events', 'createAnEventAttendee', 'POST', '/api/headless/v1/events/101/event_attendees', [101], [], null, 'Bearer secret'];
        yield 'HeadlessMember Events Destroy an event attendee' => ['HeadlessMember', 'events', 'destroyAnEventAttendee', 'DELETE', '/api/headless/v1/events/101/event_attendees', [101], [], null, 'Bearer secret'];
        yield 'HeadlessMember Events List event attendees' => ['HeadlessMember', 'events', 'listEventAttendees', 'GET', '/api/headless/v1/events/101/event_attendees', [101, ['page' => 2]], ['page' => '2'], null, 'Bearer secret'];
        yield 'HeadlessMember Events List recurring events' => ['HeadlessMember', 'events', 'listRecurringEvents', 'GET', '/api/headless/v1/spaces/101/events/102/recurring_events', [101, 102, ['page' => 2]], ['page' => '2'], null, 'Bearer secret'];
        yield 'HeadlessMember Events Update recurring event RSVP for the provided event ids' => ['HeadlessMember', 'events', 'updateRecurringEventRsvp', 'PUT', '/api/headless/v1/spaces/101/events/102/recurring_events/rsvp', [101, 102, ['example' => 'value']], [], ['example' => 'value'], 'Bearer secret'];
        yield 'HeadlessMember Flagged Contents Flag content' => ['HeadlessMember', 'flaggedContents', 'flagContent', 'POST', '/api/headless/v1/flagged_contents', [['example' => 'value']], [], ['example' => 'value'], 'Bearer secret'];
        yield 'HeadlessMember Home Page Get home page posts' => ['HeadlessMember', 'homePage', 'getHomePagePosts', 'GET', '/api/headless/v1/home', [['page' => 2]], ['page' => '2'], null, 'Bearer secret'];
        yield 'HeadlessMember Invitation Links Join community using invitation link' => ['HeadlessMember', 'invitationLinks', 'joinCommunityUsingInvitationLink', 'POST', '/api/headless/v1/invitation_links/101/join', [101], [], null, 'Bearer secret'];
        yield 'HeadlessMember Live Streams Create a live stream room' => ['HeadlessMember', 'liveStreams', 'createALiveStreamRoom', 'POST', '/api/headless/v1/live_streams/rooms', [['example' => 'value']], [], ['example' => 'value'], 'Bearer secret'];
        yield 'HeadlessMember Notification Preferences Get notification preferences for a medium' => ['HeadlessMember', 'notificationPreferences', 'getNotificationPreferencesForAMedium', 'GET', '/api/headless/v1/notification_preferences/101', [101], [], null, 'Bearer secret'];
        yield 'HeadlessMember Notification Preferences Update notification preferences for a medium' => ['HeadlessMember', 'notificationPreferences', 'updateNotificationPreferencesForAMedium', 'PUT', '/api/headless/v1/notification_preferences/101', [101, ['type' => 2]], ['type' => '2'], null, 'Bearer secret'];
        yield 'HeadlessMember Notification Preferences Get space notification preferences for the provided space member ID' => ['HeadlessMember', 'notificationPreferences', 'getSpaceNotificationPreferencesForTheProvidedSpaceMemberId', 'GET', '/api/headless/v1/notification_preferences/space_members/101', [101], [], null, 'Bearer secret'];
        yield 'HeadlessMember Notification Preferences Update notification preferences for all the spaces for the community member for the provided medium' => ['HeadlessMember', 'notificationPreferences', 'updateAllSpaces', 'PUT', '/api/headless/v1/notification_preferences/101/spaces', [101, ['choice' => 2]], ['choice' => '2'], null, 'Bearer secret'];
        yield 'HeadlessMember Notification Preferences Update notification preferences for a space member for the provided medium' => ['HeadlessMember', 'notificationPreferences', 'updateSpace', 'PUT', '/api/headless/v1/notification_preferences/101/spaces/102', [101, 102, ['choice' => 2]], ['choice' => '2'], null, 'Bearer secret'];
        yield 'HeadlessMember Notifications Archive a notification' => ['HeadlessMember', 'notifications', 'archiveANotification', 'POST', '/api/headless/v1/notifications/101/archive', [101], [], null, 'Bearer secret'];
        yield 'HeadlessMember Notifications Delete a notification' => ['HeadlessMember', 'notifications', 'deleteANotification', 'DELETE', '/api/headless/v1/notifications/101', [101], [], null, 'Bearer secret'];
        yield 'HeadlessMember Notifications Get a paginated list of notifications' => ['HeadlessMember', 'notifications', 'getAPaginatedListOfNotifications', 'GET', '/api/headless/v1/notifications', [['page' => 2]], ['page' => '2'], null, 'Bearer secret'];
        yield 'HeadlessMember Notifications Mark all notifications as read' => ['HeadlessMember', 'notifications', 'markAllNotificationsAsRead', 'POST', '/api/headless/v1/notifications/mark_all_as_read', [['example' => 'value']], [], ['example' => 'value'], 'Bearer secret'];
        yield 'HeadlessMember Notifications Mark a notification as read' => ['HeadlessMember', 'notifications', 'markANotificationAsRead', 'POST', '/api/headless/v1/notifications/101/mark_as_read', [101], [], null, 'Bearer secret'];
        yield 'HeadlessMember Notifications Get new notifications count' => ['HeadlessMember', 'notifications', 'getNewNotificationsCount', 'GET', '/api/headless/v1/notifications/new_notifications_count', [], [], null, 'Bearer secret'];
        yield 'HeadlessMember Notifications Reset new notifications count' => ['HeadlessMember', 'notifications', 'resetNewNotificationsCount', 'POST', '/api/headless/v1/notifications/reset_new_notifications_count', [], [], null, 'Bearer secret'];
        yield 'HeadlessMember Page Profile Fields Get Page Profile Fields' => ['HeadlessMember', 'pageProfileFields', 'getPageProfileFields', 'GET', '/api/headless/v1/page_profile_fields', [['page_name' => 2]], ['page_name' => '2'], null, 'Bearer secret'];
        yield 'HeadlessMember Posts Create an image post' => ['HeadlessMember', 'posts', 'createAnImagePost', 'POST', '/api/headless/v1/spaces/101/images/posts', [101, ['example' => 'value']], [], ['example' => 'value'], 'Bearer secret'];
        yield 'HeadlessMember Posts Update an image post' => ['HeadlessMember', 'posts', 'updateAnImagePost', 'PUT', '/api/headless/v1/spaces/101/images/posts/102', [101, 102, ['example' => 'value']], [], ['example' => 'value'], 'Bearer secret'];
        yield 'HeadlessMember Posts Follow a post' => ['HeadlessMember', 'posts', 'followAPost', 'POST', '/api/headless/v1/posts/101/post_followers', [101], [], null, 'Bearer secret'];
        yield 'HeadlessMember Posts Unfollow a post' => ['HeadlessMember', 'posts', 'unfollowAPost', 'DELETE', '/api/headless/v1/posts/101/post_followers', [101], [], null, 'Bearer secret'];
        yield 'HeadlessMember Posts Unfollow a post with ID' => ['HeadlessMember', 'posts', 'unfollowAPostWithId', 'DELETE', '/api/headless/v1/posts/101/post_followers/102', [101, 102], [], null, 'Bearer secret'];
        yield 'HeadlessMember Posts Create a post' => ['HeadlessMember', 'posts', 'createAPost', 'POST', '/api/headless/v1/spaces/101/posts', [101, ['example' => 'value']], [], ['example' => 'value'], 'Bearer secret'];
        yield 'HeadlessMember Posts Get list of posts in a space' => ['HeadlessMember', 'posts', 'getListOfPostsInASpace', 'GET', '/api/headless/v1/spaces/101/posts', [101, ['page' => 2]], ['page' => '2'], null, 'Bearer secret'];
        yield 'HeadlessMember Posts Delete a post' => ['HeadlessMember', 'posts', 'deleteAPost', 'DELETE', '/api/headless/v1/spaces/101/posts/102', [101, 102], [], null, 'Bearer secret'];
        yield 'HeadlessMember Posts Get a post' => ['HeadlessMember', 'posts', 'getAPost', 'GET', '/api/headless/v1/spaces/101/posts/102', [101, 102], [], null, 'Bearer secret'];
        yield 'HeadlessMember Posts Create a user like for a post' => ['HeadlessMember', 'posts', 'createAUserLikeForAPost', 'POST', '/api/headless/v1/posts/101/user_likes', [101, ['example' => 'value']], [], ['example' => 'value'], 'Bearer secret'];
        yield 'HeadlessMember Posts Destroy a user like for a post' => ['HeadlessMember', 'posts', 'destroyAUserLikeForAPost', 'DELETE', '/api/headless/v1/posts/101/user_likes', [101], [], null, 'Bearer secret'];
        yield 'HeadlessMember Posts Get list of users who liked a post' => ['HeadlessMember', 'posts', 'getListOfUsersWhoLikedAPost', 'GET', '/api/headless/v1/posts/101/user_likes', [101, ['page' => 2]], ['page' => '2'], null, 'Bearer secret'];
        yield 'HeadlessMember Quizzes Get latest quiz attempts for a course (for admins)' => ['HeadlessMember', 'quizzes', 'getLatestQuizAttemptsForACourseForAdmins', 'GET', '/api/headless/v1/courses/101/quiz_attempts', [101, ['page' => 2]], ['page' => '2'], null, 'Bearer secret'];
        yield 'HeadlessMember Quizzes Create a quiz attempt' => ['HeadlessMember', 'quizzes', 'createAQuizAttempt', 'POST', '/api/headless/v1/quizzes/101/attempts', [101, ['example' => 'value']], [], ['example' => 'value'], 'Bearer secret'];
        yield 'HeadlessMember Quizzes Get a quiz attempt' => ['HeadlessMember', 'quizzes', 'getAQuizAttempt', 'GET', '/api/headless/v1/quizzes/101/attempts/102', [101, 102, ['for_admin_review' => 2]], ['for_admin_review' => '2'], null, 'Bearer secret'];
        yield 'HeadlessMember Quizzes Update a quiz attempt result when passing grade is not set' => ['HeadlessMember', 'quizzes', 'updateAttemptResult', 'PUT', '/api/headless/v1/quizzes/101/attempts/102', [101, 102, ['example' => 'value']], [], ['example' => 'value'], 'Bearer secret'];
        yield 'HeadlessMember Search Search' => ['HeadlessMember', 'search', 'search', 'GET', '/api/headless/v1/search', [['search_text' => 2]], ['search_text' => '2'], null, 'Bearer secret'];
        yield 'HeadlessMember Space Members Mark space member messages as read' => ['HeadlessMember', 'spaceMembers', 'markSpaceMemberMessagesAsRead', 'POST', '/api/headless/v1/space_members/101/mark_as_read', [101], [], null, 'Bearer secret'];
        yield 'HeadlessMember Spaces Get space notification details' => ['HeadlessMember', 'spaces', 'getSpaceNotificationDetails', 'GET', '/api/headless/v1/space_notification_details', [['space_ids' => 2]], ['space_ids' => '2'], null, 'Bearer secret'];
        yield 'HeadlessMember Spaces Get space bookmarks' => ['HeadlessMember', 'spaces', 'getSpaceBookmarks', 'GET', '/api/headless/v1/spaces/101/bookmarks', [101, ['page' => 2]], ['page' => '2'], null, 'Bearer secret'];
        yield 'HeadlessMember Spaces Get home space details' => ['HeadlessMember', 'spaces', 'getHomeSpaceDetails', 'GET', '/api/headless/v1/spaces/home', [], [], null, 'Bearer secret'];
        yield 'HeadlessMember Spaces Get list of spaces' => ['HeadlessMember', 'spaces', 'getListOfSpaces', 'GET', '/api/headless/v1/spaces', [], [], null, 'Bearer secret'];
        yield 'HeadlessMember Spaces Join a space by id' => ['HeadlessMember', 'spaces', 'joinASpaceById', 'POST', '/api/headless/v1/spaces/101/join', [101], [], null, 'Bearer secret'];
        yield 'HeadlessMember Spaces Leave a space by id' => ['HeadlessMember', 'spaces', 'leaveASpaceById', 'POST', '/api/headless/v1/spaces/101/leave', [101], [], null, 'Bearer secret'];
        yield 'HeadlessMember Spaces Get space details' => ['HeadlessMember', 'spaces', 'getSpaceDetails', 'GET', '/api/headless/v1/spaces/101', [101], [], null, 'Bearer secret'];
        yield 'HeadlessMember Spaces Get space topics' => ['HeadlessMember', 'spaces', 'getSpaceTopics', 'GET', '/api/headless/v1/spaces/101/topics', [101, ['page' => 2]], ['page' => '2'], null, 'Bearer secret'];
    }
}
