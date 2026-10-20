<?php

declare(strict_types=1);

namespace AdroSoftware\CircleSoSdk\Tests\Endpoint;

use AdroSoftware\CircleSoSdk\CircleSo;
use AdroSoftware\CircleSoSdk\Tests\TestCase;
use Closure;
use GuzzleHttp\Psr7\Response;

final class V1ResponseFixtureTest extends TestCase
{
    /** @dataProvider responseProvider */
    public function test_endpoint_preserves_complete_response_fixture(string $fixture, Closure $call): void
    {
        $json = json_response($fixture);
        $sdk = $this->getSdkWithMockedClient([
            new Response(200, [], $json),
        ]);

        $response = $call($sdk);

        $this->assertSame(json_decode($json, true, flags: JSON_THROW_ON_ERROR), $response);
    }

    /** @return iterable<string, array{string, Closure(CircleSo): mixed}> */
    public static function responseProvider(): iterable
    {
        yield 'space group member' => [
            'space_group_member',
            static fn (CircleSo $sdk): mixed => $sdk->spaceGroupMembers()->show('member@example.com', 12, 5),
        ];
        yield 'space member mutation' => [
            'success_true',
            static fn (CircleSo $sdk): mixed => $sdk->spaceMembers()->add('member@example.com', 12, 5),
        ];
        yield 'spaces' => [
            'spaces',
            static fn (CircleSo $sdk): mixed => $sdk->spaces()->spaces(5),
        ];
        yield 'posts' => [
            'posts',
            static fn (CircleSo $sdk): mixed => $sdk->posts()->all(12, 5),
        ];
        yield 'comments' => [
            'comments',
            static fn (CircleSo $sdk): mixed => $sdk->comments()->all(5, postId: 21),
        ];
        yield 'tagged members' => [
            'tagged_members',
            static fn (CircleSo $sdk): mixed => $sdk->taggedMembers()->all(),
        ];
        yield 'messages' => [
            'message',
            static fn (CircleSo $sdk): mixed => $sdk->messages()->direct('member@example.com', 'Hello', 5),
        ];
        yield 'subscriptions' => [
            'subscriptions',
            static fn (CircleSo $sdk): mixed => $sdk->subscriptions()->all(5),
        ];
        yield 'events' => [
            'events',
            static fn (CircleSo $sdk): mixed => $sdk->events()->all(5),
        ];
        yield 'event attendees' => [
            'event_attendees',
            static fn (CircleSo $sdk): mixed => $sdk->eventAttendees()->all(71, 5),
        ];
        yield 'charges' => [
            'charges',
            static fn (CircleSo $sdk): mixed => $sdk->charges()->all(5),
        ];
        yield 'likes' => [
            'likes',
            static fn (CircleSo $sdk): mixed => $sdk->likes()->forPost(21),
        ];
        yield 'community member spaces' => [
            'community_member_spaces',
            static fn (CircleSo $sdk): mixed => $sdk->communityMemberSpaces()->all('member@example.com'),
        ];
        yield 'profile fields' => [
            'profile_fields',
            static fn (CircleSo $sdk): mixed => $sdk->profileFields()->all(),
        ];
        yield 'course sections' => [
            'course_sections',
            static fn (CircleSo $sdk): mixed => $sdk->courses()->sections(12, 5),
        ];
        yield 'course lessons' => [
            'course_lessons',
            static fn (CircleSo $sdk): mixed => $sdk->courses()->lessons(12, 121, 5),
        ];
        yield 'notification preferences' => [
            'notification_preferences',
            static fn (CircleSo $sdk): mixed => $sdk->notifications()->preferences(['token' => 'abc']),
        ];
        yield 'topics' => [
            'topics',
            static fn (CircleSo $sdk): mixed => $sdk->topics()->all(5),
        ];
        yield 'contacts' => [
            'contact',
            static fn (CircleSo $sdk): mixed => $sdk->contacts()->create(['email' => 'lead@example.com']),
        ];
        yield 'flagged contents' => [
            'flagged_contents',
            static fn (CircleSo $sdk): mixed => $sdk->flaggedContents()->all(5),
        ];
    }
}
